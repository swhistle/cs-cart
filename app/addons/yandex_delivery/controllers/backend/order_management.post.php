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

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if (isset($_REQUEST['select_yd_store']) && !empty($_REQUEST['select_yd_store'])) {
    $_SESSION['cart']['select_yd_store'] = $_REQUEST['select_yd_store'];
}

if (isset($_SESSION['cart']['select_yd_store']) && !empty($_SESSION['cart']['select_yd_store'])) {
    Tygh::$app['view']->assign('select_yd_store', $_SESSION['cart']['select_yd_store']);
}
