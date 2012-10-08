<?php
	# Obtendo a classe referente às funções para manipulação do banco.
	require_once("class.database.php");
	
	
	$options = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_*+";
	$num = rand(0,65);
	echo $options[$num];
	
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
		
		public function reset_password() {
			# Criando um vetor com os caracteres possíveis para uma nova senha.
			$options = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_*+";
			
			$new_pass = "";
			for($count = 0;$count < 8;$count++) {
				# Gerando a nova senha através de um caracter aleatório.
				$position = rand(0,65);
				$new_pass .= $options[$position];
			}
			
			# Criptografando a senha para inserí-la no banco de dados.
			$this->user_pass = $new_pass;
			$hash = $this->hash();
			
			# Adicionando a nova senha ao banco de dados.
			$sql_query = "UPDATE password = '$hash' WHERE email = '$this->user_mail';";
			$db = new db();
			$db->query($sql_query);
			
			# Enviando o email da nova senha para o usuário.
			$mail_to = $this->user_mail;
			$mail_subject = "[pictu.] Sua nova senha.";
			$mail_message = "Olá,\nAlguém (provavelmente você) requisitou uma redefinição de senha para a conta que pertence a este endereço de email.\n\nA nova senha é $new_pass\n\nSe você não requisitou essa nova senha, não se preocupe. Esse email foi enviado somente para esse endereço. Recomendamos, porém, que você fale com o administrador do pictu.\n\nAtt.,\nO robô.";
			mail($mail_to,$mail_subject,$mail_message);
			
			return true;
		}
		
		public function edit($new_email,$new_name,$new_pass) {
			# Verificando se o novo email já possui um cadastro.
			$sql_query = "SELECT * FROM users WHERE email = '$new_email';";
			$db = new db();
			
			$results = $db->query($sql_query);
			
			# Se não houver um cadastro com esse email.
			if($results == false) {
				# Editar as informações do usuário.
				$sql_query = "UPDATE email = '$new_email', name = '$new_name', password = '$new_pass' WHERE id = ".$results['id'].";";
				$results = $db->query($sql_query);
				
				$_SESSION['name'] = $new_name;
				$_SESSION['email'] = $new_email;
				
				
				$this->user_mail = $new_email;
				$this->user_pass = $new_pass;
				
				$return = true;
			}
			else {
				# Se já existir um cadastro com esse email.
				$return = false;
			}
			
			return $return;
		}
		
		public function get_email() {
			# Obtendo o email do usuário.
			return $this->user_email;
		}
		
		public function get_name() {
			# Obtendo o nome do usuário.
			$sql_query = "SELECT * FROM users WHERE email = '$this->user_mail';";
			$db = new db();
			
			$results = $db->query($sql_query);
			
			return $results['name'];
		}
		
		public function get_id() {
			# Obtendo o ID do usuário.
			$sql_query = "SELECT * FROM users WHERE email = '$this->user_mail';";
			$db = new db();
			
			$results = $db->query($sql_query);
			
			return $results['id'];
		}
	}
?>