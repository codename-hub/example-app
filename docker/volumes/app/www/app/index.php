<?php

// override environment
// define('CORE_ENVIRONMENT', 'dev');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

mb_language('uni');
mb_internal_encoding('UTF-8');

require_once '../src/bootstrap.php';
(new \examplevendor\example\app())->run();
