<?php
$pagina = end(explode("/", $_SERVER['PHP_SELF']));

$pagina = preg_replace('/\.php$/','',$pagina);
// d($pagina);

$curdir = dirname($_SERVER['REQUEST_URI']);

// if (!empty($_SESSION['token'])) {

// 	// d($_SESSION['token']);
// 	// d($_SESSION['expire']);
// 	if (isset($_SESSION['expire'])) {
// 		if(time() > $_SESSION['expire']){
// 		 // $user -> logout();
// 		 unset($_SESSION['expire']);
// 		 d('Entrou  '. $_SESSION['expire']);
// 		 redirect('/logout');
// 		}
// 	}
// }

//verifica a sessão
if ( !isset($_SESSION['username']) ){

	if ( !isset($require_login) ) {

		if ( $is_admin==1 && $_SESSION['permission']==1 ) {
			session_start();
			session_unset();
			session_destroy();
				  redirect("/login");
		} else {

		  session_start();
			session_unset();
			session_destroy();
			redirect('/login');
		 }

	}
} else {

}

if ( isset($_SESSION['role']) ){
	$role_apps = RolesApps::find($_SESSION['role']);
	$apps = App::find($role_apps->app_id);
	foreach ($apps as $app) {
		// d($app->app);
	}

// Get the query log.
$queries = $capsule->connection()->getQueryLog();
// d($queries);

}

function checkRole($role_id) {

	global $msg;

	if ($role_id==2){
		$msg->add("d", "Você não tem permissão para esse modulo." );
	    redirect("/dashboard");
	    return false;
	}


}

function session_timeout_ok() {
	global $capsule;

    $timeout = SESSION_TIMEOUT; //const, e.g. 6 * 60 for 6 minutes

    $token = $_SESSION['token'];
    
    $ok = false;

    $session = Session::where('token' , '=', $token)->first();
    d($_SESSION['token']);

// Get the query log.
$queries = $capsule->connection()->getQueryLog();
d($queries);

// $c = DB::delete( "DELETE FROM {$config['table']} WHERE last_activity < ( UNIX_TIMESTAMP() - 60 * {$config['lifetime']})" );

dd();

    // dd($session);

    if (empty($session)) {
    	// dd('Mostrou null');
        //Timestamp could not be read
        $ok = FALSE;
    }
    else {
        //Timestamp was read succesfully
        if ($user = Session::where('token' , '=', $token)->count() > 0) {
            // $zeile = $rows[0];
            // $time_past = $zeile['time'];
            // 
            
            if ( $timeout + $time_past < time() ) {
                //Time has expired
                session_destroy();
                $sql = "DELETE FROM sessions WHERE session_id = '" . $session_id . "'";
                $affected = $db -> query($sql);
                $ok = FALSE;
            }
            else {
                //Time is okay
                $ok = TRUE;
                $sql = "UPDATE sessions SET time='" . time() . "' WHERE session_id = '" . $session_id . "'";
                $erg = $db -> query($sql);
                if ($erg == false) {
                    //DB error
                }
            }
        }
        else {
            //Session is new, write it to database table sessions
            $sql = "INSERT INTO sessions(session_id,time) VALUES ('".$session_id."','".time()."')";
            $res = $db->query($sql);
            if ($res === FALSE) {
                //Database error
                $ok = false;
            }
            $ok = true;
        }
        return $ok;
    }
    return $ok;
}

 // session_timeout_ok();

