<?php
use Illuminate\Database\Capsule\Manager as Capsule;

/*DEFAULT PAGE VARIABLES*/
$page_title         = 'Usuários'; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = true; //If true, require login to show

require_once "header.php";

// dd($_SESSION['role']);

checkRole($_SESSION['role']);


$search = $_REQUEST['q'];

  $formpage = "user";
  include ("includes/action_bar.php");
?>

<p><?=$msg->display();?></p>

	 <form action="<?=$files_path . "visitante" ?>" class="ls-form ls-form-horizontal row" role="form" method="post">
        <input type="hidden" value="bulk_delete" name="action">

          <table id="listdata" class="display table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <!-- <th class="ls-txt-center"><input type="checkbox"></th> -->
                  <!-- <th class="ls-data-descending">Código</th> -->
                  <th class="ls-data-descending">Nome</th>
                  <th class="hidden-xs">login</th>
                  <th class="ls-table-actions"></th>
                </tr>
              </thead>
              <tbody>
              <?
                  if(!empty($search)){

                      $search = '%'.$search.'%';
                      $users = User::whereRaw('id LIKE ? OR nome LIKE ? OR telefone LIKE ? OR rg LIKE ?',
                                          array($search,$search,$search,$search) )->orderBy('created_at','DESC')->take(15)->get();
                  } else {
                      $users = User::orderBy('created_at','DESC')->take(15)->get();
                  }

                  foreach ($users as $user) {
              ?>
                  <tr>
                      <td><a data-toggle="modal" class="" href="<?=$formpage?>/edit/<?=$user->id?>" data-target="#ModalForm"><?=$user->name;?></a></td>
                      <td class="center hidden-phone"><?=$user->username?></td>
                      <td class="center">

                      <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          Ações <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="/<?=$formpage?>/edit/<?=$user->id;?>">Editar</a></li>
                          <li class="divider"></li>
                          <li><a href="/<?=$formpage?>/delete/<?=$user->id;?>" class="ls-color-danger ls-divider" onclick="return confirm('Tem certeza que deseja remover?');" >Remover</a></li>
                        </ul>
                      </div>

                      </td>
                  </tr>
 <? } ?>
              </tbody>
            </table>
      </form>

<?php include( 'footer.php' );