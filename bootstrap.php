<?php
$_REQUEST['start'] = microtime(true);
$_REQUEST['instances'] = array();
session_start();

if(!array_key_exists('PHPSESSID', $_COOKIE)) {
        $_COOKIE['PHPSESSID'] = hash('sha512', time()); // TODO: unsafe!
}

define("CORE_WEBROOT", dirname(__FILE__) .'/../public/'); // NOTE: only in docker env!
define("CORE_VENDORDIR", dirname(__FILE__) . '/vendor/');

require_once __DIR__ . '/vendor/autoload.php';
