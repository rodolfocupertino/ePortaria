<?php

if ( $action=="new" || $action=="edit" || $action=="cancel") {
	$disable_btn_novo = "disabled";
} else { 
  $disable_btn = "disabled";
}

	if ($_SERVER['PHP_SELF']!="/visitas.php") {
?>
<div class="btn-group" role="group" aria-label="...">
	  <a href="/<?=$formpage?>/new" class="btn btn-primary" <?=$disable_btn_novo?> >Novo</a>
	  <button type="button" class="btn btn-primary" onclick="history.go(-1);" <?=$disable_btn?>><?php echo ($action=='edit') ? 'Cancelar' : 'Cancelar'; ?> </button>
	  <button type="submit" class="btn btn-success" <?=$disable_btn?> ><?php echo ($action=='edit') ? 'Salvar' : 'Salvar'; ?> </button>
   <!-- <input type=button class="btn btn-shadow btn-primary ico-checkmark-circle" value="<?php echo ($action=='edit') ? 'Salvar Alterações' : 'Salvar'; ?>">  -->
</div>
<? } ?>