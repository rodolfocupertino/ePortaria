<?php
/*DEFAULT PAGE VARIABLES*/
$page_title         = "Logout"; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = false; //If true, require login to show
$hide_menu          = true;

require_once("header.php");
require_once('includes/class.messages.php');
$msg = new Messages();

// sec_session_start();
$_SESSION = array();
unset($_SESSION['expire']);

$params = session_get_cookie_params();

// Delete the actual cookie.
setcookie(session_name(),
        '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]);

session_destroy();
redirect("/login");

?>