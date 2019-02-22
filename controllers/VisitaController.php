<?php

$dbaction 		= (string) $_POST['action'];
$id				= (int) $_POST["id"];
$client_id		= (int) $_POST["client_id"];

 // d($_REQUEST);

if ($dbaction == "new") {

	$visita = new VisitantesVisita;

	// d( $_POST["entrada"] );

	// d( date('Y-m-d H:i:s') );

	// dd(
	// 	date('Y-m-d H:i:s', strtotime($_POST["entrada"])  )
	// );

	$visita->visitante_id = $_POST["visitante_id"];
	$visita->entrada = date('Y-m-d H:i:s');
	$visita->veiculo_placa = $_POST["veiculo_placa"];
	$visita->cracha_numero = $_POST["cracha_numero"];
	$visita->obs = $_POST["obs"];
	$visita->sd_hora_entrada = $_SESSION["nome_sd"];
	
	$visita->save();
	
    $msg->add("s", "Gravado com Sucesso" );
    redirect("/visitas");

}

if ($dbaction == "edit") {

	// $visita = VisitantesVisita::find( $_POST["id"] );

	// $visita->nome = $_POST["nome"];
	// $visita->rg = $_POST["rg"];
	// $visita->telefone = $_POST["telefone"];
	// $visita->obs = $_POST["obs"];
	// $visita->save();

	// $msg->add("s", "Gravado com Sucesso" );

	// // d($_REQUEST);
 //    redirect("/Visitas");
}

if ($action == "delete") {

	// dd($_GET);

		$visita = VisitantesVisita::find( $_GET["id"] );


		// if (!empty($visita->foto)) {
		// 	// dd($visita->foto);
		// 	unlink('storage/images/'.$visita->foto);
		// }

		$visita->delete();

		$msg->add("s", "Apagado com Sucesso" );

		// d($_REQUEST);
	    redirect("/Visitas");
}

if ($dbaction == "bulk_delete" ) {

	// $total_deleted = count( $_POST['bulk_delete'] );
	// foreach( $_POST['bulk_delete'] as $bulk_delete_id ) {
	// 	$visita = VisitantesVisita::find($bulk_delete_id);
	// 	$visita->delete();

	// }
	// 	$msg->add("s", $total_deleted . " excluido(s) " );
	// 	redirect("/Visitas");

}

if ($action == "saida") {

	// d('entrou saida');

	$visita = VisitantesVisita::find( $_GET["id"] );
	$visita->saida = date('Y-m-d H:i:s');
	$visita->sd_hora_saida = $_SESSION["nome_sd"];
	$visita->save();

	$msg->add("s", "Saida registrada com sucesso as " . formataDataHora(date('Y-m-d H:i:s'),1) );
    redirect("/visitas");

}
