<?php
	# Obtendo a classe referente às funções para manipulação do banco.
	require_once("class.database.php");
	
	class users {
		public $user_mail;
		public $user_pass;
		
		public function __construct($email,$pass) {
			$this->user_mail = $email;
			$this->user_pass = $pass;
		}
		
		public function hash() {
			$this->user_pass = md5($this->user_pass);
		}
		
		public function login() {
			# Criando a consulta SQL e conectando ao banco de dados.
			$sql_query = "SELECT * FROM users WHERE email = '".$this->user_mail."';";
			$db = new db();
			
			# Executando a consulta.
			$results = $db->query($sql_query);
			
			# Verificando os resultados.
			if($results == false) {
				# Se não existir usuário com este email.
				$return = false;
			}
			else {
				# Se houver usuário com este email, verificar a senha.
				if($results['password'] == $this->user_pass) {
					# Se a senha estiver correta.
					session_start();
					$_SESSION['id'] = $results['id'];
					$_SESSION['name'] = $results['name'];
					$_SESSION['email'] = $results['email'];
					$return = true;
				}
				else {
					# Se a senha estiver errada.
					$return = false;
				}
			}
			return $return;
		}
		
		public function logout() {
			session_start();
			session_destroy();
			
			$address = "http://localhost/pictu/";
			header("location: $address");
		}
		
		public function register($user_name) {
			# Verificando se já existe um usuário com esse endereço de email.
			$sql_query = "SELECT * FROM users WHERE email = '".$this->user_email."';";
			$db = new db();
			
			$results = $db->query($sql_query);
			
			# Se não existir um usuário com esse endereço de email.
			if($results == false) {
				# Criando a consulta para adicionar o novo usuário.
				$sql_query = "INSERT INTO users (id,name,email,password) VALUES (null,'$user_name','$this->user_email','$this->user_pass');";
				$db->query($sql_query);
				$return = true;
			}
			else {
				# Se já existir um usuário com esse endereço de email.
				$return = false;
			}
			
			return $return;
		}
	}
?>