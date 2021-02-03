<?php
//Database Parameters
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'php_assignment');

define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', 'http://localhost/php_assignment');
define('SITE_NAME', 'PHP Assignment');

ini_set('SMTP', 'mail.sholden.educationhost.cloud');
ini_set('smtp_port', 25);

//declare(strict_types = 0);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);