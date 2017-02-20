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

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

$cart = & Tygh::$app['session']['cart'];
$params = $_REQUEST;

if ($mode == 'cart') {
    if (!empty(\Tygh::$app['session']['geocity']) && empty($cart['user_data']['user_id'])) {
        $city_geolocation = \Tygh::$app['session']['geocity'];
        $list_cities = fn_rus_geolocation_select_cities($city_geolocation);

        if (!empty($list_cities['city'])) {
            $cart['user_data']['b_city'] = $list_cities['city'];
            $cart['user_data']['s_city'] = $list_cities['city'];
            $cart['user_data']['b_county'] = $list_cities['code'];
            $cart['user_data']['s_county'] = $list_cities['code'];
            $cart['user_data']['b_state'] = $list_cities['state_code'];
            $cart['user_data']['s_state'] = $list_cities['state_code'];
        }
    }
}
