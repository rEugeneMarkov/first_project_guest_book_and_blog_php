<?php

session_start();

error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'] . '/config.php');
include($_SERVER['DOCUMENT_ROOT'] . '/core.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//var_dump($uri);

$router = new \classes\router($uri);

$router->start();
