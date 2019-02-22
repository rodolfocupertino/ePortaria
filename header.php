<?php
/*DEFAULT PAGE VARIABLES*/

include 'paths.php';
include ( ABSPATH . "includes/init.php" );

require_once( ABSPATH . 'includes/class.messages.php');
$msg = new Messages();

if ($_REQUEST['action'] == "nome_sd"){
  $_SESSION['nome_sd'] = $_POST['nome_sd'];
  // d('Nome Soldado '.$_SESSION['nome_sd']);
}
    
?>
<!DOCTYPE html>
<html lang="br">
<head>
  <title><? echo SYSTEM_NAME;?> | <?=$page_title?></title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">

  <link rel="icon" sizes="192x192" href="/images/ico-painel2.png">
  <link rel="apple-touch-icon" href="/images/ico-painel2.png">
  <meta name="apple-mobile-web-app-title" content="Painel 2">

  <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- <link href="/css/bootstrap-theme.min.css" rel="stylesheet"> -->
  <!-- Custom CSS -->
  <link href="/css/modern-business.css" rel="stylesheet">
  <!-- <link href="/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" /> -->
  <link href="/css/style.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="/css/dataTables.tableTools.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="/css/dataTables.bootstrap.css" media="screen" rel="stylesheet" type="text/css" />

   <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/dashboard"><?=SYSTEM_NAME?></a>
        </div>

<?php if (!$hide_menu) {

    include "includes/menu_cliente.php";

 } ?>
    </nav>


<?php if (!$hide_menu) { ?>
<div class="container">

<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=$page_title;?>
                    <small></small>
                </h1>
               <!--  <ol class="breadcrumb">
               <?php //include_once ('includes/breadcrumbs.php'); ?>
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Sobre</li>
                </ol> -->
            </div>
        </div>
        <!-- /.row -->
<?php } ?>

