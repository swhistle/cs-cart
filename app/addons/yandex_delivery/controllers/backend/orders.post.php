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
use Tygh\Shippings\YandexDelivery\YandexDelivery;

if (!defined('BOOTSTRAP')) { die('Access denied'); }


if ($mode == 'details') {
    $order_id = empty($_REQUEST['order_id']) ? 0 : $_REQUEST['order_id'];
    $yd_order_statuses = fn_yandex_delivery_get_order_statuses($order_id);
    
    Tygh::$app['view']->assign('yd_order_statuses', $yd_order_statuses);

    $order_info = Tygh::$app['view']->getTemplateVars('order_info');
    $carriers = Tygh::$app['view']->getTemplateVars('carriers');

    $yd = YandexDelivery::init();

    if (!$yd->checkInit()) {
        unset($carriers['yandex']);

        Tygh::$app['view']->assign('carriers', $carriers);
    }
}
