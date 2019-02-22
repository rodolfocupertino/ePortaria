        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cadastros<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="/servicos">Clientes</a></li>
                  <li class="divider"></li>
                  <!-- <li class="dropdown-header"> </li> -->
                  <li><a href="/servicos">Serviços</a></li>
                  <li><a href="/servicos">Servidor Dedicado</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pagamentos<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="/visitas">Cobranças em Aberto</a></li>
                  <li><a href="/visitas">Cobranças quitadas</a></li>

                  <li class="divider"></li>
                  <li class="dropdown-header">Pagamento</li>
                  <li><a href="#">Forma de Pagamento</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Chamados<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="/chamados">Todos os Chamados</a></li>
                  <li class="divider"></li>
                  <li><a href="/chamado/new">Solicitar Atendimento</a></li>
                </ul>
              </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown" id="user-change">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <?=$_SESSION['name'];?>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Cadastro</a></li>
                  <!-- <li><a href="/pagamento">Pagamentos</a></li> -->

                  <li role="presentation" class="divider"></li>

                  <li><a href="/admin/logout">Sair</a></li>
                </ul>
              </li>

            </ul>

          </div>
      </div>