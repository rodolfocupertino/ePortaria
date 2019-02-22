<?php
use Illuminate\Database\Capsule\Manager as Capsule;

/*DEFAULT PAGE VARIABLES*/
$page_title         = 'Meus Serviços'; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = true; //If true, require login to show

require_once "header.php";

$search = $_REQUEST['q'];

$formpage = "visitante";
// include ("includes/action_bar.php");

?>
<div class="row">
<p><?=$msg->display();?></p>
  <table id="listdata" class="display table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <!-- <th class="ls-txt-center"><input type="checkbox"></th> -->
          <!-- <th class="ls-data-descending">Código</th> -->
          <th class="ls-data-descending">Serviço</th>
          <th class="hidden-xs">Preço</th>
          <th class="hidden-xs">Ciclo de Pgto</th>
          <th class="hidden-xs">Próximo Venc.</th>
          <th class="hidden-xs">Status</th>
          <th class="ls-table-actions"></th>
        </tr>
      </thead>
      <tbody>
      <? 
          $gdata = Servico::orderBy('created_at','DESC')->get();
          foreach ($gdata as $row) {
      ?>
          <tr>
              <td><?=$row->nome;?></td>
              <td class="center hidden-phone"><?=$row->telefone?></td>
              <td class="center hidden-phone"><?=$row->rg?></td>
              <td class="center hidden-phone"><?=formataDataHora($row->created_at);?></td>
              <td class="center hidden-phone">
              </td>
              <td class="center">

              <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  Ações <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="/<?=$formpage?>/view/<?=$row->id;?>">Detalhes</a></li>
                  <li class="divider"></li>
                  <li><a href="/servico/cancela/<?=$row->id;?>">Solicitar Cancelamento</a></li>
                </ul>
              </div>
              </td>
          </tr>
<? } ?>
      </tbody>
    </table>
</div>

<?php include( 'footer.php' );