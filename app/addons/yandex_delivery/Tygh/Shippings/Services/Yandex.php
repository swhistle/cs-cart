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

namespace Tygh\Shippings\Services;

use Tygh\Shippings\YandexDelivery\YandexDelivery;
use Tygh\Shippings\YandexDelivery\Objects\RequestDeliveryList;
use Tygh\Shippings\IService;
use Tygh\Registry;
use Tygh\Http;

class Yandex implements IService
{
    /**
     * Abailability multithreading in this module
     *
     * @var bool $_allow_multithreading
     */
    private $_allow_multithreading = false;

    /**
     * The currency in which the carrier calculates shipping costs.
     *
     * @var string $calculation_currency
     */
    public $calculation_currency = 'RUB';

    /**
     * Stack for errors occured during the preparing rates process
     *
     * @var array $_error_stack
     */
    private $_error_stack = array();

    /**
     * Current Company id environment
     *
     * @var int $company_id
     */
    public $company_id = 0;

    public $sid;

    public $tariff_id = 0;
    public $pickuppoint_id = 0;
    public $select_yd_store = '';

    /**
     * Collects errors during preparing and processing request
     *
     * @param string $error
     */
    private function _internalError($error)
    {
        $this->_error_stack[] = $error;
    }

    /**
     * Checks if shipping service allows to use multithreading
     *
     * @return bool true if allow
     */
    public function allowMultithreading()
    {
        return $this->_allow_multithreading;
    }

    /**
     * Gets error message from shipping service server
     *
     * @param string $response
     * @internal param string $resonse Reponse from Shipping service server
     * @return string Text of error or false if no errors
     */
    public function processErrors($response)
    {
        $error = '';
        if (!empty($this->_error_stack)) {
            foreach ($this->_error_stack as $_error) {
                $error .= '; ' . $_error;
            }
        }

        return $error;
    }

    /**
     * Sets data to internal class variable
     *
     * @param  array      $shipping_info
     * @return array|void
     */
    public function prepareData($shipping_info)
    {
        $this->_shipping_info = $shipping_info;
        $this->company_id = Registry::get('runtime.company_id');

        $group_key = isset($shipping_info['keys']['group_key']) ? $shipping_info['keys']['group_key'] : 0;
        $shipping_id = isset($shipping_info['keys']['shipping_id']) ? $shipping_info['keys']['shipping_id'] : 0;

        if (isset($_SESSION['cart']['shippings_extra']['yd']['tariff_id'][$group_key][$shipping_id])) {
            $this->tariff_id = $_SESSION['cart']['shippings_extra']['yd']['tariff_id'][$group_key][$shipping_id];
        }

        if (isset($_SESSION['cart']['shippings_extra']['yd']['pickuppoint_id'][$group_key][$shipping_id])) {
            $this->pickuppoint_id = $_SESSION['cart']['shippings_extra']['yd']['pickuppoint_id'][$group_key][$shipping_id];
        }

        if (isset($_SESSION['cart']['select_yd_store'])) {
            $this->select_yd_store = $_SESSION['cart']['select_yd_store'];
        }
    }

    /**
     * Prepare request information
     *
     * @return array Prepared data
     */
    public function getRequestData()
    {
        $request_data = new RequestDeliveryList();

        $package_info = $this->_shipping_info['package_info'];
        $service_params = $this->_shipping_info['service_params'];

        $request_data->city_from = !empty($service_params['city_from']) ? $service_params['city_from'] : $package_info['origination']['city'];
        $request_data->city_to = !empty($package_info['location']['city']) ? $package_info['location']['city'] : '';

        $weight_data = fn_expand_weight($package_info['W']);
        $weight = $weight_data['plain'] * Registry::get('settings.General.weight_symbol_grams') / 1000;
        $request_data->weight = sprintf('%.3f', round((double) $weight + 0.00000000001, 3));


        $package_size = YandexDelivery::getSizePackage($package_info, $service_params);

        $request_data->width = $package_size['width'];
        $request_data->height = $package_size['height'];
        $request_data->length = $package_size['length'];

        $request_data->total_cost = $package_info['C'];

        return $request_data;
    }

    /**
     * Process simple request to shipping service server
     *
     * @return string Server response
     */
    public function getSimpleRates()
    {
        $yd = YandexDelivery::init($this->_shipping_info['shipping_id']);

        $request_delivery_list = $this->getRequestData();
        $request_delivery_list->client_id = $yd->client_id;
        $request_delivery_list->sender_id = $yd->sender_id;

        $response = array();
        if (!empty($yd->client_id)) {
            $response = $yd->searchDeliveryList($request_delivery_list);
        }

        return $response;
    }

    /**
     * Gets shipping cost and information about possible errors
     *
     * @param string $response
     * @internal param string $resonse Reponse from Shipping service server
     * @return array Shipping cost and errors
     */
    public function processResponse($response)
    {
        $return = array(
            'cost' => false,
            'error' => false,
            'delivery_time' => false,
        );

        $service_params = $this->_shipping_info['service_params'];

        if ($service_params['display_type'] = 'CMS') {
            $this->processCms($response, $service_params, $return);

        } else {
            $this->processWidget($response, $service_params, $return);
        }

        return $return;
    }

    public function processCms($response, $service_params, &$return)
    {
        $deliveries = array();
        $pickup_points = array();
        $group_key = isset($this->_shipping_info['keys']['group_key']) ? $this->_shipping_info['keys']['group_key'] : 0;
        $shipping_id = isset($this->_shipping_info['keys']['shipping_id']) ? $this->_shipping_info['keys']['shipping_id'] : 0;

        if (empty($response)) {
            return;
        }

        if (!empty($service_params['deliveries'])) {
            foreach ($response['data'] as $key => $data) {
                if (!empty($data['delivery']) && !empty($data['is_pickup_point']) && in_array($data['delivery']['id'], $service_params['deliveries'])) {
                    $deliveries[$data['delivery']['id']] = $data;

                    foreach ($data['pickupPoints'] as $key => $pickup) {
                        $data['pickupPoints'][$key]['delivery_name'] = $data['delivery']['name'];
                    }

                    $pickup_points = array_merge($pickup_points, $data['pickupPoints']);
                }

            }
        }

        if (!empty($pickup_points)) {
            $old_pickup_points = $pickup_points;
            $pickup_points = array();

            foreach($old_pickup_points as $pickup) {
                $short_address = explode(', ', $pickup['full_address']);
                unset($short_address[0]);
                unset($short_address[1]);
                $pickup['short_address'] = implode(', ', $short_address);

                $pickup_points[$pickup['id']] = $pickup;
            }
        }

        $shipping_data = array();

        if (!empty($pickup_points)) {
            if ($this->_shipping_info['service_params']['sort_type'] == "near") {
                $pickup_points = $this->sortByNearPoints($pickup_points);
            }

            if (!empty($this->_shipping_info['package_info']['location']['address'])) {
                $address = trim($this->_shipping_info['package_info']['location']['address']);
            } else {
                $address = $this->_shipping_info['package_info']['location']['city'];
            }

            $hash_address = md5(trim($address));

            if (empty($_SESSION['cart']['select_yd_store'][$group_key][$shipping_id]) ||
                (!empty($_SESSION['cart']['shippings_extra']['yd']['hash_address']) &&
                    $_SESSION['cart']['shippings_extra']['yd']['hash_address'] != $hash_address)
                ) {

                $near_point = $this->findNearPickpoint($pickup_points);

                $this->select_yd_store[$group_key][$shipping_id] = $near_point;
                $_SESSION['cart']['select_yd_store'][$group_key][$shipping_id] = $near_point;
            }

            $select_point = $this->select_yd_store[$group_key][$shipping_id];
            $delivery_id = $pickup_points[$select_point]['delivery_id'];

            if (!empty($delivery_id)) {
                $shipping_data = $deliveries[$delivery_id];
            } else {
                $shipping_data = reset($deliveries);
            }
        }

        $shipping_data['deliveries'] = $deliveries;
        $shipping_data['pickup_points'] = $pickup_points;

        if (!empty($shipping_data['minDays'])) {
            if ($shipping_data['minDays'] == $shipping_data['maxDays']) {
                $return['delivery_time'] = $shipping_data['minDays'] . " " . __('days');
            } else {
                $return['delivery_time'] = $shipping_data['minDays'] . "-" . $shipping_data['maxDays'] . " " . __('days');
            }
        }

        if (empty($this->_error_stack) && isset($shipping_data)) {

            $this->fillSessionData($shipping_data);

            if (isset($shipping_data['costWithRules'])) {
                $return['cost'] = $this->getCost($shipping_data);
            }

        } else {

            $this->clearSessionData();
            $return['error'] = $this->processErrors($response);

        }
    }

    public function processWidget($response, $service_params, &$return)
    {
        $first_delivery = reset($response['data']);

        if (!empty($first_delivery)) {
            $delivery_cost = $first_delivery['costWithRules'];
            $delivery_index = 0;
            $pickuppoint_index = 0;

            if (empty($this->tariff_id)) {
                // Find min delivery cost
                foreach ($response['data'] as $key_delivery => $delivery) {
                    if ($delivery['costWithRules'] < $delivery_cost) {
                        $delivery_index = $key_delivery;
                        $delivery_cost = $delivery['costWithRules'];
                    }
                }

            } else {
                foreach ($response['data'] as $key_delivery => $delivery) {
                    if ($delivery['tariffId'] == $this->tariff_id) {

                        $delivery_index = $key_delivery;
                        $delivery_cost = $delivery['costWithRules'];

                        if ($delivery['type'] == 'PICKUP') {

                            foreach ($delivery['pickupPoints'] as $pickup_index => $pickup) {
                                if ($pickup['id'] == $this->pickuppoint_id) {
                                    $pickuppoint_index = $pickup_index;
                                    break;
                                }
                            }
                        }

                        break;
                    }
                }
            }

            $this->_fillSessionData($response, $delivery_index, $pickuppoint_index);

            $return = array(
                'cost' => $this->convertCurrencies($delivery_cost),
                'error' => false,
            );

        } else {
            $return = array(
                'cost' => false,
                'error' => false,
            );
        }
    }

    public function getCost($shipping_data)
    {
        $cost = $shipping_data['costWithRules'];

        return $cost;

    }

    /**
     * Fills edost_cod array in session cart variable
     *
     * @param  string $code       Shipping service code
     * @param  int    $company_id Selected company identifier
     * @param  array  $rates      Previously calculated rates
     * @return bool   true Always true
     */
    private function fillSessionData($shipping_data)
    {
        $group_key = isset($this->_shipping_info['keys']['group_key']) ? $this->_shipping_info['keys']['group_key'] : 0;
        $shipping_id = isset($this->_shipping_info['keys']['shipping_id']) ? $this->_shipping_info['keys']['shipping_id'] : 0;

        $address = !empty($this->_shipping_info['package_info']['location']['address']) ? trim($this->_shipping_info['package_info']['location']['address']) : '';

        $_SESSION['cart']['shippings_extra']['yd']['data'][$group_key][$shipping_id] = $shipping_data;
        $_SESSION['cart']['shippings_extra']['yd']['hash_address'] = md5($address);

        return true;
    }

    private function clearSessionData()
    {

        $group_key = isset($this->_shipping_info['keys']['group_key']) ? $this->_shipping_info['keys']['group_key'] : 0;
        $shipping_id = isset($this->_shipping_info['keys']['shipping_id']) ? $this->_shipping_info['keys']['shipping_id'] : 0;

        unset($_SESSION['cart']['shippings_extra']['yd']['data'][$group_key][$shipping_id]);

        return true;
    }

    private function _fillSessionData($response, $delivery_index, $pickuppoint_index)
    {
        $group_key = isset($this->_shipping_info['keys']['group_key']) ? $this->_shipping_info['keys']['group_key'] : 0;
        $shipping_id = isset($this->_shipping_info['keys']['shipping_id']) ? $this->_shipping_info['keys']['shipping_id'] : 0;

        if ($response['data'][$delivery_index]['type'] == 'PICKUP') {
            $response['data'][$delivery_index]['schedule_days'] = YandexDelivery::getScheduleDays($response['data'][$delivery_index]['pickupPoints'][$pickuppoint_index]['schedules']);
        }

        $_SESSION['cart']['shippings_extra']['yd']['index'][$group_key][$shipping_id] = $delivery_index;
        $_SESSION['cart']['shippings_extra']['yd']['pickup_index'][$group_key][$shipping_id] = $pickuppoint_index;
        $_SESSION['cart']['shippings_extra']['yd']['data'][$group_key][$shipping_id] = $response['data'][$delivery_index];
        $_SESSION['cart']['shippings_extra']['yd']['package_size'][$group_key] = YandexDelivery::getSizePackage($this->_shipping_info['package_info'], $this->_shipping_info['service_params']);

        return true;
    }

    protected function convertCurrencies($price, $from_currency = 'RUB')
    {
        if (CART_PRIMARY_CURRENCY != $from_currency) {
            $currencies = Registry::get('currencies');

            if (isset($currencies[$from_currency])) {
                $currency = $currencies[$from_currency];
                $price = $price * floatval($currency['coefficient']);
                $price = fn_format_price($price, '', $currency['decimals']);
            }
        }

        return $price;
    }

    protected function findNearPickpoint($pickup_points)
    {
        $pickpints_near = $this->getNearPickpoints($pickup_points);
        $pickpints_near = array_keys($pickpints_near);

        return reset($pickpints_near);
    }

    protected function getNearPickpoints($pickup_points)
    {
        $address = !empty($this->_shipping_info['package_info']['location']['address']) ? trim($this->_shipping_info['package_info']['location']['address']) : '';
        $key = md5($this->_shipping_info['shipping_id'] . implode('_', $this->_shipping_info['service_params']['deliveries']) . $address . trim($this->_shipping_info['package_info']['location']['city']));
        $near_pickoints = fn_get_session_data($key);

        if (empty($near_pickoints)) {

            $address = preg_split('/[ ,]+/', $address);
            $address[] = trim($this->_shipping_info['package_info']['location']['city']);

            $url = "https://geocode-maps.yandex.ru/1.x/";
            $data = array(
                'geocode' => implode('+', $address),
                'format' => 'json',
                'results' => 2,
                'sco' => 'longlat'
            );

            $response = Http::post($url, $data);
            $response = json_decode($response, true);

            $response = $response['response']['GeoObjectCollection'];

            if ($response['metaDataProperty']['GeocoderResponseMetaData']['found'] > 0) {
                $object = reset($response['featureMember']);
                $object = $object['GeoObject'];

                $ll_address = explode(' ', $object['Point']['pos']);
            }


            $lat_pickoints = array();
            $lng_pickoints = array();
            $near_pickoints = array();
            foreach($pickup_points as $point) {
                $lat_pickoints[$point['id']] = $point['lat'];
                $lng_pickoints[$point['id']] = $point['lng'];
                $near_pickoints[$point['id']] = sqrt(pow($lat_pickoints[$point['id']] - $ll_address[1], 2) + pow($lng_pickoints[$point['id']] - $ll_address[0], 2));
            }

            asort($near_pickoints);

            fn_set_session_data($key, $near_pickoints, YD_CACHE_SESSION);
        }

        return $near_pickoints;
    }

    protected function sortByNearPoints($pickup_points)
    {
        $sort_pickup_points = array();
        $pickpints_near = $this->getNearPickpoints($pickup_points);

        foreach($pickpints_near as $point_id => $distance) {
            $sort_pickup_points[$point_id] = $pickup_points[$point_id];
        }

        return $sort_pickup_points;
    }

    public function prepareAddress($address)
    {
        
    }

    /**
     * Returns shipping service information
     * @return array information
     */
    public static function getInfo()
    {
        return array(
            'name' => __('carrier_yandex'),
            'tracking_url' => '#'
        );
    }
}
