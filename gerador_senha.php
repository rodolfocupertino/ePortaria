<?php

	// include ("config.php");
	// include ("includes/dbconnect.php");
	include ("includes/functions.php");

	// session_start();
	// session_regenerate_id(true);

	// require_once('includes/class.messages.php');
 //  	$msg = new Messages();

	// /*** set a form token ***/
	// $token = md5(rand(time(), true));
 //  	/*** set the session form token ***/
 //  	$_SESSION['token'] = $token;
	// $dbaction 		= (string) $_POST['action'];

 //  	$username='admin';

	$password=generateHash('cmr');

	echo $password;

//cadastrar o usuário básico do sistema.
// user: admin
// senha: suporte

	// try {

	// 		    $user_default = $pdo->prepare("INSERT INTO users ( username, password ) VALUES(?,?) ");
	// 		    $user_del = $pdo->prepare("DELETE FROM users");

	// 		    try {

	// 		        $pdo->beginTransaction();
	// 		        $user_del->execute();
	// 		        $user_default->execute( array(  $username, $password ) );
	// 		        $lastId=$pdo->lastInsertId();

	// 		        $pdo->commit(); 
	// 		        echo ("Gravado com Sucesso");

	// 		    } catch(PDOExecption $e) { 
	// 		        $pdo->rollback(); 
	// 		        echo ( $e->getMessage() );
	// 		    }

	// 		} catch( PDOExecption $e ) { 
	// 			echo ( $e->getMessage() );
	// 		} 

?>