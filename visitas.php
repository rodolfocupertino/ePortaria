<?php
use Illuminate\Database\Capsule\Manager as Capsule;

/*DEFAULT PAGE VARIABLES*/
$page_title         = 'Registro de Visitas'; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = true; //If true, require login to show

require_once "header.php";

$search = $_REQUEST['q'];

?>
<?php 
  $formpage = "visita";
  include ("includes/action_bar.php");
?>

<p><?=$msg->display();?></p>

	 <form action="<?=$files_path . "visitante" ?>" class="ls-form ls-form-horizontal row" role="form" method="post">
        <input type="hidden" value="bulk_delete" name="action">

          <table id="listdata" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <!-- <th class="ls-txt-center"><input type="checkbox"></th> -->
                  <!-- <th class="ls-data-descending">Código</th> -->
                  <th class="hidden-xs">Visitante</th>
                  <th>Dt Entrada</th>
                  <th class="hidden-xs">Dt Saida</th>
                  <th class="hidden-xs">Crachá</th>
                  <th class="hidden-xs">Fone</th>
                  <th class="ls-table-actions"></th>
                </tr>
              </thead>
              <tbody>
<? 
    if(!empty($search)){

        $search = '%'.$search.'%';

        $visitas = VisitantesVisita::whereRaw('id LIKE ? OR entrada LIKE ? OR saida LIKE ? OR veiculo_placa LIKE ?',
                              array($search,$search,$search,$search) )->orderBy('created_at','DESC')->take(15)->get();
    } else {
        // d(date('Y-m-d'));
        $visitas = VisitantesVisita::has('visitante')->orderBy('created_at','DESC')->take(15)->get();
        // $visitas = VisitantesVisita::where('entrada','=', date('Y-m-d'))->has('visitante')->orderBy('created_at','DESC')->take(15)->get();

    }

    // d($visitas);

    foreach ($visitas as $visita) {

      // d($visita->visitante()->first()->nome);
?>
                  <tr>
                      <!-- <td class="ls-txt-center"><input type="checkbox" name="bulk_delete[]" value="<?=$visitante->id?>" id="cb-select-<?=$visitante->id?>"></td> -->
                      <!-- <td><a data-toggle="modal" class="" href="<?=$formpage?>/edit/<?=$visitante->id?>" data-target="#ModalForm"><?=$visita->entrada;?></a></td> -->

                      <td class="center hidden-phone"><?=$visita->visitante()->first()->nome;?></td>
                      <td class="center hidden-phone"><?=formataDataHora($visita->entrada);?></td>
                      <td class="center hidden-phone"><?=formataDataHora($visita->saida);?></td>
                      <td class="center hidden-phone"><?=$visita->cracha_numero;?></td>
                      <td class="center hidden-phone"><?=$visita->visitante()->first()->telefone;?></td>
                      <td class="center">
                        <? 

                          // d($visita->saida);

                          if (!empty($visita->saida) && ($visita->saida=="0000-00-00 00:00:00")) { ?>


                          <a data-toggle="modal" class="btn btn-danger" href="/<?=$formpage?>/saida/<?=$visita->id?>" onclick="return confirm('SOLICITOU A DEVOLUÇÃO DO CRACHÁ?');">Registrar Saída</a>
                          <!-- <button type="button" id="new-btn" onClick="take_snapshot()" class="btn btn-lg btn-primary">Capturar Foto</button> -->
                        <? } ?>
                        <!-- <a data-toggle="modal" class="" href="/<?=$formpage?>/edit/<?=$visita->id?>" data-target="#ModalForm">Editar</a> -->
                        <!-- <a href="/<?=$formpage?>/delete/<?=$visita->id?>" data-confirm-text="Confirma exclusão do item?" class="text-danger">Excluir</a> -->
                      </td>
                  </tr>
 <? } ?>
              </tbody>
            </table>
      </form>

<?php include( 'footer.php' );