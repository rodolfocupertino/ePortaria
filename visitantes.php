<?php
use Illuminate\Database\Capsule\Manager as Capsule;

/*DEFAULT PAGE VARIABLES*/
$page_title         = 'Visitantes'; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = true; //If true, require login to show

require_once "header.php";

$search = $_REQUEST['q'];

$formpage = "visitante";
include ("includes/action_bar.php");

?>
<div class="row">
<p><?=$msg->display();?></p>
  <table id="listdata" class="display table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <!-- <th class="ls-txt-center"><input type="checkbox"></th> -->
          <!-- <th class="ls-data-descending">Código</th> -->
          <th class="ls-data-descending">Nome</th>
          <th class="hidden-xs">Telefone</th>
          <th class="hidden-xs">RG</th>
          <th class="hidden-xs">Cadastro</th>
          <th class="hidden-xs">Foto</th>
          <th class="ls-table-actions"></th>
        </tr>
      </thead>
      <tbody>
      <? 
          $visitantes = Visitante::orderBy('created_at','DESC')->get();
          foreach ($visitantes as $visitante) {
      ?>
          <tr>
              <!-- <td class="ls-txt-center"><input type="checkbox" name="bulk_delete[]" value="<?=$visitante->id?>" id="cb-select-<?=$visitante->id?>"></td> -->
              <!-- <td><?=$visitante->id?></td> -->
              <td><?=$visitante->nome;?></td>
              <td class="center hidden-phone"><?=$visitante->telefone?></td>
              <td class="center hidden-phone"><?=$visitante->rg?></td>
              <td class="center hidden-phone"><?=formataDataHora($visitante->created_at);?></td>
              <td class="center hidden-phone">
              <?
                if (!empty($visitante->foto)) {
                    $mostrar_foto = "<img src=\"/storage/images/$visitante->foto\"  alt=\"$visitante->nome\" class=\"img-thumbnail\" width=\"90\" >";
                } else {
                   $mostrar_foto = '';
                }

                echo $mostrar_foto;
              ?>

              </td>
              <td class="center">

              <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  Ações <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="/<?=$formpage?>/edit/<?=$visitante->id;?>">Editar</a></li>
                  <li><a href="/visita/new/<?=$visitante->id;?>">Registrar Visita</a></li>
                  <li><a href="/<?=$visitante->id;?>" class="ls-color-danger ls-divider">Relatório do Visitante</a></li>
                  <li class="divider"></li>
                  <li><a href="/<?=$formpage?>/delete/<?=$visitante->id;?>" class="ls-color-danger ls-divider" onclick="return confirm('Tem certeza que deseja remover?');">Remover</a></li>
                </ul>
              </div>

               <!--  <a data-toggle="modal" class="" href="/<?=$formpage?>/edit/<?=$visitante->id?>" data-target="#ModalForm">Editar</a>
                <a href="/<?=$formpage?>/delete/<?=$visitante->id?>" data-confirm-text="Confirma exclusão do item?" class="text-danger">Excluir</a> -->
              </td>
          </tr>
<? } ?>
      </tbody>
    </table>
</div>

<?php include( 'footer.php' );