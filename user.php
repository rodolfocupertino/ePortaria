<?php
 use Illuminate\Database\Capsule\Manager as Capsule;

/*DEFAULT PAGE VARIABLES*/
$page_title         = 'Cadastro do Visitante'; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = true; //If true, require login to show
// $hide_menu          = true;

require_once ("header.php");

// dd($_SESSION['role']);

if ($_SESSION['role']==2){

	$msg->add("d", "Você não tem permissão para esse modulo." );
    redirect("/dashboard");

}


require 'controllers/UsersController.php';

$id = (int) $_GET['id'];

if ($action == "edit") {
	$user = User::find($id);
}

$formpage = "user";

?>
<form role="form" class="ls-form ls-form-inline row" data-ls-module="form" name="templateform" id="templateform" action="/<?=filename($_SERVER["PHP_SELF"]); ?>"  method="post">
	<input type="hidden" value="<?=$user->id;?>" name="id">
	<input type="hidden" id="foto_insert" name="foto_insert" value="">
	<input type="hidden" value="<?=$action;?>" name="action">
	<input type="hidden" value="<?=$action;?>" name="dbaction">
	<input type="hidden" value="<?=$_SESSION['user_id'];?>" name="user_id">
	<? include ("includes/action_bar.php"); ?>
	<p><?=$msg->display();?></p>

	<fieldset>
		 <label class="ls-label col-md-5">
		    <b class="ls-label-text">Nome</b>
		    <input type="text" id="nome" name="nome" value="<?=$user->name;?>" placeholder="Nome e sobrenome" required >
		 </label>
		 <label class="ls-label col-md-4">
		    <b class="ls-label-text">Grupo</b>
			    <div class="ls-custom-select">
					   <?php
					   		 $roles = Roles::orderBy('created_at','DESC')->take(15)->get();

					   		 // foreach ($roles as $role) {
					   		 // 	$a_roles = 
					   		 // }


						     // $a_data = array('Admin', 'Operador');
						     // echo PopulateSelectFromArray($roles,'role_id',$user->role_id);
					    ?>
				</div>
		 </label>

		 <label class="ls-label col-md-3">
		    <b class="ls-label-text">Login</b>
		    <input type="text" id="username" name="username" value="<?=$user->username;?>" placeholder="login" required >
		 </label>

		 <label class="ls-label col-md-4">
		    <b class="ls-label-text">Senha</b>
		    <input type="text" id="password" name="password" value="" placeholder="" required >
		 </label>
	</fieldset>
</form>

<?php include( 'footer.php' );