<?php 
	
	// include_once ( ABSPATH . "includes/functions.php" );

$dbaction 		= (string) $_POST['action'];
$id				= (int) $_POST["id"];
$client_id		= (int) $_POST["client_id"];

// d($_POST);

if ($dbaction == "new") {

	$visitante = new Visitante;

	$visitante->nome = $_POST["nome"];
	$visitante->rg = $_POST["rg"];
	$visitante->telefone = $_POST["telefone"];
	$visitante->obs = $_POST["obs"];
	$visitante->foto = $_POST["foto_insert"];
	$visitante->save();

    $msg->add("s", _("Gravado com Sucesso") );
    redirect("visitantes");

}



if ($dbaction == "edit") {

	$visitante = Visitante::find( $_POST["id"] );

	$visitante->nome = $_POST["nome"];
	$visitante->rg = $_POST["rg"];
	$visitante->telefone = $_POST["telefone"];
	$visitante->obs = $_POST["obs"];
	$visitante->save();

	$msg->add("s", _("Gravado com Sucesso") );
    redirect("visitantes");
}

if ($dbaction == "delete") {

 //nothing to-do.
}

if ($dbaction == "bulk_delete" ) {

	$total_deleted = count( $_POST['bulk_delete'] );
	foreach( $_POST['bulk_delete'] as $bulk_delete_id ) {
		$visitante = Visitante::find($bulk_delete_id);
		$visitante->delete();

	}
		$msg->add("s", $total_deleted . " excluido(s) " );
		redirect("visitantes");

}

if ($dbaction == "saida") {

	$visitante = Visitante::find( $_POST["id"] );

	$visitante->saida = date('Y-m-d H:i:s');

	$visitante->save();
	//d("Registro $lastId gravado");
			        $msg->add("s", _("Saída gravada com Sucesso") );
			        //redirect("client/edit/$lastId");
			        redirect("visitantes");

}
