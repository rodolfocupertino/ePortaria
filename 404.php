<?php
/*DEFAULT PAGE VARIABLES*/
$page_title         = 'Não encontrado...'; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = true; //If true, require login to show

include ("header.php"); 
?>
<div class="col-md-12 content" role="main">
            <header class="header-content">
              <h1 class="title-1">Página não encontrada</h1>
              <p>O conteúdo pode ter sido removido ou não estar mais disponível.</p>
            </header>
 
            <h2 class="title-5">Você pode:</h2>
            <ol>
              <li>Verificar se digitou corretamente o endereço desejado.</li>
              <li>Retornar à <a href="<?=$files_path?>">página inicial</a>.</li>
            </ol>
            <p>Se o problema persistir, entre em contato através de um dos <a href="#">canais de atendimento</a>.</p>
          </div>
<?php  include( 'footer.php' );