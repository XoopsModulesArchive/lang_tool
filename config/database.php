<?php
if(!isset($xoopsOption)) {
    $xoopsOption['nocommon'] = 1;
    $xoops_path = dirname( dirname(dirname( dirname( __FILE__ ))));
    require_once( $xoops_path . '/mainfile.php' );
}
define('CAKE_DB_PREFIX', XOOPS_DB_PREFIX . '_');
class DATABASE_CONFIG {

    var $default = array(
        'driver' => XOOPS_DB_TYPE,
        'persistent' => false,
        'host' => XOOPS_DB_HOST,
        'port' => '',
        'login' => XOOPS_DB_USER,
        'password' => XOOPS_DB_PASS,
        'database' => XOOPS_DB_NAME,
        'schema' => '',
        'prefix' => CAKE_DB_PREFIX,
        'encoding' => ''
    );
}