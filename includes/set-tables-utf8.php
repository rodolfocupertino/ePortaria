<?

//Host do banco de dados
define("DB_HOST","localhost");
//Nome do Banco
define("DB_BANCO","dominus_bd");
//Usuário do Banco
define("DB_USUARIO","root");
//senha
define("DB_SENHA","senha");
	
$msg[0] = "Não foi possivel fazer uma conexao com o banco. Erro: ";
$msg[1] = "Não foi possivel selecionar o banco de dados. Erro: ";

$conexao = mysql_connect(DB_HOST, DB_USUARIO, DB_SENHA) or die ($msg[0] . mysql_error());
mysql_select_db(DB_BANCO, $conexao) or die($msg[1] . mysql_error()); 

# Aqui está o segredo
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');


//ALTER TABLE `agenda`  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci

print "<h2>LISTAR TABELAS DE BANCO</h2>";
$sql = "SHOW TABLES FROM ibimperi_cms";
$result = mysql_query($sql);

if (!$result) {
    echo "Erro no banco, não pode listas as tabelas<br>";
    echo 'Erro no MySQL: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
	$tbl = $row[0];
    echo "Tabela: $tbl<br>";	
	$sql_updt = "ALTER TABLE `$tbl`  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; ".
	" ALTER TABLE `$tbl` ENGINE=MYISAM; ";
	echo "$sql_updt<hr>";
	mysql_query($sql_updt) or die(mysql_error());
	
	//ALTER TABLE `agenda`  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci

}


?>