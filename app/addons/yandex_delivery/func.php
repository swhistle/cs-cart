<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

use Tygh\Languages\Languages;
use Tygh\Navigation\LastView;
use Tygh\Registry;

use Tygh\Shippings\YandexDelivery\YandexDelivery;
use Tygh\Shippings\YandexDelivery\Objects\Order;
use Tygh\Shippings\YandexDelivery\Objects\OrderItem;
use Tygh\Shippings\YandexDelivery\Objects\Recipient;
use Tygh\Shippings\YandexDelivery\Objects\Delivery;
use Tygh\Shippings\YandexDelivery\Objects\DeliveryPoint;


if ( !defined('AREA') ) { die('Access denied'); }

function fn_yandex_delivery_install()
{
    $service = array(
        'status' => 'A',
        'module' => 'yandex',
        'code' => 'yandex',
        'sp_file' => '',
        'description' => 'Yandex.Delivery',
    );

    $service['service_id'] = db_get_field('SELECT service_id FROM ?:shipping_services WHERE module = ?s AND code = ?s', $service['module'], $service['code']);

    if (empty($service['service_id'])) {
        $service['service_id'] = db_query('INSERT INTO ?:shipping_services ?e', $service);
    }

    $languages = Languages::getAll();
    foreach ($languages as $lang_code => $lang_data) {

        if ($lang_code == 'ru') {
            $service['description'] = "Яндекс.Доставка";
        } else {
            $service['description'] = "Yandex.Delivery";
        }

        $service['lang_code'] = $lang_code;

        db_query('INSERT INTO ?:shipping_service_descriptions ?e', $service);
    }
}

function fn_yandex_delivery_uninstall()
{
    $service_ids = db_get_fields('SELECT service_id FROM ?:shipping_services WHERE module = ?s', 'yandex');
    if (!empty($service_ids)) {
        db_query('DELETE FROM ?:shipping_services WHERE service_id IN (?a)', $service_ids);
        db_query('DELETE FROM ?:shipping_service_descriptions WHERE service_id IN (?a)', $service_ids);
    }
}

function fn_yandex_delivery_pre_place_order(&$cart, $allow, $product_groups)
{
    foreach($cart['product_groups'] as $group_key => &$group) {
        if (!empty($group['chosen_shippings'])) {
            foreach($group['chosen_shippings'] as &$shipping) {
                if ($shipping['module'] == 'yandex' && !empty($shipping['pickup_data'])) {
                    if (!empty($shipping['pickup_data']['schedules'])) {
                        $shipping['pickup_data']['work_time'] = YandexDelivery::getScheduleDays($shipping['pickup_data']['schedules']);
                    }
                }
            }
        }
    }
}

function fn_yandex_delivery_calculate_cart_taxes_pre(&$cart, $cart_products, &$product_groups)
{
    if (!empty($cart['shippings_extra']['yd']['data'])) {
        if (!empty($_REQUEST['select_yd_store'])) {
            $cart['select_yd_store'] = array_merge($cart['select_yd_store'], $_REQUEST['select_yd_store']);
            $select_yd_store = $cart['select_yd_store'];
        } elseif (!empty($cart['select_yd_store'])) {
            $select_yd_store = $cart['select_yd_store'];
        }

        if (!empty($select_yd_store)) {
            foreach ($product_groups as $group_key => $group) {
                if (!empty($group['chosen_shippings'])) {
                    foreach ($group['chosen_shippings'] as $shipping_key => $shipping) {

                        if($shipping['module'] != 'yandex') {
                            continue;
                        }

                        if (!empty($cart['shippings_extra']['yd']['data'][$group_key][$shipping['shipping_id']])) {
                            $shippings_extra = $cart['shippings_extra']['yd']['data'][$group_key][$shipping['shipping_id']];

                            if (!empty($select_yd_store[$group_key][$shipping['shipping_id']])) {
                                $select_pickup_id = $select_yd_store[$group_key][$shipping['shipping_id']];

                                $product_groups[$group_key]['chosen_shippings'][$shipping_key]['select_pickup_id'] = $select_pickup_id;

                                // Save point info
                                if (!empty($shippings_extra['pickup_points'])) {
                                    foreach($shippings_extra['pickup_points'] as $point) {
                                        if ($point['id'] == $select_pickup_id) {
                                            $product_groups[$group_key]['chosen_shippings'][$shipping_key]['pickup_data'] = $point;
                                            $product_groups[$group_key]['chosen_shippings'][$shipping_key]['yandex_delivery'] = $shippings_extra;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function fn_yandex_delivery_create_shipment_post($shipment_data, $order_info, $group_key, $all_products, $shipment_id)
{
    $shipping_module = '';
    if (empty($shipment_data['carrier'])) {
        $shipping = reset($order_info['shipping']);
        $shipping_module = $shipping['module'];
    }

    if ($shipment_data['carrier'] == 'yandex' || $shipping_module == 'yandex') {
        $yd = YandexDelivery::init($shipment_data['shipping_id']);

        $order = new Order();
        $recipient = new Recipient();
        $delivery = new Delivery();
        $delivery_point = new DeliveryPoint();

        $shipping = array();
        if (!empty($order_info['shipping'])) {
            $shipping = reset($order_info['shipping']);

            if (!empty($shipping['pickup_data'])) {
                $delivery->pickuppoint = $shipping['pickup_data']['id'];
                $delivery->delivery = $shipping['yandex_delivery']['delivery']['id'];
                $delivery->direction = $shipping['yandex_delivery']['direction'];
                $delivery->tariff = $shipping['yandex_delivery']['tariffId'];

                $interval = reset($shipping['yandex_delivery']['deliveryIntervals']);
                $delivery->interval = $interval['id'];
            }
        }

        $product_groups = reset($order_info['product_groups']);
        $package_size = YandexDelivery::getSizePackage($product_groups['package_info'], $shipping['service_params']);

        $order->num = $order_info['order_id'];
        $order->requisite = $yd->requisite_id;
        $order->warehouse = $yd->warehouse_id;
        $order->delivery_cost = $shipping['rate'];
        //$order->assessed_value = 0;
        //$order->amount_prepaid = 0;

        $weight = $product_groups['package_info']['W'] * Registry::get('settings.General.weight_symbol_grams') / 1000;
        $order->weight = sprintf('%.3f', $weight);
        $order->length = $package_size['length'];
        $order->width = $package_size['width'];
        $order->height = $package_size['height'];

        $recipient->first_name = $order_info['s_firstname'];
        $recipient->last_name = $order_info['s_lastname'];
        $recipient->phone = $order_info['s_phone'];
        $recipient->email = $order_info['email'];

        if (!empty($shipping['pickup_data']) && $shipping['pickup_data']['type'] == 'PICKUPPOINT') {
            $address = $shipping['pickup_data']['address'];

            $delivery_point->city = $order_info['s_city'];
            $delivery_point->street = $address['street'];

        } else {
            $delivery_point->city = $order_info['s_city'];
            $delivery_point->index = $order_info['s_zipcode'];
        }

        foreach ($shipment_data['products'] as $product_code => $amount) {

            if (isset($order_info['products'][$product_code])) {
                $item = new OrderItem();

                $product_data = $order_info['products'][$product_code];

                $item->article = $product_data['product_code'];
                $item->name = $product_data['product'];
                $item->quantity = $amount;
                $item->cost = $product_data['price'];

                $order->appendItem($item);
            }
        }

        $yandex_order_data = $yd->createOrder($order, $recipient, $delivery, $delivery_point);

        fn_yandex_delivery_add_shipment($order_info, $shipment_data, $shipment_id, $yandex_order_data);
    }
}

function fn_yandex_delivery_add_shipment($order_info, $shipment_data, $shipment_id, $yandex_order_data)
{
    $statuses = fn_yandex_delivery_get_statuses();

    $order_status_id = 0;
    if (array_key_exists($yandex_order_data['status'], $statuses)) {
        $order_status_id = $statuses[$yandex_order_data['status']]['yd_status_id'];
    }

    $order = array(
        'shipment_id' => $shipment_id,
        'yandex_id' => $yandex_order_data['id'],
        'yandex_full_num' => $yandex_order_data['full_num'],
        'status' => $order_status_id,
    );

    db_query('INSERT INTO ?:yd_orders ?e', $order);
}

function fn_yandex_delivery_get_orders($params = array(), $items_per_page = 0)
{
    $params = LastView::instance()->update('yandex_delivery', $params);

    // Set default values to input params
    $default_params = array (
        'page' => 1,
        'items_per_page' => $items_per_page
    );

    $params = array_merge($default_params, $params);

    $condition = '';
    if (!empty($params['status'])) {
        $condition .= db_quote(' AND yd_status_code = ?s', $params['status']);
    }

    $fields_list = array(
        '?:yd_orders.shipment_id',
        '?:yd_orders.yandex_id',
        '?:yd_orders.yandex_full_num',
        '?:yd_statuses.yd_status_code',

        '?:orders.s_firstname',
        '?:orders.s_lastname',
        '?:orders.company',
        '?:orders.user_id',
    );

    $joins = array(
        'LEFT JOIN ?:yd_statuses ON ?:yd_orders.status = ?:yd_statuses.yd_status_id',
        'LEFT JOIN ?:shipment_items ON ?:yd_orders.shipment_id = ?:shipment_items.shipment_id',
        'LEFT JOIN ?:orders ON ?:shipment_items.order_id = ?:orders.order_id',
    );

    $group = array(
        '?:yd_orders.yandex_id',
    );

    if (isset($params['cname']) && fn_string_not_empty($params['cname'])) {
        $arr = fn_explode(' ', $params['cname']);
        foreach ($arr as $k => $v) {
            if (!fn_string_not_empty($v)) {
                unset($arr[$k]);
            }
        }
        if (sizeof($arr) == 2) {
            $condition .= db_quote(" AND ?:orders.firstname LIKE ?l AND ?:orders.lastname LIKE ?l", "%".array_shift($arr)."%", "%".array_shift($arr)."%");
        } else {
            $condition .= db_quote(" AND (?:orders.firstname LIKE ?l OR ?:orders.lastname LIKE ?l)", "%".trim($params['cname'])."%", "%".trim($params['cname'])."%");
        }
    }

    if (!empty($params['yd_order_id'])) {
        $condition .= db_quote(' AND ?:yd_orders.yandex_full_num LIKE ?l', $params['yd_order_id'] . "%");
    }

    $fields_list = implode(', ', $fields_list);
    $joins = implode(' ', $joins);

    $group = implode(', ', $group);
    if (!empty($group)) {
        $group = ' GROUP BY ' . $group;
    }

    $limit = '';
    if (!empty($params['items_per_page'])) {
        $params['total_items'] = db_get_field("SELECT COUNT(DISTINCT(?:yd_orders.yandex_id)) FROM ?:yd_orders $joins WHERE 1 $condition");
        $limit = db_paginate($params['page'], $params['items_per_page'], $params['total_items']);
    }

    $orders = db_get_array("SELECT $fields_list FROM ?:yd_orders $joins WHERE 1 $condition $group $limit");
    
    $yd_order_statuses = fn_yandex_delivery_get_statuses();
    
    foreach ($orders as &$order) {
        if (array_key_exists($order['yd_status_code'], $yd_order_statuses)) {
            $order['status_name'] = $yd_order_statuses[$order['yd_status_code']]['yd_status_name'];
        }
    }

    return array($orders, $params);
}

function fn_yandex_delivery_cancel_orders($ids, $delete_orders = false, $delete_shipments = true)
{
    $yd = YandexDelivery::init();
    $shipment_ids = array();

    foreach ($ids as $id) {
        $yandex_order_data = $yd->getOrderInfo($id, true);

        $result = false;
        if ($yandex_order_data['status'] != 'CANCELED') {
            $result = $yd->deleteOrder($id);
        }

        if (($result || $delete_orders) && $delete_shipments) {
            $shipment_id = db_get_field('SELECT shipment_id FROM ?:yd_orders WHERE yandex_id = ?i', $id);
            $shipment_ids[] = $shipment_id;

            fn_yandex_delivery_update_order_statuses_by_shipment($shipment_id);
        }
    }

    if ($delete_orders) {
        db_query('DELETE FROM ?:yd_orders WHERE yandex_id IN (?n)', $ids);
        db_query('DELETE FROM ?:yd_order_statuses WHERE yandex_id IN (?n)', $ids);
    }

    if ($delete_shipments && !empty($shipment_ids)) {
        fn_delete_shipments($shipment_ids);
    }

    fn_yandex_delivery_update_orders($ids);
}

function fn_yandex_delivery_get_statuses()
{
    static $statuses = null;

    if (!isset($statuses)) {
        $statuses = db_get_hash_array('SELECT s.yd_status_id, s.yd_status_code, sd.yd_status_name, sd.yd_status_info'
            . ' FROM ?:yd_statuses as s LEFT JOIN ?:yd_status_descriptions as sd USING(yd_status_id)' , 'yd_status_code');
    }

    return $statuses;
}

function fn_yandex_delivery_get_public_status($status_id, $lang_code = CART_LANGUAGE)
{
    static $statuses = null;

    if (!isset($statuses)) {
        $statuses = db_get_hash_array('SELECT s.yd_status_id, sd.yd_status_info'
            . ' FROM ?:yd_statuses as s LEFT JOIN ?:yd_status_descriptions as sd USING(yd_status_id)'
            . ' WHERE lang_code = ?s', 'yd_status_id', $lang_code);
    }

    return isset($statuses[$status_id]) ? $statuses[$status_id]['yd_status_info'] : '';
}

function fn_yandex_delivery_get_status_by_id($status_id, $lang_code = CART_LANGUAGE)
{
    static $statuses = null;

    if (!isset($statuses)) {
        $statuses = db_get_hash_array('SELECT s.yd_status_id, sd.yd_status_name'
            . ' FROM ?:yd_statuses as s LEFT JOIN ?:yd_status_descriptions as sd USING(yd_status_id)'
            . ' WHERE lang_code = ?s', 'yd_status_id', $lang_code);
    }

    return isset($statuses[$status_id]) ? $statuses[$status_id]['yd_status_name'] : '';
}

function  fn_yandex_delivery_delete_shipments($shipment_ids, $result)
{
    $yd_order_ids = db_get_fields('SELECT yandex_id FROM ?:yd_orders WHERE shipment_id IN (?n)', $shipment_ids);
    fn_yandex_delivery_cancel_orders($yd_order_ids, false, false);

    db_query('UPDATE ?:yd_orders SET shipment_id = 0 WHERE shipment_id IN (?n)', $shipment_ids);
}

function fn_yandex_delivery_get_order_statuses($order_id, $group_by_shipment = true)
{
    fn_yandex_delivery_update_order_statuses($order_id);

    $fields = array(
        '?:yd_order_statuses.yandex_id',
        '?:yd_order_statuses.order_id',
        '?:yd_orders.shipment_id',
        '?:yd_order_statuses.status',
        '?:yd_order_statuses.timestamp',
        '?:yd_status_descriptions.yd_status_name',
        '?:yd_status_descriptions.yd_status_info',
    );

    $join = db_quote('INNER JOIN ?:yd_orders USING(yandex_id)');
    $join .= db_quote(' INNER JOIN ?:yd_status_descriptions ON ?:yd_order_statuses.status = ?:yd_status_descriptions.yd_status_id');

    $condition = ' AND shipment_id != 0';
    if (!empty($order_id)) {
        $condition .= db_quote(" AND order_id = ?i", $order_id);
    }

    $fields = implode(', ', $fields);
    if ($group_by_shipment) {
        $yandex_order_statuses = db_get_hash_array("SELECT $fields FROM ?:yd_order_statuses $join WHERE 1 $condition ORDER BY ?:yd_order_statuses.timestamp ASC", 'shipment_id');
    } else {
        $yandex_order_statuses = db_get_array("SELECT $fields FROM ?:yd_order_statuses $join WHERE 1 $condition ORDER BY ?:yd_order_statuses.timestamp DESC");
    }

    foreach ($yandex_order_statuses as &$order) {
        $order['time'] = fn_date_format($order['timestamp'], Registry::get('settings.Appearance.date_format'));
    }

    return $yandex_order_statuses;
}

function fn_yandex_delivery_update_orders($ids)
{
    $yd = YandexDelivery::init();
    $yd_order_statuses = fn_yandex_delivery_get_statuses();

    foreach ($ids as $id) {
        $yandex_order_data = $yd->getOrderInfo($id, true);

        if (!empty($yandex_order_data)) {
            $status = $yd_order_statuses[$yandex_order_data['status']];
            db_query('UPDATE ?:yd_orders SET status = ?i WHERE yandex_id = ?i', $status['yd_status_id'], $yandex_order_data['id']);
        }
    }
}

function fn_yandex_delivery_update_order_statuses($order_id)
{
    $shipments_ids = db_get_fields('SELECT shipment_id FROM ?:shipment_items WHERE order_id = ?i GROUP BY shipment_id', $order_id);
    foreach ($shipments_ids as $shipment_id) {
        fn_yandex_delivery_update_order_statuses_by_shipment($shipment_id, $order_id);
    }
}

function fn_yandex_delivery_update_order_statuses_by_shipment($shipment_id, $order_id = 0)
{
    $yd = YandexDelivery::init();
    $statuses = fn_yandex_delivery_get_statuses();

    $yandex_order_id = db_get_field('SELECT yandex_id FROM ?:yd_orders WHERE shipment_id = ?i', $shipment_id);

    if (!empty($yandex_order_id)) {
        $yandex_order_statuses = $yd->getSenderOrderStatuses($yandex_order_id, true);

        if (!empty($yandex_order_statuses)) {

            if (empty($order_id)) {
                $order_id = db_get_field('SELECT order_id FROM ?:shipment_items WHERE shipment_id = ?i', $shipment_id);
            }

            foreach ($yandex_order_statuses as &$order) {
                $dateTime = new DateTime($order['time']);

                $data = array(
                    'yandex_id' => $yandex_order_id,
                    'order_id' => $order_id,
                    'timestamp' => $dateTime->format('U')
                );

                if (isset($statuses[$order['uniform_status']])) {
                    $status_data = $statuses[$order['uniform_status']];
                    $data['status'] = $status_data['yd_status_id'];
                }

                db_query('INSERT INTO ?:yd_order_statuses ?e ON DUPLICATE KEY UPDATE status=status', $data);
            }

            $last_timestamp = db_get_field('SELECT MAX(`timestamp`) FROM ?:yd_order_statuses WHERE yandex_id = ?i', $yandex_order_id);
            $last_status_id = db_get_field('SELECT status FROM ?:yd_order_statuses WHERE yandex_id = ?i AND timestamp = ?i', $yandex_order_id, $last_timestamp);
            db_query('UPDATE ?:yd_orders SET status = ?i WHERE yandex_id = ?i', $last_status_id, $yandex_order_id);
        }
    }
}