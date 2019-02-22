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
	<p><?=$msg->display();?></p>

 		    <form role="form"  data-ls-module="form" name="templateform" id="templateform" action="/<?=filename($_SERVER["PHP_SELF"]); ?>"  method="post">
				<input type="hidden" value="<?=$visitante->id;?>" name="id">
				<input type="hidden" id="foto_insert" name="foto_insert" value="">
	            <input type="hidden" value="<?=$action;?>" name="action">
	            <input type="hidden" value="<?=$action;?>" name="dbaction">
	            <input type="hidden" value="<?=$_SESSION['user_id'];?>" name="user_id">
	            <? include ("includes/action_bar.php"); ?>

				<div class="form-group">
					<div class="col-sm-4">
					    <label for="exampleInputEmail1">Nome</label>
					    <input type="text" id="nome" name="nome" class="form-control input-lg" value="<?=$visitante->nome;?>" placeholder="Nome e sobrenome" required >
				    </div>
				    <div class="col-sm-2">
					    <label for="exampleInputEmail1">Doc. Identidade (RG)</label>
					    <input type="text" id="rg" name="rg" class="form-control input-lg" value="<?=$visitante->rg;?>" placeholder="RG" required >
					</div>
					<div class="col-sm-2">
					    <label for="exampleInputEmail1">Telefone</label>
					    <input type="text" id="telefone" name="telefone" class="form-control input-lg" value="<?=$visitante->telefone;?>" placeholder="(99) 9999-9999" required >
					</div>
					<div class="col-sm-2">
					    <label for="exampleInputEmail1">Veiculo</label>
					    <?php
								     $a_data = array('Carro' => 'Carro' , 'Moto' => 'Moto', 'caminhao' => 'Caminhão', 'onibus' => 'Ônibus'   );
								     echo PopulateSelectFromArray($a_data,'tipo_veiculo',$visitante->tipo_veiculo);
							    ?>
					</div>
					<div class="col-sm-2">
					    <label for="exampleInputEmail1">Placa</label>
				  		<input type="text" id="placa_veiculo" name="placa_veiculo" class="form-control input-lg" value="<?=$visitante->placa_veiculo;?>" placeholder="XXX-XXXX" >
					</div>
				</div>
				<br><br><br><br><br><br>

				<div class="form-group">
				 	<div class="col-sm-4">
					    <label for="exampleInputEmail1">Obs</label>
					    <textarea rows="4"  id="obs" name="obs" class="form-control input-lg"><?=$visitante->obs;?></textarea>
					</div>
					<div class="col-sm-4">
					    <label for="exampleInputEmail1">Foto</label>
					    <? if ($action=="new") {?>
							<b class="ls-label-text">Obs</b>
									<!-- <input type=button value="Configiurar ..." onClick="webcam.configure()"> -->
									<!-- <input type=button class="ls-btn-lg ls-btn-primary ls-ico-plus" value="Capturar Foto" onClick="take_snapshot()"> -->
									<button type="button" id="new-btn" onClick="take_snapshot()" class="btn btn-lg btn-primary">Capturar Foto</button>
									<div class="well"> <div id="canvas_results"></div> </div>
						<? } ?>
					</div>
					<div class="col-sm-4">
					    <label for="exampleInputEmail1">Foto Capturada</label>
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


		</form>

<script type="text/javascript" src="/js/webcam.js"></script>
<script language="JavaScript">
	webcam.set_api_url( '/camupload.php' );
	// webcam.set_swf_url( '/webcam.swf' );
	webcam.set_quality( 100 ); // JPEG quality (1 - 100)
	webcam.set_shutter_sound( false ); // play shutter click sound

	// document.write( webcam.get_html(320, 240) );
	document.getElementById('canvas_results').innerHTML = webcam.get_html(320, 240);

	webcam.set_hook( 'onComplete', 'my_completion_handler' );

	function take_snapshot() {
		// take snapshot and upload to server
		// Monstra a foto no upload_results
		// document.getElementById('upload_results').innerHTML = '<h1>Carregando...</h1>';
		webcam.snap();
		//console.log('snapshotted');
	}

	function my_completion_handler(msg) {

		// alert(msg);
		// Monstra a foto no upload_results
		document.getElementById('upload_results').innerHTML = '<br><br><img src="/storage/images/' + msg + '">';
		document.getElementById('foto_insert').value =  msg;

		webcam.reset();
	}
</script>

<!-- Usage as a class -->
<div class="clearfix"></div>

<?php include( 'footer.php' );