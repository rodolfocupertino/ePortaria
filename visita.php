<?php
 use Illuminate\Database\Capsule\Manager as Capsule;

/*DEFAULT PAGE VARIABLES*/
$page_title         = 'Registro da Visita'; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = true; //If true, require login to show
// $hide_menu          = true;

require_once ("header.php");

//Commit(PDO)
require 'controllers/VisitaController.php';

$id = (int) $_GET['id'];


if ($action == "new") {
	$visitante = Visitante::find($id);
}

// if ($action == "edit") {
// 	$visita = Visita::find($id);
// }

$formpage = "visita";
?>
	<p><?=$msg->display();?></p>

 		    <form role="form" data-ls-module="form" name="templateform" id="templateform" action="/<?=filename($_SERVER["PHP_SELF"]); ?>"  method="post">
				<input type="hidden" value="<?=$visitante->id;?>" name="visitante_id">
				<input type="hidden" value="<?=date('d/m/Y H:i:s');?>" name="entrada">
	            <input type="hidden" value="<?=$action;?>" name="action">
	            <input type="hidden" value="<?=$action;?>" name="dbaction">
	            <input type="hidden" value="<?=$_SESSION['user_id'];?>" name="user_id">
	            <? include ("includes/action_bar.php"); ?>

				<div class="form-group">
					<div class="col-sm-3">
					    <label for="exampleInputEmail1">Data Entrada</label>
					    <input type="text" class="form-control input-lg" value="<?=formataDataHora(date('Y-m-d H:i:s'),1);?>" disabled >
				    </div>
				    <div class="col-sm-3">
					    <label for="exampleInputEmail1">Nome</label>
					    <input type="text" id="nome" name="nome" class="form-control input-lg" value="<?=$visitante->nome;?>" placeholder="Nome e sobrenome" disabled >
				    </div>
				    <div class="col-sm-2">
					    <label for="exampleInputEmail1">Cracha</label>
					    <input type="text" id="cracha_numero" name="cracha_numero" class="form-control input-lg"  value="<?=$visita->cracha_numero;?>" placeholder=""  >

				    </div>
				</div>

				<br><br><br><br><br><br>

				<div class="form-group">
					<div class="col-sm-3">
					    <label for="exampleInputEmail1">Placa Veículo</label>
					    <input type="text" id="veiculo_placa" name="veiculo_placa" class="form-control input-lg" value="<?=$visita->veiculo_placa;?>" placeholder="" data-mask="000-0000" data-mask-clearifnotmatch="true" >

				    </div>
				    <div class="col-sm-4">
					    <label for="exampleInputEmail1">Obs</label>
						<textarea rows="5"  id="obs" name="obs" class="form-control input-lg" ><?=$visita->obs;?></textarea>

				    </div>
				    <div class="col-sm-4">
					    <label for="exampleInputEmail1">Cracha</label>
					    <? 
								if (!empty($visitante->foto)) {
			                            $mostrar_foto = "<img src=\"/storage/images/$visitante->foto\"  class=\"thumbnail\" width=\"320\" >";
			                        } else {
			                           $mostrar_foto = '';
			                    }
								// echo $mostrar_foto;
							?>	

							<div class="well">
								<div id="upload_results"><?=$mostrar_foto;?></div>
							</div>

				    </div>
				</div>

		</form>

<!-- Usage as a class -->
<div class="clearfix"></div>

<?php include( 'footer.php' );