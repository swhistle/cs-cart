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

if ($mode == 'get') {
    $schema = fn_get_schema('price_list', 'schema');

    if (empty($_REQUEST['display']) || empty($schema['types'][$_REQUEST['display']])) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    $class_name = '\Tygh\PriceList\\' . fn_camelize($_REQUEST['display']);
    if (class_exists($class_name)) {
        $generator = new $class_name;
        $filename = $generator->getFileName();
        if (file_exists($filename)) {
            fn_get_file($filename, 'price_list.' . $schema['types'][$_REQUEST['display']]['extension']);
        }
    }
}
