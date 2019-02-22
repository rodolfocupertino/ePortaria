<?php
 use Illuminate\Database\Capsule\Manager as Capsule;

/*DEFAULT PAGE VARIABLES*/
$page_title         = 'Cadastro do Visitante'; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = true; //If true, require login to show
// $hide_menu          = true;

require_once ("header.php");

//Commit(PDO)
require 'controllers/VisitanteController.php';

$id = (int) $_GET['id'];

if ($action == "edit") {
	$visitante = Visitante::find($id);
}

// d($_REQUEST);

$formpage = "visitante";
?>

<?php include_once ('includes/breadcrumbs.php'); ?>
    <h1 class="ls-title-intro ls-ico-users"><?=$page_title?></h1>

	<p><?=$msg->display();?></p>

 		    <form role="form" class="ls-form ls-form-inline row" data-ls-module="form" name="templateform" id="templateform" action="/<?=filename($_SERVER["PHP_SELF"]); ?>"  method="post">
				<input type="hidden" value="<?=$visitante->id;?>" name="id">
				<input type="hidden" id="foto_insert" name="foto_insert" value="">
	            <input type="hidden" value="<?=$action;?>" name="action">
	            <input type="hidden" value="<?=$action;?>" name="dbaction">
	            <input type="hidden" value="<?=$_SESSION['user_id'];?>" name="user_id">
	            <? include ("includes/action_bar.php"); ?>

				<fieldset>
					 <label class="ls-label col-md-5">
					    <b class="ls-label-text">Nome</b>
					    <input type="text" id="nome" name="nome" value="<?=$visitante->nome;?>" placeholder="Nome e sobrenome" required >
					 </label>

					 <label class="ls-label col-md-3">
					    <b class="ls-label-text">RG</b>
					    <input type="text" id="rg" name="rg" value="<?=$visitante->rg;?>" placeholder="RG" required >
					 </label>

					 <label class="ls-label col-md-4">
					    <b class="ls-label-text">Fone</b>
					    <input type="text" class="ls-mask-phone8_with_ddd" id="telefone" name="telefone" value="<?=$visitante->telefone;?>" placeholder="(99) 9999-9999" required >
					 </label>

					 <label class="ls-label col-md-4">
					    <b class="ls-label-text">Veículo</b>

					    <div class="ls-custom-select">
							   <?php
							    
							     $a_data = array('Carro' => 'Carro' , 'Moto' => 'Moto', 'caminhao' => 'Caminhão', 'onibus' => 'Ônibus'   );

							     echo PopulateSelectFromArray($a_data,'tipo_veiculo',$visitante->tipo_veiculo);

							    ?>
						</div>	    
					 </label>

					 <label class="ls-label col-md-4">
					    <b class="ls-label-text">Placa</b>
					    <input type="text" id="placa_veiculo" name="placa_veiculo" value="<?=$visitante->placa_veiculo;?>" placeholder="XXX-XXXX" required >
					 </label>

					<label class="ls-label col-md-4">
						<b class="ls-label-text">Obs</b>
						<textarea rows="1"  id="obs" name="obs" class="ls-textarea-autoresize"><?=$visitante->obs;?></textarea>
					</label>
</fieldset>

					<label class="ls-label col-md-4">
					    <? if ($action=="new") {?>
							<b class="ls-label-text">Obs</b>
									<!-- <input type=button value="Configiurar ..." onClick="webcam.configure()"> -->
									<!-- <input type=button class="ls-btn-lg ls-btn-primary ls-ico-plus" value="Capturar Foto" onClick="take_snapshot()"> -->
									<button type="button" id="new-btn" onClick="take_snapshot()" class="ls-btn-lg ls-btn-primary ls-ico-image">Capturar Foto</button>
									<div id="canvas_results"></div>
						<? } ?>

					 </label>

					 <label class="ls-label col-md-4">
					    <b class="ls-label-text">Capturada</b>
<? 
												if (!empty($visitante->foto)) {
							                            $mostrar_foto = "<img src=\"/storage/images/$visitante->foto\"  class=\"thumbnail\" width=\"320\" >";
							                        } else {
							                           $mostrar_foto = '';
							                    }

							                        // echo $mostrar_foto;
											?>	

												<div id="upload_results"><?=$mostrar_foto;?></div>
		</form>


<?php include( 'footer.php' );
