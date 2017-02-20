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

namespace Tygh\Shippings\YandexDelivery;

use Tygh\Registry;

class YandexDelivery
{
    public static $version = "1.0";

    public static function init($shipping_id = null, $config = null)
    {
        static $api = null;

        if ($api == null) {
            if ($config == null) {

                $config = new Config();
                $addon_info = Registry::get('addons.yandex_delivery');

                self::getApiKeys($addon_info, $config);
                self::getIds($addon_info, $config);

                $config->api_url = "https://delivery.yandex.ru/api/" . self::$version . "/";
                $config->format = 'json';
                if (isset($config->ids['client'])) {
                    $config->client_id = !empty($config->ids['client']['id']) ? $config->ids['client']['id'] : 0;
                }

                if (!empty($shipping_id)) {
                    $shipping = fn_get_shipping_params($shipping_id);
                    $config->sender_id = isset($shipping['sender_id']) ? $shipping['sender_id'] : 0;
                    $config->warehouse_id = isset($shipping['warehouse_id']) ? $shipping['warehouse_id'] : 0;
                    $config->requisite_id = isset($shipping['requisite_id']) ? $shipping['requisite_id'] : 0;
                } else {
                    if (!empty($config->ids['senders'])) {
                        $sender = reset($config->ids['senders']);
                        $config->sender_id = !empty($sender['id']) ? $sender['id'] : 0;
                    }

                    if (!empty($config->ids['warehouses'])) {
                        $warehouse = reset($config->ids['warehouses']);
                        $config->warehouse_id = !empty($warehouse['id']) ? $warehouse['id'] : 0;
                    }

                    if (!empty($config->ids['requisites'])) {
                        $requisite = reset($config->ids['requisites']);
                        $config->requisite_id = !empty($requisite['id']) ? $requisite['id'] : 0;
                    }
                }

                if (empty($config->sender_id) && is_array($config->ids['senders'])) {
                    $sender = reset($config->ids['senders']);
                    $config->sender_id = !empty($sender['id']) ? $sender['id'] : 0;
                }

                $config->available_city_from = fn_get_schema('yandex_delivery', 'city_from');
            }

            $api = new Api($config);
        }

        return $api;
    }

    public static function getSizePackage($package_info, $shipping_settings)
    {
        $package_size = array(
            'length' => 0,
            'width' => 0,
            'height' => 0,
        );

        if (!empty($package_info['packages'])) {

            $length = !empty($shipping_settings['length']) ? $shipping_settings['length'] : 0;
            $width = !empty($shipping_settings['width']) ? $shipping_settings['width'] : 0;
            $height = !empty($shipping_settings['height']) ? $shipping_settings['height'] : 0;

            $box_data = array();
            foreach ($package_info['packages'] as $package) {
                $box_data[] = array(
                    empty($package['shipping_params']['box_length']) ? $length : $package['shipping_params']['box_length'],
                    empty($package['shipping_params']['box_width']) ? $width : $package['shipping_params']['box_width'],
                    empty($package['shipping_params']['box_height']) ? $height : $package['shipping_params']['box_height']
                );
            }

            $sort_box_data = array();
            foreach ($box_data as $box) {
                arsort($box);
                $sort_box_data[] = array_values($box);
            }

            $lenght_data = array();
            $width_data = array();
            $height_data = array();
            foreach ($sort_box_data as $box) {
                $lenght_data[] = $box[0];
                $width_data[] = $box[1];
                $height_data[] = $box[2];
            }

            $package_size = array(
                'length' => max($lenght_data),
                'width' => max($width_data),
                'height' => array_sum($height_data),
            );
        }

        return $package_size;
    }


    protected static function getApiKeys($addon_info, &$config)
    {
        if ($client = json_decode($addon_info['api_keys'], true)) {
            $config->keys = $client;
        } else {
            $api_keys = explode(PHP_EOL, $addon_info['api_keys']);

            foreach ($api_keys as $value) {
                if (strpos($value, ':') !== false) {
                    $data = explode(':' , $value);
                    $config->keys[trim($data[0])] = trim($data[1]);
                }
            }
        }
    }

    protected static function getIds($addon_info, &$config)
    {
        if ($client = json_decode($addon_info['client_ids'], true)) {
            $config->ids = $client;

        } else {
            $pattern_elements = "/(\".+?\"):([0-9]+|\[.*?\])/";
            preg_match_all($pattern_elements, $addon_info['client_ids'], $elements);

            $config_ids = array(
                'client_id' => 0,
                'warehouse_ids' => array(),
                'sender_ids' => array(),
                'requisite_ids' => array()
            );

            if (!empty($elements)) {
                foreach ($elements[1] as $pos => $index) {
                    $index = str_replace('"', '', $index);
                    $value = $elements[2][$pos];

                    if (strpos($value, '[') !== false) {
                        preg_match_all("/([\d]+)/", $value, $id);
                        $value = $id[1];
                    } else {
                        $value = intval($value);
                    }

                    $config_ids[$index] = $value;
                }
            }

            $config->ids['client'] = array(
                'id' => $config_ids['client_id']
            );

            foreach ($config_ids['warehouse_ids'] as $warehouse_id) {
                $config->ids['warehouses'][]['id'] = $warehouse_id;
            }

            foreach ($config_ids['sender_ids'] as $sender_id) {
                $config->ids['senders'][]['id'] = $sender_id;
            }

            foreach ($config_ids['requisite_ids'] as $requisite_id) {
                $config->ids['requisites'][]['id'] = $requisite_id;
            }
        }
    }

    public static function getScheduleDays($schedules)
    {
        $last_to_day = -1;
        $last_from_day = -1;
        $last_day = 1;

        $days_same = array();
        $same_index = 0;

        foreach ($schedules as $key_day => $day) {

            $day['from'] = substr($day['from'], 0, strrpos($day['from'], ':', -1));
            $day['to'] = substr($day['to'], 0, strrpos($day['to'], ':', -1));

            if ($day['from'] == $last_from_day && $day['to'] == $last_to_day) {
                $days_same[$same_index]['last_day'] = $key_day + 1;
                $last_day = $key_day + 1;

            } else {
                $same_index++;
                $days_same[$same_index]['first_day'] = $key_day + 1;
                $days_same[$same_index]['last_day'] = $key_day + 1;
                $days_same[$same_index]['from'] = $day['from'];
                $days_same[$same_index]['to'] = $day['to'];

                if ($day['from'] == $day['to']) {
                    $days_same[$same_index]['all_day'] = true;
                }

                $last_day = $key_day + 1;
            }

            $last_from_day = $day['from'] ;
            $last_to_day = $day['to'];
        }

        if ($last_day < 7) {
            $same_index++;
            $days_same[$same_index]['first_day'] = $last_day + 1;
            $days_same[$same_index]['last_day'] = 7;
            $days_same[$same_index]['from'] = false;
        }

        foreach ($days_same as $key => $day) {
            if ($day['last_day'] == 7) {
                $days_same[$key]['last_day'] = 0;
            }

            if ($day['first_day'] == 7) {
                $days_same[$key]['first_day'] = 0;
            }
        }

        return $days_same;
    }
}
