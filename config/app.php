<?php

//Good to development time
#error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR|E_PARSE);
ini_set('display_errors', 1 );

/*LOCALE AND TIMEZONE*/
setlocale(LC_ALL, 'pt_BR');
// date_default_timezone_set('America/Sao_Paulo');
date_default_timezone_set('America/Recife');
setlocale(LC_TIME, 'pt_BR.utf8');

//Default number of registers on a list
$register_per_page = 15;

/*MONITORING E-MAIL*/
//System send an email when an error occurs
$ALERT_EVENT_EMAIL[] = 'your@email.com';

//Always with / at the end
$HTTP = ($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';

if ( !defined('_MEMORY_LIMIT') )
	define('_MEMORY_LIMIT', '128M');
if ( function_exists('memory_get_usage') && ( (int) @ini_get('memory_limit') < abs(intval(_MEMORY_LIMIT)) ) )
	@ini_set('memory_limit', _MEMORY_LIMIT);


//Nome do Sistema
define( SYSTEM_NAME, "eFin" ); //The name of your system

/** Versão do sistema */
define("SYSTEM_VERSION","1.0");

/*EMAIL DEFINITIONS*/
//To use with the smtp send mail framework function
$MAIL['SMTP_PORT']     = 'smtp...com';
$MAIL['SMTP_HOST']     = 'your@email.com';
$MAIL['SMTP_USERNAME'] = 'pass';
$MAIL['SMTP_PASSWORD'] = '587';

?>