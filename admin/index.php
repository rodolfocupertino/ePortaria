<?php

use Illuminate\Database\Capsule\Manager as Capsule;

/*DEFAULT PAGE VARIABLES*/
$page_title         = 'Home'; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = true; //If true, require login to show

require_once "header.php";

?>
<div class="row">
<p><?=$msg->display();?></p>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><i class="fa fa-fw fa-check"></i> Resumo</h4>
            </div>
            <div class="panel-body">
                <p><span class="badge">42</span> Serviço(s)</p>
                <p><span class="badge">42</span> Faturas</p>
                <p><span class="badge">42</span> Chamado(s)</p>
                <!-- <a href="#" class="btn btn-default">Saiba mais</a> -->
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><i class="fa fa-fw fa-gift"></i> Móveis Prontos</h4>
            </div>
            <div class="panel-body">
                <p>Acesse nosso link de produtos e veja os móveis que fazem sucesso nas residências e empresas pelo brasil.</p>
                <a href="#" class="btn btn-default">Saiba mais</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><i class="fa fa-fw fa-compass"></i> Empresas</h4>
            </div>
            <div class="panel-body">
                <p>A Imperat tem a melhor equipe para desenvolver o projeto de sua empresa, criando móveis de alta qualidade com as melhores matérias primas existentes, com garantia, entre em contato hoje mesmo.</p>
                <a href="#" class="btn btn-default">Saiba mais</a>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<?php include ABSPATH . 'admin/footer.php';