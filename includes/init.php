<?php

//initialize the session
if (!isset($_SESSION)) {
	session_start();
}

require ABSPATH . 'vendor/autoload.php';

require ABSPATH . 'config/database.php';

require ABSPATH . 'config/app.php';

require ABSPATH . 'includes/functions.php';

require ABSPATH . 'includes/security_check.php';

if ( !empty($_REQUEST["action"]) )   {
	$action = (string) $_GET["action"];
} else { 
	//$action = "new"; 
}