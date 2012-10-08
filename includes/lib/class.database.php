<?php
	class db {
		private $db_host;
		private $db_name;
		private $db_user;
		private $db_pass;
		
		public function __construct() {
			# Definindo os parâmetros de conexão ao banco de dados.
			$db_host = "localhost";
			$db_name = "pictu";
			$db_user = "root";
			$db_pass = "278487";
			
			# Conectando ao servidor do banco de dados.
			$link = mysql_connect($db_host,$db_user,$db_pass);
			
			# Verificando se a conexão foi efetuada.
			if(!$link) {
				# Exibindo mensagem de erro.
				echo "Erro de conexão ao banco de dados (".mysql_errno($link).").";
			}
			else {
				# Selecionando o banco.
				$select = mysql_select_db($db_name,$link);
			}
		}
		
		public function query($sql_query) {
			# Executando a consulta ao banco.
			$results = mysql_query($sql_query);
			
			# Verificando se existem resultados.
			if(mysql_num_rows($results) == 0) {
				$result = false;
			}
			else {
				$result = mysql_fetch_assoc($results);
			}
			
			return $result;
		}
	}
?>