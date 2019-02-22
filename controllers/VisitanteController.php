<?php

$dbaction 		= (string) $_POST['action'];
$id				= (int) $_POST["id"];
$client_id		= (int) $_POST["client_id"];

// d($_REQUEST);

if ($dbaction == "new") {

	$visitante = new Visitante;


	$visitante->nome = $_POST["nome"];
	$visitante->rg = $_POST["rg"];
	$visitante->telefone = $_POST["telefone"];
	$visitante->obs = $_POST["obs"];
	$visitante->foto = $_POST["foto_insert"];
	$visitante->tipo_veiculo = $_POST["tipo_veiculo"];
	$visitante->placa_veiculo = $_POST["placa_veiculo"];
	$visitante->save();
	
    $msg->add("s", "Gravado com Sucesso" );
    redirect("/visitantes");

}

if ($dbaction == "edit") {

	checkRole($_SESSION[role]);

	$visitante = Visitante::find( $_POST["id"] );

	$visitante->nome = $_POST["nome"];
	$visitante->rg = $_POST["rg"];
	$visitante->telefone = $_POST["telefone"];
	$visitante->obs = $_POST["obs"];
	$visitante->tipo_veiculo = $_POST["tipo_veiculo"];
	$visitante->placa_veiculo = $_POST["placa_veiculo"];

	$visitante->save();

	$msg->add("s", "Gravado com Sucesso" );

	// d($_REQUEST);
    redirect("/visitantes");
}

if ($action == "delete") {

		checkRole($_SESSION[role]);

		$visitante = Visitante::find( $_GET["id"] );


		
		if (!empty($visitante->foto)) {
			// dd($visitante->foto);
			unlink('storage/images/'.$visitante->foto);
		}

		$visitante->delete();

		$msg->add("s", "Apagado com Sucesso" );

		// d($_REQUEST);
	    redirect("/visitantes");
}

if ($dbaction == "bulk_delete" ) {

	checkRole($_SESSION[role]);

	$total_deleted = count( $_POST['bulk_delete'] );
	foreach( $_POST['bulk_delete'] as $bulk_delete_id ) {
		$visitante = Visitante::find($bulk_delete_id);
		$visitante->delete();

	}
		$msg->add("s", $total_deleted . " excluido(s) " );
		redirect("/visitantes");

}

if ($dbaction == "saida") {

	$visitante = Visitante::find( $_POST["id"] );
	$visitante->saida = date('Y-m-d H:i:s');
	$visitante->save();

	$msg->add("s", "Gravado com Sucesso" );
    redirect("/visitantes");

}
