<?php
/*DEFAULT PAGE VARIABLES*/
$page_title         = "Login"; //Title of the page
$disable_connection = false; //Connection is enabled by default
$require_login      = false; //If true, require login to show
$hide_menu          = true;

// session_start();

require_once("header.php"); 

require_once('includes/class.messages.php');
$msg = new Messages();

// d($_SESSION);

?>
<style type="text/css">
  body {
      padding-top: 80px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
  }

  #logo {
      text-align: center; 
      margin-bottom: 20px; 
  }

  .form-signin {
      max-width: 350px;
      padding: 19px 29px 29px;
      margin: 0 auto 20px;
      background-color: #fff;
      border: 1px solid #e5e5e5;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border-radius: 5px;
      -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
      -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
      box-shadow: 0 1px 2px rgba(0,0,0,.05);
  }
  .form-signin .form-signin-heading,
  .form-signin .checkbox {
      margin-bottom: 10px;
  }
  /*.form-signin input[type="text"],
  .form-signin input[type="password"] {
      font-size: 16px;
      height: auto;
      margin-bottom: 15px;
      padding: 7px 9px;
      width: 100%;
  }*/

</style>

<div class="container">
  <?php echo $msg->display(); ?> 

            <div id="logo">
                <!-- <img src="/images/cmr.png"> -->
            </div>
      <form class="form-signin" role="form" action="dologin" method="post">
        <h2 class="form-signin-heading text-center">Identifique-se!</h2>
        
        <div class="form-group">
            <label for="username">Seu endereço de e-mail:</label>

          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            <input type="text" class="form-control" id="username" name="username" placeholder="Usuário" required autofocus>
          </div>
        </div>
        <div class="form-group">
            <label for="username">Senha:</label>

          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" class="form-control" id="password_field"  name="password_field"  placeholder="Senha" required>
          </div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-log-in"></span>&nbsp; Acessar</button>
        </div>
          <hr>
          <span><a href="/lostpassword">Esqueci a senha</a></span>
          <!-- <span class="pull-right"><a href="#" target="_blank"><i class="fa fa-question-circle"></i> Ajuda</a></span> -->
      </form>

    </div> <!-- /container -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>


<?php include 'footer.php'; ?>