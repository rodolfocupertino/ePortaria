<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$require_login      = false; //If true, require login to show

include 'paths.php';

include ( ABSPATH . "includes/init.php" );

//Clean the session
$_SESSION = array();
session_regenerate_id(true);

require_once('includes/class.messages.php');
$msg = new Messages();

/*** set a form token ***/
$token = md5(rand(time(), true));

/*** set the session form token ***/
$_SESSION['token'] = $token;

$inputlogin = ( isset($_POST["username"]) ) ? $_POST["username"] : null;
$inputpassword = ( isset($_POST["password_field"]) ) ? $_POST["password_field"] : null;

if ( $user = User::where('username', '=', $inputlogin)->count() == 1) {

	$user = User::where('username', '=', $inputlogin)->firstOrFail();

// Get the query log.
// $queries = $capsule->connection()->getQueryLog();
// dd($queries);


	if ( validate_pw($inputpassword, $user->password) ) {



		$user_role = RolesUsers::find($user->id);

		$session = new Session;
		$session->time = strtotime('NOW') - (30 * 180);
		$session->token = $token;
		$session->save();

		// set timeout to logout
		$_SESSION['timeout_logout']= time();
		$_SESSION['expire'] = time()+1*60;

		$_SESSION['login'] 		= $user->username;
		$_SESSION['username'] 	= $user->username;
		$_SESSION['name'] 		= $user->name;
		$_SESSION['user_id']  	= $user->id;
		// $_SESSION['is_admin'] 	= true;
		$_SESSION['role'] = $user_role->role_id;

		// dd($_SESSION['role']);

		// dd($_SESSION['role']);

		redirect('dashboard');

	}

	else {
		$msg->add("d", "Usuário ou senha inválidos." );
		redirect("login");

	}

} else {
	$msg->add("d", "Usuário não existe." );
	redirect("login");

}
?>