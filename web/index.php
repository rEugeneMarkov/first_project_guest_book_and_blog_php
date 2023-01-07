<?php

session_start();

error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'] . '/config.php');
include($_SERVER['DOCUMENT_ROOT'] . '/core.php');
require(SITE_TEMP . '/vendor/autoload.php');

$router = new \classes\router();

$request = \Classes\Request::createFromGlobals();
$response = $router->handle($request);
//var_dump($response);
echo (string)$response;
