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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if ($mode == 'cancel' && !empty($_REQUEST['yandex_ids']) && is_array($_REQUEST['yandex_ids'])) {
        fn_yandex_delivery_cancel_orders($_REQUEST['yandex_ids']);
        
    } elseif ($mode == 'update' && !empty($_REQUEST['yandex_ids']) && is_array($_REQUEST['yandex_ids'])) {
        fn_yandex_delivery_update_orders($_REQUEST['yandex_ids']);

    } elseif ($mode == 'delete' && !empty($_REQUEST['yandex_ids'])) {
        fn_yandex_delivery_cancel_orders($_REQUEST['yandex_ids'], true);
    }

    if (!empty($_REQUEST['redirect_url'])) {
        return array(CONTROLLER_STATUS_REDIRECT, $_REQUEST['redirect_url']);
    }

    return array(CONTROLLER_STATUS_OK, 'yandex_delivery.manage');
}

if ($mode == 'manage') {
    list($yd_orders, $search) = fn_yandex_delivery_get_orders($_REQUEST, Registry::get('settings.Appearance.admin_elements_per_page'));
    $yd_order_statuses = fn_yandex_delivery_get_statuses();

    Tygh::$app['view']->assign('yd_orders', $yd_orders);
    Tygh::$app['view']->assign('yd_order_statuses', $yd_order_statuses);
    Tygh::$app['view']->assign('search', $search);
}
