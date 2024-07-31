<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$url_api = $_ENV['URL_API'];
$root    = $_SERVER['DOCUMENT_ROOT'];
$url     = $_SERVER["REQUEST_URI"];

$exp  = explode('/', $root);

$root = "http://localhost:8000";

define('ROOT', "$root/");
define('URL_API',   $url_api);
define('BASE_PATH', __DIR__);

?>