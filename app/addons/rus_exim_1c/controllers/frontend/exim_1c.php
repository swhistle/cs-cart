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
use Tygh\Commerceml\Logs;
use Tygh\Commerceml\RusEximCommerceml;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

$params = $_REQUEST;
$type = $mode = $service_exchange = '';
if (isset($params['type'])) {
    $type = $params['type'];
}

if (isset($params['mode'])) {
    $mode = $params['mode'];
}

if (isset($params['service_exchange'])) {
    $service_exchange = $params['service_exchange'];
}

$manual = !empty($params['manual']);

RusEximCommerceml::$import_params['service_exchange'] = $service_exchange;
RusEximCommerceml::$import_params['manual'] = $manual;

list($cml, $s_commerceml) = RusEximCommerceml::getParamsCommerceml();
$log = new Logs(RusEximCommerceml::$path_file);

if (RusEximCommerceml::checkParameterFileUpload()) {
    exit;
}

$s_commerceml = RusEximCommerceml::getCompanySettings();

$filename = (!empty($params['filename'])) ? fn_basename($params['filename']) : '';
$lang_code = (!empty($s_commerceml['exim_1c_lang'])) ? $s_commerceml['exim_1c_lang'] : CART_LANGUAGE;

RusEximCommerceml::getDirCommerceML('exim/1C_' . date('dmY') . '/');
RusEximCommerceml::$import_params['lang_code'] = $lang_code;

if ($type == 'catalog') {
    if ($mode == 'checkauth') {
        RusEximCommerceml::exportDataCheckauth($service_exchange);

    } elseif ($mode == 'init') {
        RusEximCommerceml::exportDataInit();

    } elseif ($mode == 'file') {
        if (RusEximCommerceml::createImportFile($filename) === false) {
            fn_echo("failure");
            exit;
        }

        fn_echo("success\n");

    } elseif ($mode == 'import') {
        $fileinfo = pathinfo($filename);

        list($xml, $d_status, $text_message) = RusEximCommerceml::getFileCommerceml($filename);
        RusEximCommerceml::addMessageLog($text_message);
        if ($d_status === false) {
            fn_echo("failure");
            exit;
        }

        if (strpos($fileinfo['filename'], 'import') !== false) {
            if ($s_commerceml['exim_1c_import_products'] != 'not_import') {
                RusEximCommerceml::importDataProductFile($xml);
            } else {
                fn_echo("success\n");
            }
        }

        if (strpos($fileinfo['filename'], 'offers') !== false) {
            if ($s_commerceml['exim_1c_only_import_offers'] == 'Y') {
                RusEximCommerceml::importDataOffersFile($xml, $service_exchange, $lang_code, $manual);
            } else {
                fn_echo("success\n");
            }
        }
    }

} elseif (($type == 'sale') && (RusEximCommerceml::$import_params['user_data']['user_type'] != 'V') && ($s_commerceml['exim_1c_check_prices'] != 'Y')) {
    if ($mode == 'checkauth') {
        RusEximCommerceml::exportDataCheckauth($service_exchange);

    } elseif ($mode == 'init') {
        RusEximCommerceml::exportDataInit();

    } elseif ($mode == 'file') {
        if (RusEximCommerceml::createImportFile($filename) === false) {
            fn_echo("failure");
            exit;
        }

        if (($s_commerceml['exim_1c_import_statuses'] == 'Y') && !empty($filename)) {
            list($xml, $d_status, $text_message) = RusEximCommerceml::getFileCommerceml($filename);
            RusEximCommerceml::addMessageLog($text_message);
            if ($d_status === false) {
                fn_echo("failure");
                exit;
            }

            RusEximCommerceml::importFileOrders($xml, $lang_code);
        }

        fn_echo("success\n");

    } elseif ($mode == 'query') {
        if ($s_commerceml['exim_1c_all_product_order'] == 'Y') {
            RusEximCommerceml::exportAllProductsToOrders($lang_code);
        } else {
            RusEximCommerceml::exportDataOrders($lang_code);
        }

    } elseif ($mode == 'success') {
        fn_echo("success");
    }
}

exit;
