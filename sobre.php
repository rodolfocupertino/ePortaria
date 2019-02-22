<?php

use Illuminate\Database\Capsule\Manager as Capsule;

/*DEFAULT PAGE VARIABLES*/
$page_title         = 'Sobre'; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = true; //If true, require login to show

require_once "header.php";

?>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> Ferramentas</h4>
                    </div>
                    <div class="panel-body">
                        <p>--</p>
                        <a href="#" class="btn btn-default">Saiba mais</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i> Plataforma</h4>
                    </div>
                    <div class="panel-body">
                        <p>--</p>
                        <a href="#" class="btn btn-default">Saiba mais</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i> Desenvolvedor</h4>
                    </div>
                    <div class="panel-body">
                        <p>--</p>
                        <a href="#" class="btn btn-default">Saiba mais</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

<?php include 'footer.php';