<?php

session_start();

error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'] . '/config.php');
include($_SERVER['DOCUMENT_ROOT'] . '/core.php');

//$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//var_dump($uri);

$router = new \classes\router();

//$router->start();

$request = \Classes\Request::createFromGlobals();
//$response = $router->handle($request);
$router->handle($request);
// var_dump($request->post);
// echo "<br>";
// echo "<br>";
// var_dump($request->get);
// echo "<br>";
// echo '<pre>';
// var_dump($request->server);
// echo '</pre>';
