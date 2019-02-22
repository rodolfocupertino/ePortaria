<?php
function log_app($label,$msg) {
	global $app_logging;
	if ($app_logging) {
		$fp = fopen( 'wcp-app.log', 'a+');
		$date = gmdate( 'Y-m-d H:i:s' );
		fwrite($fp, "\n\n$date - $label\n$msg\n");
		fclose($fp);
	}
}

function log_user($act, $local, $id_usuario) {
		// SQL insert in JSON format
		$json = '
			insert : [
				{
					table: "activity_log" ,
					values: { user_id: "'.$id_usuario.'", action: "'.$act.'", description: "'.$local.'", created_at: "'.date('Y-m-d h:i:s').'" }
				}
			]
		';

		// The $result variable stores as return of the method, an array with the number of rows affected by the insert operation
		//$result = PDO4You::execute($json);
		//dd($json);
}

function inverte_data($data) {

	$data_array = explode("-", $data);
	$nova_data = $data_array[2] . "/" . $data_array[1] . "/" . $data_array[0];

	$hora_array = explode(":", $data);
		echo "<br>".$hora_array[1]."<br>";
		echo "<br>".$hora_array[2]."<br>";
		echo "<br>".$hora_array[0]."<br>";
	$nova_hora = $hora_array[2] . ":" . $hora_array[1] . ":" . $hora_array[0];

	return $nova_data." ".$nova_hora;

}

function datamysql($data) {

	$data_array = explode("/", $data);
	$nova_data = $data_array[2] . "-" . $data_array[1] . "-" . $data_array[0];

/*	$hora_array = explode(":", $data);
		echo "<br>".$hora_array[1]."<br>";
		echo "<br>".$hora_array[2]."<br>";
		echo "<br>".$hora_array[0]."<br>";
	$nova_hora = $hora_array[2] . ":" . $hora_array[1] . ":" . $hora_array[0]; */
	return $nova_data." ".$nova_hora;
}

function databr($data) {
	$data_array = explode("-",$data);
	$nova_data = trim($data_array[2])."/".trim($data_array[1])."/".trim($data_array[0]);

/*	echo trim($data_array[2])."<hr>";
	echo trim($data_array[1])."<hr>";
	echo trim($data_array[0])."<hr>";*/

	if ($nova_data=="//")
	{
	  return "";
	} else {
		return trim($nova_data);
	}
}


function uf($id,$val="") {
	$uf = array("AC","AL","AM","AP","BA","CE","DF","ES","GO","MA","MG","MS","MT","PA","PB","PE","PI","PR","RJ","RN","RO","RR","RS","SC","SE","SP","TO");
	$sel = "<select class=\"text-combo\" name=\"".$id."\" id=\"".$id."\" class=\"FormTxt\">";
	//	if ($autoredir) {
	$sel .="<option value=NULL selected=selected>--Selecione--</option>";
	for ($i=0;$i<=count($uf)-1;$i++) {
		if ($val && $val==$uf[$i]) $sel .= "<option value=\"".$uf[$i]."\" selected=\"selected\">".$uf[$i]."</option>";
		else $sel .= "<option value=\"".$uf[$i]."\" >".$uf[$i]."</option>";
	}
	$sel .= "</select>";
	return $sel;
}

function ftdata($dt,$tp=0) {
	$dd = str_replace("-","/",$dt);
	$p = strpos($dd,"/");
	if (substr($dd,0,$p) > 1000) list($a,$m,$d) = explode("/",$dd);
	else list($d,$m,$a) = explode("/",$dd);
	$ret = gmdate("Y-m-d", mktime(0,0,0,$m,$d,$a));
	if ($tp==0) $ret = gmdate("d/m/Y G:i", mktime(0,0,0,$m,$d,$a));
	return $ret;
}

function verifica_min($tb, $id) {
	$sql = "SELECT * FROM $tb WHERE id=$id ";
	$query = mysql_query($sql) or die(mysql_error());
	$rs = mysql_fetch_array($query);
	$data = $rs['data'];
	$data = strtotime($data);
	$agora = date("U");
	$tempo_segundos =  $agora - $data;
	if ($tempo_segundos <= 1200) {
		return true;
	}
	else{
		return false;
	}
}

function pageBrowser($totalrows,$numLimit,$amm,$queryStr,$numBegin,$begin,$num) {
$larrow = "&nbsp;<< Anterior ";
$rarrow = "&nbsp;Próximo >>&nbsp;";
//com numero: "proximos 5>>
$rarrow = "&nbsp;Próximo ".$numLimit." >>&nbsp;";
$wholePiece = "Página(s): ";

$link = '?'.$_SERVER['QUERY_STRING'];

if (($totalrows > 0) && ($amm > 0)) {
	$numSoFar = 1;
	$cycle = ceil($totalrows/$amm);
	if (!isset($numBegin) || $numBegin < 1) {
		$numBegin = 1;
		$num = 1;
		}
	$minus = $numBegin-1;
	$start = $minus*$amm;
	if (!isset($begin)) {
		$begin = $start;
		}
	$preBegin = $numBegin-$numLimit;
	$preStart = $amm*$numLimit;
	$preStart = $start-$preStart;
	$preVBegin = $start-$amm;
	$preRedBegin = $numBegin-1;
	if ($start > 0 || $numBegin > 1) {
		$wholePiece .= "<a href='$link&num=".$preRedBegin
						."&numBegin=".$preBegin
						."&begin=".$preVBegin
						.$queryStr."'>"
						.$larrow."</a>\n";
		}
	for ($i=$numBegin;$i<=$cycle;$i++) {
		if ($numSoFar == $numLimit+1) {
			$piece = "<a href='$link&numBegin=".$i
						."&num=".$i
						."&begin=".$start
						.$queryStr."'>"
						.$rarrow."</a>\n";
			$wholePiece .= $piece;
				break;
			}
		$piece = "<a href='$link&begin=".$start
					."&num=".$i
					."&numBegin=".$numBegin
					.$queryStr
					."'>";
		if ($num == $i) {
			$piece .= "</a><b>$i</b><a>";
			}
		else {
			$piece .= "$i";
			}
		$piece .= "</a>\n";
		$start = $start+$amm;
		$numSoFar++;
		$wholePiece .= $piece;
		}
	//$wholePiece .= "\n";
	$wheBeg = $begin+1;
	$wheEnd = $begin+$amm;
	$wheToWhe = "<b>".$wheBeg."</b> - <b>";
	if ($totalrows <= $wheEnd) {
		$wheToWhe .= $totalrows."</b>";
		}
	else {
		$wheToWhe .= $wheEnd."</b>";
		}
	$sqlprod = " LIMIT ".$begin.", ".$amm;
	}
else {
	$wholePiece = "Nada a exibir.";
	$wheToWhe = "<b>0</b> - <b>0</b>";
	}
return array($sqlprod,$wheToWhe,$wholePiece);
}

function load_pagina($file){
	 if (isset($file)) {
		 return include("../admin/$file.php");
		}
		else  {
		 return	"Página solicitada não existe!";
		}

}

//Cria  em Runtime e Popula os items para do combobox
function PopulateSelectFromDB($sql,$id,$val="",$ativo=true) {
// $sql : Passa a instrução sql
// $id : define qual será o ID/Nome do Combo
// $val : Se já virá com valor selecionado
// Selecting all records

global $pdo;
	
$list=$pdo->prepare($sql);
$list->execute();

	if ($list->rowCount()) {

		if ($ativo==false) $sel = "<select class=\"form-control ls-select \" name=\"".$id."\" id=\"".$id."\" disabled >";
			else 	$sel = "<select class=\"form-control ls-select\" name=\"".$id."\" id=\"".$id."\">";
	
		$sel .="<option value=\"\" ></option>";
	
		//foreach ($result as $row) {
		 while( $row = $list->fetch(PDO::FETCH_BOTH) )  {
		//d($row);

		//d($row["0"]);
		// d($row[1]);
			$sel .= '<option value="'.$row[0].'';
				if($val==$row[0]) $sel .= '" selected="selected" >';
					else $sel .= '" >';
					$sel .= $row[1].'</option>';
				}
			$sel .= "</select>";

	}
	return $sel;
}


//Cria  em Runtime e Popula os items para do combobox
function PopulateSelectFromArray($array_data,$id,$val="",$ativo=true) {
// $array_data : Recebe os dados
// $id : define qual será o ID/Nome do Combo
// $val : Se já virá com valor selecionado
// Selecting all records

	if (sizeof($array_data) > 0 ) {

		// var_dump($array_data);

		if ($ativo==false) $sel = "<select class=\"form-control input-lg\" name=\"".$id."\" id=\"".$id."\" disabled >";
			else 	$sel = "<select class=\"form-control input-lg\" name=\"".$id."\" id=\"".$id."\">";
	
		$sel .="<option value=\"\" ></option>";

		 sort($array_data);
	
		foreach($array_data as $row){
		// d($row);
		// d($row[1]);
			$sel .= '<option value="'.$row.'';
				if($val==$row) $sel .= '" selected="selected" >';
					else $sel .= '" >';
					$sel .= $row.'</option>';
				}
			$sel .= "</select>";

	}
	 // d($sel);
	return $sel;
}

//inicio das funções basicas do sistema
function seguranca($pagina, $nivel)
{
   /*if(!($_SESSION['nome']))
   {
	  redirect('login.php?url=' . substr($pagina, 1, strlen($pagina) - 1));
   }
   else
   {
	  if($_SESSION['nivel'] < $nivel)
	  {
		DebugShow($_SESSION['nivel']);
		DebugShow($nivel);
		exit;
	   //   redirect('login.php?erro=Usuário sem permissão para a página');
	  }
   } */
}

function redirect_query($query_string)
{
   $host = $_SERVER['HTTP_HOST'];
   $uri = $_SERVER['PHP_SELF'];
   header("Location: http://" . $host . $uri . '?' . $query_string);
   exit;
}

function formataDataHora($strDataHora,$hora=0){
	if ($hora=0){
		return date("d/m/Y",strtotime($strDataHora));
	} else{
		return date("d/m/Y  H:i:s",strtotime($strDataHora));
	}
}

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
	case "text":
	  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
	  break;
	case "long":
	case "int":
	  $theValue = ($theValue != "") ? intval($theValue) : "NULL";
	  break;
	case "double":
	  $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
	  break;
	case "date":
	  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
	  break;
	case "defined":
	  $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
	  break;
  }
  return $theValue;
}

function conta_registros($sql){
	//DebugShow($sql,"");

	$query = mysql_query($sql) or die(mysql_error());
	$rs = mysql_fetch_array($query);
	return $rs[0];

}


function upload_imagem($imagem,$diretorio_destino) {
//
//$imagem = Pegar o post do arquivo
//$diretorio_destino = Pega o diretorio para salvar
//Ex.: "../../images/banco_imagens/"
//

$erro = $config = array();

// Prepara a variável do arquivo
$arquivo = isset($imagem) ? $imagem : false;

// Tamanho máximo do arquivo (em bytes)
$config["tamanho"] = 300000;
// Largura máxima (pixels)
$config["largura"] = 1024;
// Altura máxima (pixels)
$config["altura"] = 768;

// Formulário postado... executa as ações
if($arquivo)
{
// Verifica se o mime-type do arquivo é de imagem
if(!eregi("^image\/(pjpeg|jpeg|gif|png|bmp)$", $arquivo["type"]))
{
$erro[] = "Arquivo em formato inválido! <br>A imagem deve ser jpg, jpeg,
bmp, gif ou png. <br>Envie outro arquivo";
}
else
{
// Verifica tamanho do arquivo
if($arquivo["size"] > $config["tamanho"])
{
$erro[] = "Arquivo em tamanho muito grande!<br>- A imagem deve ser de no máximo " . $config["tamanho"] . " bytes.<BR>- Envie outro arquivo";
}

// Para verificar as dimensões da imagem
$tamanhos = getimagesize($arquivo["tmp_name"]);

// Verifica largura
if($tamanhos[0] > $config["largura"])
{
$erro[] = "Largura da imagem não deve ultrapassar " . $config["largura"] . " pixels";
}

// Verifica altura
if($tamanhos[1] > $config["altura"])
{
$erro[] = "Altura da imagem não deve ultrapassar " . $config["altura"] . " pixels";
}
}

// Imprime as mensagens de erro
if(sizeof($erro))
{
foreach($erro as $err)
{
$var_status .=  " - " . $err . "<BR>";
//echo  " - " . $err . "<BR>";
}
echo "O arquivo não é uma imagem<br>";
echo "<a href=\"index.php?status=$var_status&id_galeria=$id_galeria\">Fazer Upload de Outra Imagem</a>";
exit();
}

// Verificação de dados OK, nenhum erro ocorrido, executa então o upload...
else
{
// Pega extensão do arquivo
preg_match("/\.(jpg|jpeg|gif|png|bmp){1}$/i", $arquivo["name"], $ext);

// Gera um nome único para a imagem
$imagem_nome = md5(uniqid(time())) . "." . $ext[1];
//$imagem_nome = $_SESSION['id_usuario'] . ".jpg";

// Caminho de onde a imagem ficará
$imagem_dir = $diretorio_destino . $imagem_nome;

// Faz o upload da imagem
move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
return $imagem_nome;

		}
	}
}

function apagar($dir){
	if(is_dir($dir)) // verifica se realmente é uma pasta
	{
		if($handle = opendir($dir))
		{
			while(false !== ($file = readdir($handle))) // varre cada um dos arquivos da pasta
			{
				if(($file == ".") or ($file == ".."))
				{
					continue;
				}
				if(is_dir($file)) // verifica se o arquivo atual é uma pasta
				{
					// caso seja uma pasta, faz a chamada para a funcao novamente
					apagar($file);
				} else
				{
					// caso seja um arquivo, exclui ele
					unlink($dir . $file);
				}
			}
		} else
		{
			$erro="nao foi possivel abrir o arquivo.";
			return false;
		}

		// fecha a pasta aberta
		closedir($handle);

		// apaga a pasta, que agora esta vazia
		rmdir($dir);
	} else
	{
		$erro="diretorio informado invalido";
		return false;
	}
}


function verifica_acesso($id_usuario){

	if ($id_usuario) {
		$sql = "SELECT TIME_FORMAT(data_hora, '%T') AS hora_ac,DATE_FORMAT(data_hora, '%d/%m/%Y ') AS data_ac FROM log_usuario "
		   ." WHERE idusuario=$id_usuario order by id desc LIMIT 0,1 ";

		$query = mysql_query($sql) or die(mysql_error());
		$rs = mysql_fetch_array($query);
		$hora_ac = $rs['hora_ac'];
		$data_ac = $rs['data_ac'];

		return $data_ac." às ".$hora_ac;
	}

}

// Array of extensions allowed
$ext_array = array("jpg", "jpeg", "png", "gif", "bmp", "psd", "pdf", "htm", "html", "avi", "mp3", "wma", "wmv", "css");

function uploadifyExts($array) { // Function to create the allowed extensions for Uploadify
   $js_ext = ""; // Set the final output as blank
   $i = 1; // Starting number for counting the allowed extensions
   $a_exts = count($array); // Find out how many extensions are in the array
   foreach ($array as $value) { // Get each extension in the array
	  if($a_exts > $i) { // If extensions are greater than the starting amount
		  $js_ext .= "*.".$value.";"; // For each extension, create the extension as read by Uploadify
	  } else { // If we are on the last extension in the array
		 $js_ext .= "*.".$value; // Set the last extension
	  }
   $i++; // Add 1 onto the starting amount
   } // End foreach
   return $js_ext; // Return all the extensions
} // End function

function browseExts($array) { // Function to create a listing of allowed extensions shown in the user browse box
   $b_ext = ""; // Set final output as blank
   $a_exts = count($array); // Find out how many extensions are in the array
   foreach ($array as $value) { // Get each extension in the array
	   $b_ext .= " (*.".$value.")"; // For each extension, create an easily read format (*.ext) (*.ext2)...
   }
   return $b_ext; // Return the extensions
} // End function

function displayExts($array) { // Function to create a listing of allowed extensions shown on your page
   $d_ext = ""; // Set final output as blank
   $i = 1; // Starting number for counting the allowed extensions
   $a_exts = count($array); // Find out how many extensions are in the array
   foreach ($array as $value) { // Get each extension in the array
	  if($a_exts > $i) { // If extensions are greater than the starting amount
		  $d_ext .= $value.", "; // For each extension, create an easily read format ext, ext2, ext3...
	  } else { // If we are on the last extension in the array
		 $d_ext .= $value; // Set the last extension
	  }
   $i++; // Add 1 onto the starting amount
   } // End foreach
   return $d_ext; // Return the extensions
} // End function

function get_option( $setting, $default = false ) {

	/*if (isset($setting)) {

		$sql = "SELECT DISTINCT * FROM settings WHERE setting='$setting' LIMIT 0,1 ";
		//$output = $rs['value'];
		
		try{
	        $has_user=$pdo->query($sql);
			
	    }catch(PDOException $e){
	        //SE NÃO CONSEGUIR CONECTAR AO BANCO, EXIBE O ERRO
	        echo htmlentities('Erro ao se conectar com database ' . $e->getMessage());
	    }

		// Getting the total number of rows affected by the operation
		$temlogin = $pdo->rowCount();
		
			foreach ($result as $row) {
				extract($row);
				//d($username);
				
			}
		return $value;
	} */

}


function get_bloginfo($show = '', $filter = 'raw') {

	switch($show) {
		case 'url' :
		case 'home' : // DEPRECATED
		case 'siteurl' : // DEPRECATED
			$output = get_option('home');
			break;
		case 'wpurl' :
			$output = get_option('siteurl');
			break;
		case 'description':
			$output = get_option('blogdescription');
			break;
		case 'rdf_url':
			$output = get_feed_link('rdf');
			break;
		case 'rss_url':
			$output = get_feed_link('rss');
			break;
		case 'rss2_url':
			$output = get_feed_link('rss2');
			break;
		case 'atom_url':
			$output = get_feed_link('atom');
			break;
		case 'comments_atom_url':
			$output = get_feed_link('comments_atom');
			break;
		case 'comments_rss2_url':
			$output = get_feed_link('comments_rss2');
			break;
		case 'pingback_url':
			$output = get_option('siteurl') .'/xmlrpc.php';
			break;
		case 'stylesheet_url':
			$output = get_stylesheet_uri();
			break;
		case 'stylesheet_directory':
			$output = get_stylesheet_directory_uri();
			break;
		case 'template_directory':
		case 'template_url':
			$output = get_template_directory_uri();
			break;
		case 'admin_email':
			$output = get_option('admin_email');
			break;
		case 'charset':
			$output = get_option('blog_charset');
			if ('' == $output) $output = 'UTF-8';
			break;
		case 'html_type' :
			$output = get_option('html_type');
			break;
		case 'version':
			global $wp_version;
			$output = $wp_version;
			break;
		case 'language':
			$output = get_locale();
			$output = str_replace('_', '-', $output);
			break;
		case 'text_direction':
			global $wp_locale;
			$output = $wp_locale->text_direction;
			break;
		case 'name':
		default:
			$output = get_option('blogname');
			break;
	}

	$url = true;
	if (strpos($show, 'url') === false &&
		strpos($show, 'directory') === false &&
		strpos($show, 'home') === false)
		$url = false;

	if ( 'display' == $filter ) {
		if ( $url )
			$output = apply_filters('bloginfo_url', $output, $show);
		else
			$output = apply_filters('bloginfo', $output, $show);
	}

	return $output;
}

function vlr2sql($pValor){
	$pValor = strlen(trim($pValor)) == 0 ? 0 : $pValor;
	$pValor = str_replace(".", "", $pValor);
	$pValor = str_replace(",", ".", $pValor);
	return $pValor;
}

function sql2real($pValor){
	$pValor = strlen(trim($pValor)) == 0 ? 0 : $pValor;
	//$pValor = str_replace(",", "", $pValor);
	//$pValor = str_replace(".", ",", $pValor);
	$pValor = number_format($pValor,2,',','.');
	return $pValor;
}

//==== Redirect... Try PHP header redirect, then Java redirect, then try http redirect.:
function redirect($url){
	if (!headers_sent()){    //If headers not sent yet... then do php redirect
		header('Location: '.$url); exit;
	}else{                    //If headers are sent... do java redirect... if java disabled, do html redirect.
		echo '<script type="text/javascript">';
		echo 'window.location.href="'.$url.'";';
		echo '</script>';
		echo '<noscript>';
		echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
		echo '</noscript>'; exit;
	}
}//==== End -- Redirect


/*function br2nl($string)
{
	return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}

/*  function br2nl($text)
  {
	  $text = str_replace("<br />","",$text);
	  $text = str_replace("<br>","",$text);
	   return $text;
  }*/

function retira_acentos($palavra=""){
  /*
   * Script para remover acentos e caracteres especiais:
   */

//  $palavra = "açúcar união";
  $palavra = ereg_replace("[^a-zA-Z0-9_]", "", strtr($palavra, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ~", "aaaaeeiooouucAAAAEEIOOOUUC_ "));

  return $palavra;   // imprime "acucar_uniao"

  /*
   * A função "strtr" substitui os caracteres acentuados pelos não acentuados.
   * A função "ereg_replace" utiliza uma expressão regular que remove todos os caracteres que não são letras, números e são diferentes de "_" (underscore).
   */
}



//include("../admin/includes/feriado.php");


/*
formas diferentes de usar a funcao

1- qdt de dias uteis a contar apartir de uma data especifica ou fixa você pode passar a data direto nos paremetros da funcao
   function somar_dias_uteis($str_data,$int_qtd_dias_somar = 7,$feriados)

   chamando a funcao
   somar_dias_uteis('09/04/2009','','');
   ou
   $data = date('Y-m-d');
   somar_dias_uteis('$data','','');

2- nao precisa passar os dias como parametro da funcao tipo function somar_dias_uteis($str_data,$int_qtd_dias_somar,$feriados)
   para chamar a funcao fica
   somar_dias_uteis('09/04/2009','4','');
   ou
   $data = date('Y-m-d');
   somar_dias_uteis('$data','4','');
*/

function somar_dias_uteis($str_data,$int_qtd_dias_somar,$feriados) {

		// Caso seja informado uma data do MySQL do tipo DATETIME - aaaa-mm-dd 00:00:00
		// Transforma para DATE - aaaa-mm-dd

   $str_data = substr($str_data,0,10);

		// Se a data estiver no formato brasileiro: dd/mm/aaaa
		// Converte-a para o padrão americano: aaaa-mm-dd

		if ( preg_match("@/@",$str_data) == 1 ) {

				$str_data = implode("-", array_reverse(explode("/",$str_data)));

		}


		// chama a funcao que calcula a pascoa
		$pascoa_dt = dataPascoa(date('Y'));
		$aux_p = explode("/", $pascoa_dt);
		$aux_dia_pas = $aux_p[0];
		$aux_mes_pas = $aux_p[1];
		$pascoa = "$aux_mes_pas"."-"."$aux_dia_pas"; // crio uma data somente como mes e dia


		// chama a funcao que calcula o carnaval
		$carnaval_dt = dataCarnaval(date('Y'));
		$aux_carna = explode("/", $carnaval_dt);
		$aux_dia_carna = $aux_carna[0];
		$aux_mes_carna = $aux_carna[1];
		$carnaval = "$aux_mes_carna"."-"."$aux_dia_carna";


		// chama a funcao que calcula corpus christi
		$CorpusChristi_dt = dataCorpusChristi(date('Y'));
		$aux_cc = explode("/", $CorpusChristi_dt);
		$aux_cc_dia = $aux_cc[0];
		$aux_cc_mes = $aux_cc[1];
		$Corpus_Christi = "$aux_cc_mes"."-"."$aux_cc_dia";


		// chama a funcao que calcula a sexta feira santa
		$sexta_santa_dt = dataSextaSanta(date('Y'));
		$aux = explode("/", $sexta_santa_dt);
		$aux_dia = $aux[0];
		$aux_mes = $aux[1];
		$sexta_santa = "$aux_mes"."-"."$aux_dia";



   $feriados = array("01-01", $carnaval, $sexta_santa, $pascoa, $Corpus_Christi, "04-21", "05-01", "06-12" ,"07-09", "07-16", "09-07", "10-12", "11-02", "11-15", "12-24", "12-25", "12-31");


		$array_data = explode('-', $str_data);
		$count_days = 0;
		$int_qtd_dias_uteis = 0;



		while ( $int_qtd_dias_uteis < $int_qtd_dias_somar ) {

				$count_days++;
				$day = date('m-d',strtotime('+'.$count_days.'day',strtotime($str_data)));

				if(($dias_da_semana = gmdate('w', strtotime('+'.$count_days.' day', gmmktime(0, 0, 0, $array_data[1], $array_data[2], $array_data[0]))) ) != '0' && $dias_da_semana != '6' && !in_array($day,$feriados)) {

						$int_qtd_dias_uteis++;
				}

		}

		 return gmdate('d/m/Y',strtotime('+'.$count_days.' day',strtotime($str_data)));

}
//  somar_dias_uteis('09/04/2009','','');

function redirecionar($url, $tempo)
{
	$url = str_replace('&amp;', '&', $url);

	if($tempo > 0)
	{
		header("Refresh: $tempo; URL=$url");
	}
	else
	{
		@ob_flush();
		@ob_end_clean();
		header("Location: $url");
		exit;
	}
}


function d_message($alert, $head, $message) {
  
  //echo "Mostra: $alert";
  
      switch ($alert) {
        case "success":
          $result="
          <div class=\"alert alert-success alert-block fade in\">
                                      <button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">
                                          <i class=\"fa fa-times\"></i>
                                      </button>
                                      <h4>
                                          <i class=\"fa fa-ok-sign\"></i>
                                          $head
                                      </h4>
                                      <p>$message</p>
                                  </div>";
          break;
        case "info":
          $result="
          <div class=\"alert alert-info alert-block fade in\">
                                      <button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">
                                          <i class=\"fa fa-times\"></i>
                                      </button>
                                      <h4>
                                          <i class=\"fa fa-ok-sign\"></i>
                                          $head
                                      </h4>
                                      <p>$message</p>
                                  </div>";
                break;
        case "warning":
          $result="
          <div class=\"alert alert-warning alert-block fade in\">
                                      <button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">
                                          <i class=\"fa fa-times\"></i>
                                      </button>
                                      <h4>
                                          <i class=\"fa fa-ok-sign\"></i>
                                          $head
                                      </h4>
                                      <p>$message</p>
                                  </div>";
          break;
        case "danger":
          $result="
          <div class=\"alert alert-danger alert-block fade in\">
                                      <button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">
                                          <i class=\"fa fa-times\"></i>
                                      </button>
                                      <h4>
                                          <i class=\"fa fa-ok-sign\"></i>
                                          $head
                                      </h4>
                                      <p>$message</p>
                                  </div>";
          break;    
         /* default:
           echo "i is not equal to 0, 1 or 2";*/
      } 
      
      return $result;
  
 }

function _make_url_clickable_cb($matches) {
	$ret = '';
	$url = $matches[2];
 
	if ( empty($url) )
		return $matches[0];
	// removed trailing [.,;:] from URL
	if ( in_array(substr($url, -1), array('.', ',', ';', ':')) === true ) {
		$ret = substr($url, -1);
		$url = substr($url, 0, strlen($url)-1);
	}
	return $matches[1] . "<a href=\"$url\" rel=\"nofollow\">$url</a>" . $ret;
}
 
function _make_web_ftp_clickable_cb($matches) {
	$ret = '';
	$dest = $matches[2];
	$dest = 'http://' . $dest;
 
	if ( empty($dest) )
		return $matches[0];
	// removed trailing [,;:] from URL
	if ( in_array(substr($dest, -1), array('.', ',', ';', ':')) === true ) {
		$ret = substr($dest, -1);
		$dest = substr($dest, 0, strlen($dest)-1);
	}
	return $matches[1] . "<a href=\"$dest\" rel=\"nofollow\">$dest</a>" . $ret;
}
 
function _make_email_clickable_cb($matches) {
	$email = $matches[2] . '@' . $matches[3];
	return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
}
 
function make_clickable($ret) {
	$ret = ' ' . $ret;
	// in testing, using arrays here was found to be faster
	$ret = preg_replace_callback('#([\s>])([\w]+?://[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', '_make_url_clickable_cb', $ret);
	$ret = preg_replace_callback('#([\s>])((www|ftp)\.[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', '_make_web_ftp_clickable_cb', $ret);
	$ret = preg_replace_callback('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', '_make_email_clickable_cb', $ret);
 
	// this one is not in an array because we need it to run last, for cleanup of accidental links within links
	$ret = preg_replace("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", $ret);
	$ret = trim($ret);
	return $ret;
}


function dir_create($path, $param){
	
	if (!isset($path) ){
	  
	}

}

// function _e($string) {
//   echo _($string);
// }

function showMessage($message, $errormsg = false) {
	
	if ($errormsg) {
		echo '<div id="message" class="error">';
	} else {
		echo '<div id="message" class="updated fade">';
	}

	echo "<p><strong>$message</strong></p></div>";

}    

function d($v,$t)
{
	echo '<pre>';
	echo '<h1>' . $t. '</h1>';
	var_dump($v);
	echo '</pre>';
}

/*function dd($v,$t)
{
	echo '<pre>';
	echo '<h1>' . $t. '</h1>';
	var_dump($v);
	echo '</pre>';
	die();
}*/

//function db_version() {
//	return preg_replace( '/[^0-9.].*/', '', mysql_get_server_info( $this->dbh ) );
//} 

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one. 
}

function login($email, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
        FROM members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
}

function checkbrute($user_id) {
    // Get timestamp of current time 
    $now = time();
 
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);

    $sql = "SELECT u.id,u.username,u.password,u.firstname,u.lastname,u.`status` FROM users u WHERE u.username LIKE '$formlogin'";

	// Selecting all records
	$result = PDO4You::select($sql);

	// Getting the total number of rows affected by the operation
	$temlogin = PDO4You::rowCount();
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts <code><pre>
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
	        }
	    }
}

function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}	

function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}	

function json_timestamps($type) {
	
	$dt = date('Y-m-d h:i:s');

	switch ($type) {
        case "create":
          $json = " created_at: '$dt' "; 
                break;
        case "update":
          $json = " updated_at: '$dt' "; 
          break;
         default: $json = " created_at: '$dt' , updated_at: '$dt' "; 
    }

	return $json; 
}

function timestamps($type) {
	
	$dt = date('Y-m-d h:i:s');

	switch ($type) {
        case "create":
          $json = " AND created_at='$dt' "; 
                break;
        case "update":
          $json = " AND updated_at='$dt' "; 
          break;
         default: $json = " created_at='$dt' AND updated_at='$dt' "; 
    }

	return $json; 
}

function fakeName($ucfirst = false) {
        $v = array("a", "e", "i", "o", "u");
        $c = array("b", "c", "d", "f", "g", "h", "j", "l", "m", "n", "p", "q", "r", "s", "t", "v", "x", "z");

        $fakename = $c[array_rand($c, 1)] . $v[array_rand($v, 1)] . $c[array_rand($c, 1)] . $v[array_rand($v, 1)] . $v[array_rand($v, 1)];

        return ($ucfirst) ? ucfirst($fakename) : $fakename;
}

function filename($fname) {

	$caminho = explode("/", $fname );
	$final = count($caminho) -1;
	$nome_arquivo_atual = $caminho[$final];
	$ex_arquivo_atual = explode(".", $nome_arquivo_atual);
	$nome_arquivo = $ex_arquivo_atual[0];

	return $nome_arquivo;

}

function generateHash($password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
    }
}

function validate_pw($password, $hashedPassword) {
    return crypt($password, $hashedPassword) == $hashedPassword;
}

/*
BASE FUNCTIONS
File used by all the pages
*/


/**********************************************\FORMAT, VERIFY and MASK FUNCTIONS/**********************************************/

/*
ZEROFILL
Fill the extra space with zeros.
*/
function zeroFill($value, $totalsize=3) {
	while(strlen($value) < $totalsize) $value = '0' . $value;
	return $value;
}

/*
DOT
Transform , to .
*/
function dot($number) {
	$resp = str_replace('.', '', $number);
	$resp = trim(str_replace(',', '.', $resp));
	if(is_numeric($resp)) return $resp;
	else return $number;
}


/*
COMMA
Transform . to ,
*/
function comma($value, $decimals=2, $ifzero=null) {
	if(($ifzero!==null) && ((float)$value==0)) return $ifzero;
	else {
		$value = (float)$value;
		if(is_numeric($value)) return number_format($value, $decimals, ',', '');
		else return $value;
	}
}

/*
COMMAIF
Transform . to , and show decimals only if the value have it
*/
function commaIf($value, $decimals=2) {
	if(is_numeric((float)$value)) {
		$value = (float)$value;
		if($value == round($value)) return $value;
		else return number_format($value, $decimals, ',', '');
	} else {
		return $value;
	}
}

/*
ONLYNUMBERS
Clear all data but numbers
*/
function onlyNumbers($string){
	for($i=0;$i<strlen($string);$i++) if(is_numeric($string[$i])) $response .= $string[$i];
	return $response;
}

/*
STRIPDOT
Transform 123.45 to 12345 format
*/
function stripDot($number) {
	return number_format($number, 2, '', '');
}

/*
INVERTDATE
Transform dd/mm/YYYY to YYYY-mm-dd
*/
function invertDate($date='') {
	if($date == '') return '';
	else {
		$split = explode('/',$date);
		if(strlen($split[2]) == 2) {
			if($split[2] < 35) $split[2] = '20'. $split[2];
			else $split[2] = '19'.$split[2];
		}
		return $split[2].'-'. str_pad($split[1], 2, '0', STR_PAD_LEFT) .'-'. str_pad($split[0], 2, '0', STR_PAD_LEFT);
	}
}

/*
DATEMASK
Transform YYYY-mm-dd to dd/mm/YYYY
And YYYY-mm-dd HH:mm:ss to dd/mm/YYYY HH:mm:ss
*/
function dateMask($date='') {
	if($date == '') return '';
	else {
		//If it's datetime format
		if(strlen($date) > 12) {
			$prima = explode(' ', $date);
			$hour = ' '. $prima[1];
			$date = $prima[0];
		}
		$split = explode('-', $date);
		if($split[2].'/'.$split[1].'/'.$split[0] != '00/00/0000') return $split[2].'/'.$split[1].'/'.$split[0] . $hour;
		else return '';
	}
}

/*
CEPMASK
Transform 00000000 to 00000-000 format. (Zipcode brazilian format)
*/
function cepMask($cep) {
	$cep = onlyNumbers($cep);
	return substr($cep, 0, 5) .'-'. substr($cep, 5);
}

/*
CPFCNPJMASK
Format CPF or CNPJ according to size
*/
function cpfCnpjMask($x) {
	$x = onlyNumbers($x);
	if(strlen($x) == 0) return '';
	if(strlen($x) > 12) {
		if(strlen($x) == 14) {
			return substr($x, 0, 2) .'.'. substr($x, 2, 3) .'.'. substr($x, 5, 3) .'/'. substr($x, 8, 4) .'-'. substr($x, 12);
		} else {
			return substr($x, 0, 3) .'.'. substr($x, 3, 3) .'.'. substr($x, 6, 3) .'/'. substr($x, 9, 4) .'-'. substr($x, 13);
		}
	}
	else return substr($x, 0, 3) .'.'. substr($x, 3, 3) .'.'. substr($x, 6, 3) .'-'. substr($x, 9);
}


/*PHONEMASK*/
function phoneMask($x) {
	$x = onlyNumbers($x);
	if(empty($x)) return '';
	$r3 = substr($x, -4);
	$r2 = substr($x, -8, 4);
	$r1 = substr($x, -10, 2);
	if(!empty($r1)) $r1 .= '-';
	return $r1 . $r2 .'-'. $r3;
}


/*
STRIPACCENT
Strip accents and replace strange chars
*/
function stripAccent($string) {
	return str_replace(
		array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý'),
		array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y'),
		$string);
}


/*
FRIENDNAME
Convert a name to a friendly domain/shell name
*/
function friendName($x) {
	$allowed = 'abcdefghijklmnopqrstuvwxyz0123456789-._';
	$x = trim($x);
	$x = str_replace(' ', '-', $x);
	$x = str_replace('--', '-', $x);
	$x = str_replace('-.', '.', $x);
	$x = str_replace('.-', '.', $x);
	$x = str_replace('-.-', '.', $x);
	$x = str_replace('.-.', '.', $x);
	$x = str_replace('..', '.', $x);
	$x = str_replace('&quot;', '', $x);
	$x = strtolower($x);
	$x = stripAccent($x);
	$conta = strlen($x);
	for($ii=0; $ii<$conta; $ii++) if(stripos($allowed, $x{$ii}) !== false) $resp .= $x{$ii};
	while(strrpos($resp, '.') == (strlen($resp)-1)) $resp = substr($resp, 0, (strlen($resp)-1));
	while(strpos($resp, '.') === 0) $resp = substr($resp, 1);
	while(strpos($resp, 'www.') === 0) $resp = substr($resp, 4);
	while(strpos($resp, 'wwww.') === 0) $resp = substr($resp, 5);
	if(empty($resp)) $resp = 'general';
	return $resp;
}


/*
GETSUBDOMAIN
Return the subdomain word in subdomain.domain.com
*/
function getSubdomain() {
	return substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], '.'));
}



/*BBCODE
Transform BBCode to HTML code*/
function bbCode($x) {
	$x = strip_tags($x);
	$x = str_replace('[b]', '<b>', $x);
	$x = str_replace('[/b]', '</b>', $x);
	$x = str_replace('[i]', '<i>', $x);
	$x = str_replace('[/i]', '</i>', $x);
	$x = str_replace('[u]', '<u>', $x);
	$x = str_replace('[/u]', '</u>', $x);
	$x = preg_replace('/\[img=(.+)\]/Usi', '<img src="$1">', $x);
	return nl2br($x);
}

/*CLEARBBCODE
Clear all the bbcodes and html tags*/
function clearBBCode($x) {
	$x = strip_tags($x);
	$x = str_replace('[b]', '', $x);
	$x = str_replace('[/b]', '', $x);
	$x = str_replace('[i]', '', $x);
	$x = str_replace('[/i]', '', $x);
	$x = str_replace('[u]', '', $x);
	$x = str_replace('[/u]', '', $x);
	$x = preg_replace('/\[img=(.+)\]/Usi', '', $x);
	return $x;
}



/*
ARRAY2XML
Transform an Array to XML.
*/
function array2xml($x, $debug=false, $header=true) {
	if(empty($x)) return false;

	if($debug) $enterchar = "\n";

	if($header) {
		header('Content-Type: text/xml; charset=UTF-8');
		header('Content-Disposition: inline; filename=file.xml');

		echo '<?'.'xml version="1.0" encoding="UTF-8"'.'?'.'>'. $enterchar;
		echo '<root>'. $enterchar;
	}

	foreach($x as $field => $value) {
		$temp = explode(' ', $field);
		$field2 = $temp[0];
		if(is_array($value)) {
			if(is_numeric($field)) {
				$field = 'reg id="'. $field .'"';
				$field2 = 'reg';
			}
			echo '<'. $field .'>'. $enterchar;
			array2xml($value, $debug, false);
			echo '</'. $field2 .'>'. $enterchar;
		}
		else {

			if(!is_numeric($field)) {
				if((strpos($value, '<') !== false) || (strpos($value, '>') !== false) || (strpos($value, '&') !== false)) {
					echo '<'. $field .'><![CDATA['. $value .']]></'. $field2 .'>'. $enterchar;
				}
				else echo '<'. $field .'>'. $value .'</'. $field2 .'>'. $enterchar;
			}

			//Strip numeric keys to economize
/*
			if(!is_numeric($field)) {
				if((is_numeric($value)) || empty($value) || (!$usarcdata)) echo "<$field>$value</$field2>$enterchar";
				else echo "<$field><![CDATA[$value]]></$field2>$enterchar";
			}
*/
		}
	}

	if($header) echo '</root>';
}

//REPENSAR ESSA
function dieXML($coderror, $obs=null) {
		global $status_list;

		header('Content-Type: text/xml; charset=UTF-8');
		header('Content-Disposition: inline; filename=api.xml');
		echo '<?'.'xml version="1.0" encoding="UTF-8"'.'?'.'>';
		echo '<error>';
		echo '<status>'. $coderror .'</status>';
		echo '<msg>'. $status_list[$coderror] .'</msg>';
		if(!empty($obs)) echo '<obs>'. $obs .'</obs>';
		echo '</error>';
		die();
}


/*UTF8
Convert array or string to utf8 charset
*/
function utf8($x) {
	if(is_numeric($x)) return $x;
	elseif(is_array($x)) {
		foreach($x as $key => $value) {
			if(is_array($value)) $resp[$key] = utf8($value);
			else {
				if(mb_detect_encoding($value .' ', 'UTF-8,ISO-8859-1') != 'UTF-8') {
					$value = iconv('ISO-8859-1', 'UTF-8//TRANSLIT//IGNORE', $value);
				}
				$resp[$key] = $value;
			}
		}
		return $resp;
	}
	else {
		if(mb_detect_encoding($x .' ', 'UTF-8,ISO-8859-1') != 'UTF-8') {
			$x = iconv('ISO-8859-1', 'UTF-8//TRANSLIT//IGNORE', $x);
		}
		return $x;
	}
}


/*ISO88591
Convert array or string to iso88591 charset
*/
function iso88591($x) {
	if(is_numeric($x)) return $x;
	elseif(is_array($x)) {
		foreach($x as $key => $value) {
			if(is_array($value)) $resp[$key] = iso88591($value);
			else {
				if(mb_detect_encoding($value .' ', 'UTF-8,ISO-8859-1') != 'ISO-8859-1') $resp[$key] = utf8_decode($value);
				else $resp[$key] = $value;
			}
		}
		return $resp;
	}
	else {
		if(mb_detect_encoding($x .' ', 'UTF-8,ISO-8859-1') != 'ISO-8859-1') return utf8_decode($x);
		else return $x;
	}
}


/*SUPERTRIM
Trim strings and arrays
*/
function superTrim($x, $char=null) {
	if(is_array($x)) {
		foreach($x as $key => $value) {
			if(is_array($value)) $resp[$key] = superTrim($value);
			else $resp[$key] = superTrim($value);
		}
		return $resp;
	}
	else return trim($x, $char);
}



/*
IS_EMAIL
Basic check of an email structure
*/
function isMail($email) {
	return eregi('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$', $email);
}


/*
IS_CPF
Return true if the value is Brazilian CPF
*/
function isCpf($x) {
	if(strlen(onlyNumbers($x)) > 12) return false;
	return true;
}


/*
IS_DATE
Check if the value is a date (yyyy-mm-dd)
*/
function isDate($date) {

	if(strlen($date) > 12) { //Datetime
		if(preg_match('/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/', $date, $matches)) {
			if(checkdate($matches[2], $matches[3], $matches[1])) return true;
		}
	} else { //Only date
		if(preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $date, $matches)) {
			if(checkdate($matches[2], $matches[3], $matches[1])) return true;
		}
	}

	return false;
}


/**********************************************\FILE & FOLDERS FUNCTIONS/**********************************************/


/*
FILESIZEMASK
Return human readable size format
*/
function fileSizeMask($size) {
	$i=0;
	$iec = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
	while(($size/1024) > 1) {
		$size=$size/1024;
		$i++;
	}
	return comma(substr($size,0,strpos($size,'.')+4)).$iec[$i];
}

/*
CLIENTFOLDER
Return the client default folder. Create it if doesn't exist.
*/
function clientFolder($subfolder='') {
	if(!empty($subfolder)) {
		$folder = CLIENTS_FOLDER . clientKey($_SESSION['user_logged']);
		if(!file_exists($folder)) mkdir($folder);
		$sub = '/'. $subfolder;
	}

	$folder = CLIENTS_FOLDER . clientKey($_SESSION['user_logged']) . $sub;
	if(!file_exists($folder)) {
		if(mkdir($folder)) return $folder;
		else return false;
	} else return $folder;
}

/*
CLIENTKEY
Subfunction, return the name of the client's folder.
*/
function clientKey($x, $passkey='lazevroda') {
	return $x . substr(md5($x . $passkey), 0, 3);
}


/*
LS
List the files in a folder
*/
function ls($dir, $filter='') {
	if(is_dir($dir)) {
		if($handle = opendir($dir)) {
			while(($file = readdir($handle)) !== false) {
				if(($file != '.') && ($file != '..') && (!is_dir($dir .'/'. $file))) {
					if(!empty($filter)) {
						$temp = pathinfo($file);
						if(strpos($filter, $temp['extension']) !== false) $resp[] = $file;
					} else $resp[] = $file;
				}
			}
		} else return false;
		closedir($handle);
		return $resp;
	}
}


/*
DELTREE
Like DOS command
*/
function deltree($dir) {
	if(is_dir($dir)) {
		if($handle = opendir($dir)) {
			while(false !== ($file = readdir($handle))) {
				if(($file != '.') && ($file != '..')) {
					if(is_dir($dir .'/'. $file)) $counter += deltree($dir .'/'. $file);
					else if(unlink($dir .'/'. $file)) $counter++;
				}
			}
		} else return false;
		closedir($handle);
		if(rmdir($dir)) $counter++;
	} else {
		if(unlink($dir)) $counter++;
	}
	return $counter;
}




/**********************************************\DATABASE FUNCTIONS/**********************************************/

/*
SQL
used to work with database

TO INSERT AND UPDATE:
$ins['field'] = 'data';
sql("insert into table", $ins);

TO SELECT:
$response = sql("select * from table where ...");
*/
function sql($com, $data_fields='', $alternative_connection='', $debug=false) {

	$com = trim($com);

	//If is defined, use the alternative connection
	if(!empty($alternative_connection)) $connection = $alternative_connection;
	//Else, use the global connection
	else global $connection;

	//If $data_fields is empty, just run the $com command
	if(!empty($data_fields)) {
		if(is_array($data_fields)) {
			foreach($data_fields as $key => $value) {
				if(!empty($key)) {
					$fields[] = $key;
					if(!get_magic_quotes_gpc()) $values[] = addslashes($value);
					else $values[] = $value;
				}
			}
		}
		//If it is an insert command
		if(strtolower(substr($com, 0, 6)) == 'insert') { //INSERT
			$field = implode(', ', $fields);
			$value = implode('\', \'', $values);
			$com = $com .' ('. $field .') values (\''. $value .'\')';
		}
		//If it is an update command
		elseif(strtolower(substr($com, 0, 6)) == 'update') { //UPDATE
			foreach($fields as $key => $value) $texts[] = $value .'=\''. $values[$key] .'\'';
			$text = implode(', ', $texts);
			$com = str_replace('[fields]', $text, $com);
		}
	}

	if($debug) echo '<p>'. $com .'</p>';

	//Do the sql command
	$sql = mysql_query($com, $connection) or die('<b>Mysql error:</b> '. mysql_error() .'<br><b>Command:</b> '. $com);

	if(!$sql) return false;
	else {
		//If it is a select command, return an array;
		if(strtolower(substr($com, 0, 6)) != 'select') return true;
		else {
			if(strtolower(substr($com, -7)) == 'limit 1') { //If is 'limit 1' set, return the value directly
				$response = mysql_fetch_array($sql, MYSQL_ASSOC);
			}
			else { //Else, return into a list
				$response = array();

				//Get the fields name
				$fields_name = mysql_num_fields($sql);
				for($i=0; $i<$fields_name; $i++) $fnames[] = mysql_field_name($sql, $i);

				//Put all the data in array
				while($resp = mysql_fetch_row($sql)) {
					$temp = array();
					foreach($fnames as $key => $value) $temp[$value] = stripslashes($resp[$key]);
					$response[] = $temp;
				}
			}

			return $response;
		}
	}
}

function orderby($default) {
	$temp = getFilter('orderby');
	$orderby = (empty($temp)) ? $default : $temp;
	if(empty($orderby)) return '';
	else return ' order by '. $orderby .' ';
}


function limit() {
	global $register_per_page;

	$registers = getFilter('registers');
	$nowpage   = getFilter('nowpage');
	$limitpage = $nowpage*$registers-$registers;

	if(empty($registers)) $registers = setFilter('registers', $register_per_page);
	if((empty($nowpage)) or ($nowpage < 1)) $nowpage = setFilter('nowpage', 1);

	return ' limit '. $limitpage .', '. $registers;
}


function showTagList($table, $field, $where='') {
	//Get all tags
	$sql = sql('select '. $field .' from '. $table .' '. $where);
	if($sql) {
		foreach($sql as $arr) {
			$cru = str_replace('  ', ' ', $arr[$field]);
			$cru = str_replace(', ', ',', $cru);
			$temp = explode(',', $cru);
			foreach($temp as $value) { //Get only searched tags
				if((!empty($value)) && ((strpos($value, $_REQUEST['q']) !== false) || ($_REQUEST['q'] == '  '))) {
					$combo[$value]++;
				}
			}
		}
		if(is_array($combo)) {
			ksort($combo);
			foreach($combo as $key => $value) echo $key . "\n";
		}
	}
}

/*MYSQL_UPDATE_CHAGES
Used with sql() function, look for changes before update a table
*/
function mysqlUpdateChanges($sql, $fields, $exclude=null) {
	$sql = trim($sql);
	if(strtolower(substr($sql, -7)) != 'limit 1') $sql = $sql .' limit 1';

	$select = sql($sql);
	foreach($fields as $key => $value) {
		$go = true;

		if(!empty($exclude)) {
			if(is_array($exclude)) {
				if(array_search($key, $exclude) !== false) $go = false;
			}
			elseif(strpos($exclude, $key) !== false) $go = false;
		}

		if($go) {
			if($value != $select[$key]) {
				if(isDate($value)) $value = dateMask($value);
				if(is_float($value)) $value = comma($value);
				$resp[] = $key .': '. $value;
			}
		}
	}

	$r = false;
	if(is_array($resp)) $r = implode('; ', $resp) .'.';

	return $r;
}


/*SETLISTINFO
 * Return some info about the list. $sql must be a select count*/
function setListInfo($sql, $filterdescr) {
	global $register_per_page;

	if(substr(strtolower($sql), -7) != 'limit 1') $sql .= ' limit 1';
	$temp = sql($sql);

	if($temp['total_reg'] !== null) $resp['total_reg'] = $temp['total_reg'];
	elseif($temp['total'] !== null) $resp['total_reg'] = $temp['total'];

	$resp['reg_per_page'] = getFilter('registers');;
	if(empty($resp['reg_per_page'])) $resp['reg_per_page'] = $register_per_page;

	$resp['actual_page'] = getFilter('nowpage');
	if(empty($resp['actual_page'])) $resp['actual_page'] = 1;

	if(is_array($filterdescr)) {
		foreach($filterdescr as $label => $descr) {
			$descrs[] = $label .': '. $descr .'.';
		}
		$resp['filter_descr'] = implode(' ', $descrs);
	}

	return $resp;
}

/**********************************************\EMAIL FUNCTIONS/**********************************************/

/*
SENDMAIL
Send an email using smtp
Optimized to GMail
*/
function sendMail($to, $subject, $msg, $fromName='', $fromMail='', $html=false, $attach=null) {
	global $MAIL;

	require_once('smtp/class.phpmailer.php');

	$mail = new PHPMailer();
	$mail->SMTP_PORT = $MAIL['SMTP_PORT']; //Port do SMTP connection. GMail uses 587.
	$mail->Host      = $MAIL['SMTP_HOST']; //Your e-mail address
	$mail->Username  = $MAIL['SMTP_USERNAME']; //User to connect
	$mail->Password  = $MAIL['SMTP_PASSWORD']; //Password to connect

	$mail->SetLanguage('br', ''); //Language to use.
	$mail->SMTPSecure = 'tls'; //Communication secure type. GMail uses TLS.
	$mail->IsSMTP(); //To use SMTP protocol
	$mail->SMTPAuth = true; //GMail requires SMTP authentication.
	$mail->WordWrap = 75; //Break the line when hit the char lenght (default: 50)

	$mail->IsHTML($html);
	$mail->From     = $fromMail;
	$mail->FromName = $fromName;
	$mail->Subject  = $subject;
	$mail->Body     = $msg;
	$mail->AddAddress($to);
	$mail->AddReplyTo($fromMail, $fromName);

	if($anexo) {
		if(is_array($anexo)) $lista = $anexo;
		else $lista[] = $anexo;

		foreach($lista as $arq) $mail->AddAttachment($arq);
	}

	return $mail->Send(); //Returns true or false
}



/*
ERRORMONITOR
Send warnings and errors to an email
*/
function errorMonitor($msg) {
	global $ALERT_EVENT_EMAIL;
	$text = date('d/m/Y H:i') ."\n". $_SERVER['PHP_SELF'] ."\n". $msg . "\n";
	foreach($ALERT_EVENT_EMAIL as $mail) {
		sendMail($mail, 'Error on '. SYSTEM_NAME, $texto);
	}
}




/**********************************************\OTHER FUNCTIONS/**********************************************/


/*
DEBUG
used to... debug!
*/
function debug($x) {
	echo '<pre>';
	if(is_array($x)) print_r($x);
	else echo $x;
	echo '</pre>';
}

/*
CREATEPASS
Create a random pass with easy chars
*/
function createPass($size=6, $initpass='') {
	$base = 'abcdefghijklmnopqrstuvwxyz123456789';
	for($ii=0; $ii<$size; $ii++) $initpass .= $base{rand(1, 36)};
	return $initpass;
}

/*
CHANGEDATE
Increase/decrease year, month and/or day (and hour, minute and second) of some date
*/
function changeDate($date, $year=0, $month=0, $day=0, $hour=0, $min=0, $sec=0) {
	if(strlen($date) > 12) { //Date time (Y-m-d H:i:s)
		$temp = explode(' ', $date);
		$dat = explode('-', $temp[0]);
		$tim = explode(':', $temp[1]);
		return date('Y-m-d H:i:s', mktime($tim[0]+$hour, $tim[1]+$min, $tim[2]+$sec, $dat[1]+$month, $dat[2]+$day, $dat[0]+$year));
	} else {
		$split = explode('-', $date);
		return date('Y-m-d', mktime(0, 0, 0, $split[1]+$month, $split[2]+$day, $split[0]+$year));
	}
}

/*
DIFFDATE
Returns the difference between two dates, in days
*/
function diffDate($date1, $date2) {
	//first date
	$date1 = explode('-', $date1);
	$year1 = $date1[0];
	$month1 = $date1[1];
	$day1 = $date1[2];
	//second date
	$date2 = explode('-', $date2);
	$year2 = $date2[0];
	$month2 = $date2[1];
	$day2 = $date2[2];
	//calc
	$date1 = mktime(0, 0, 0, $month1, $day1, $year1);
	$date2 = mktime(0, 0, 0, $month2, $day2, $year2);
	$days = ($date2 - $date1)/86400;
	$days = ceil($days);
	return $days;
}

/*
PLURAL
*/
function plural($text, $number, $doublechar=null) {
	if($number == 1) return str_replace('#', '', $text);
	else {
		if($doublechar) $text = str_replace('##', $doublechar, $text);
		return str_replace('#', 's', $text);
	}
}

/*
MOD11 (Modulo 11)
Create a mod 11 check digit
*/
function mod11($base_val) {
   $result = '';
   $weight = array(2, 3, 4, 5, 6, 7,
                   2, 3, 4, 5, 6, 7,
                   2, 3, 4, 5, 6, 7,
                   2, 3, 4, 5, 6, 7);

	/* For convenience, reverse the string and work left to right. */
	$reversed_base_val = strrev($base_val);

	/* Calculate product and accumulate. */
	for($i=0, $sum=0; $i<strlen($reversed_base_val); $i++) $sum += substr( $reversed_base_val, $i, 1 ) * $weight[ $i ];

	/* Determine check digit, and concatenate to base value. */
	$remainder = $sum % 11;
	switch($remainder) {
	case 0:
		$result = 0;
		break;
	case 1:
		$result = 'n/a';
		break;
	default:
		$check_digit = 11 - $remainder;
		$result = $check_digit;
		break;
	}

	return $result;
}



/*CRIPT and DECRIPT a text with a passkey*/
function cript($text, $passkey) {
	$text = algorithm($text, $passkey);
	for($i=0, $r=chr(rand(65, 90)); $i<strlen($text); $i++) $r .= ord(strval(substr($text, $i, 1))) . chr(rand(65, 90));
	return $r;
}
function decript($text, $passkey) {
	$text = join(array_map('chr', preg_split('/[A-Z]/', substr(substr($text, 1), 0, strlen($text) - 2))));
	return algorithm($text, $passkey);
}
function algorithm($text, $privatekey) {
	$k   = 0;
	$l   = 0;
	$r   = '';
	$len = strlen($privatekey);
	for($j=0; $j<=255; $j++) {
		$key[$j]  = ord(substr($privatekey, $j % $len, 1));
		$sbox[$j] = $j;
	}
	for($k=0; $k<=255; $k++) {
		$l        = ($l + $sbox[$k] + $key[$k]) % 256;
		$i        = $sbox[$k];
		$sbox[$k] = $sbox[$l];
		$sbox[$l] = $i;
	}
	for($j=1; $j<=strlen($text); $j++) {
		$k        = ($k + 1) % 256;
		$l        = ($l + $sbox[$k]) % 256;
		$i        = $sbox[$k];
		$sbox[$k] = $sbox[$l];
		$sbox[$l] = $i;
		$i1       = $sbox[($sbox[$k] + $sbox[$l]) % 256];
		$j1       = ord(substr($text, $j - 1, 1)) ^ $i1;
		$r       .= chr($j1);
	}
	return $r;
}


/*GENERATEKEY
Create a key with any cod, any id and MD5 check security
Returns string with the key
Example: 00.1134.48ae.1b8f.c24
*/
function generateKey($cod, $id, $passkey) {
	$id = (int)$id;

	$md5 = substr(md5($cod . $id . $passkey), 5, 10);
	$md5 = substr($md5, 0, 3) .'.'. substr($md5, 3, -3) .'.'. substr($md5, -3);

	$cod = zerofill($cod, 3);
	$cod = substr($cod, 0, -1) .'.'. substr($cod, -1);

	$id = zerofill($id, 3);
	$id = substr($id, 0, -1) .'.'. substr($id, -1);

	return $cod . $id . $md5;
}

/*EXTRACTKEY
Extract cod and ID from the above function
Returns:
  $array['cod']
  $array['id']
or false if wrong key
*/
function extractKey($key, $passkey) {
	if(empty($key)) return false;
	else {
		$cut = strpos($key, '.')+2;
		$resp['cod'] = str_replace('.', '', substr($key, 0, $cut))*1;
		$key = substr($key, $cut);

		$cut = strpos($key, '.')+2;
		$resp['id'] = str_replace('.', '', substr($key, 0, $cut))*1;
		$key = str_replace('.', '', substr($key, $cut));

		$md5 = substr(md5($resp['cod'] . $resp['id'] . $passkey), 5, 10);

		if($md5 != $key) return false;
		else return $resp;
	}
}



/**********************************************\FILTERS FUNCTIONS/**********************************************/

function filterWord() {
	$filterword = $_SERVER['REQUEST_URI'] .'a';
	$filterword = dirname($filterword);
	return substr($filterword, strrpos($filterword, '/')+1);
}

function getFilter($name) {
	return $_SESSION['FILTER'][filterword()][$name];
}

function setFilter($name, $value) {
	$_SESSION['FILTER'][filterword()][$name] = $value;
	return $value;
}

function defineFilters($changefilter, $clearfilter, $orderby, $nowpage, $registers) {
	global $filters, $register_per_page;

	if(is_array($filters)) {
		foreach($filters as $name) {
			$temp = 'filter_'. $name;
			global $$temp;
		}
	}

	if($changefilter) {
		foreach($filters as $name) {
			$temp = $_REQUEST['filter_'. $name];
			setFilter($name, $temp);
		}
		setFilter('activefilter', true);
		$nowpage = 1;
	}

	if($clearfilter) {
		if(is_array($filters)) foreach($filters as $name) setFilter($name, null);
		setFilter('activefilter', null);
		$nowpage = 1;
	}

	if($orderby) {
		$actual = getFilter('orderby');
		$tempold = explode(' ', $actual);
		$tempnew = explode(' ', $orderby);

		//If same old filter then reverse
		if($tempold[0] == $tempnew[0]) {
			if($tempold[1] == 'desc') $so = 'asc';
			else $so = 'desc';
			$orderby = $tempnew[0] .' '. $so;
		}
		setFilter('orderby', $orderby);
	}

	if($registers) {
		setFilter('registers', $registers);
		$nowpage = 1;
	}

	if($nowpage) setFilter('nowpage', $nowpage);
}

function ifFilter() {
	$f = filterWord();
	if($_SESSION['FILTER'][$f]['activefilter']) {
		echo '<script>'. "\n";
		foreach($_SESSION['FILTER'][$f] as $chave => $valor) echo 'FILTER["'. $chave .'"] = "'. $valor .'";'. "\n";
		echo '</script>';
	}
}

function formatMoney($value){
	return "R$ " . number_format($value, 2, ",", ".");
}


?>