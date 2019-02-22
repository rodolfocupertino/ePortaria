<?
header("Content-Type:text/html; charset=utf-8");

session_start();

include_once ("../admin/includes/includes.inc.php");

extract($_REQUEST);

//var_dump($_REQUEST);

//echo $intellisearch."<hr>".$value."<hr>";

//Se true
if ($intellisearch=="true"){

	// Inicia a Busca em Cliente pelo nome
	$sqlcliente = "SELECT * FROM clients_suppliers WHERE type='C' AND firstname LIKE '%$value%' or company_name LIKE '%$value%' ORDER BY firstname,company_name ASC LIMIT 8";
	$querycliente = mysql_query($sqlcliente);
	$nreg = mysql_num_rows($querycliente);
	if ($nreg > 0) {
	//DebugShow($sql,"");
	echo "<br/><strong>Clientes:</strong><br/>";
		while ($rscliente = mysql_fetch_array($querycliente)) {
			extract($rscliente);
			echo "<a href=\"../clients/formulario.php?oper=alt&id=$id\" >$id - $firstname $lastname ($company_name)</a><br/>";
		}
	}

	$nreg = 0;

	// Inicia a Busca do Fornecedor pelo nome
	$sqlfornecedor = "SELECT * FROM cliente_fornecedor WHERE tipo_cadastro='F' AND nome LIKE '%$value%' ORDER BY nome ASC LIMIT 8";
	$queryfornecedor = mysql_query($sqlfornecedor);
	//DebugShow($sql,"");
	$nreg = mysql_num_rows($queryfornecedor);
	if ($nreg > 0) {
	echo "<br/><strong>Fornecedor:</strong><br/>";
		while ($rsfornecedor = mysql_fetch_array($queryfornecedor)) {
			extract($rsfornecedor);
			echo "<a href=\"../cliente/formulario.php?oper=alt&id=$idcliente_fornecedor\" >$idcliente_fornecedor - $nome</a><br/>";
		}
	}

	$nreg = 0;

	// Inicia a Busca do Produto pelo nome
	$sqlproduto = "SELECT * FROM produto_servico WHERE descricao LIKE '%$value%' ORDER BY descricao ASC LIMIT 8";
	$queryproduto = mysql_query($sqlproduto);
	//DebugShow($sql,"");
	$nreg = mysql_num_rows($queryproduto);
	if ($nreg > 0) {
	echo "<br/><strong>Produto:</strong><br/>";
		while ($rsproduto = mysql_fetch_array($queryproduto)) {
			extract($rsproduto);
			echo "<a href=\"../produto_servico/formulario.php?oper=alt&id=$idproduto_servico\" >$idproduto_servico - $descricao</a><br/>";
		}
	}


	if ($nreg == 0) {
  		//echo "Nenhum resultado foi encontrado.";
	}

}

?>

