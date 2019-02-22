<?php

$dbaction 		= (string) $_POST['action'];
$id				= (int) $_POST["id"];
$client_id		= (int) $_POST["client_id"];

 // d($_REQUEST);
 // 
 // d(generateHash('suporte'));

if ($dbaction == "new") {

	$user = new User;

	$user->name = $_POST["name"];
	$user->username = $_POST["username"];
	$user->password = generateHash($_POST["password"]);
	$user->email = $_POST["email"];
	$user->status = '1';
	$user->save();
	
    $msg->add("s", "Gravado com Sucesso" );
    redirect("/visitas");

}

if ($dbaction == "edit") {

	// $user = VisitantesVisita::find( $_POST["id"] );

	// $user->nome = $_POST["nome"];
	// $user->rg = $_POST["rg"];
	// $user->telefone = $_POST["telefone"];
	// $user->obs = $_POST["obs"];
	// $user->save();

	// $msg->add("s", "Gravado com Sucesso" );

	// // d($_REQUEST);
 //    redirect("/Visitas");
}

if ($action == "delete") {

	// dd($_GET);

		$user = VisitantesVisita::find( $_GET["id"] );


		// if (!empty($user->foto)) {
		// 	// dd($user->foto);
		// 	unlink('storage/images/'.$user->foto);
		// }

		$user->delete();

		$msg->add("s", "Apagado com Sucesso" );

		// d($_REQUEST);
	    redirect("/Visitas");
}

if ($dbaction == "bulk_delete" ) {

	// $total_deleted = count( $_POST['bulk_delete'] );
	// foreach( $_POST['bulk_delete'] as $bulk_delete_id ) {
	// 	$user = VisitantesVisita::find($bulk_delete_id);
	// 	$user->delete();

	// }
	// 	$msg->add("s", $total_deleted . " excluido(s) " );
	// 	redirect("/Visitas");

}

if ($action == "saida") {

	// d('entrou saida');

	$user = VisitantesVisita::find( $_GET["id"] );
	$user->saida = date('Y-m-d H:i:s');
	$user->save();

	$msg->add("s", "Saida registrada com sucesso as " . formataDataHora(date('Y-m-d H:i:s'),1) );
    redirect("/visitas");

}
