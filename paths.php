<?php 

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = urldecode($uri);

/*DEFINE PATHS*/
// define(CLIENTS_FOLDER, ROOT .'clients/'); //Clients root folder, if you wanna use it

define('APP_ROOT', __DIR__.'/');

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

// echo ;
// $requested = $paths['public'].$uri;

