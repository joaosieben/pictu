<?php
	/**
	 * Arquivo de direcionamento de funções para autenticação.
	**/
	
	require_once("lib/class.users.php");
	
	$user_action = $_POST['user_action'];
	
	# Se o usuário preencheu o formulário de login.
	if($user_action == 'login') {
		$user_email = $_POST['user_email'];
		$user_pass = $_POST['user_pass'];
		
		# Se o usuário não preencheu corretamente o formulário de login.
		if( (strlen($user_email) == 0) || (strlen($user_pass) == 0) ) {
			$address = "http://localhost/pictu/admin/login.php?error=1";
		}
		else {
			# Criando uma instância de usuário.
			$user = new users($user_email,$user_pass);
			
			# Criptografando a senha do usuário.
			$user->hash();
			
			# Efetuando login.
			$login = $user->login();
			
			# Se ocorreu um erro ao entrar.
			if($login == false) {
				$address = "http://localhost/pictu/admin/login.php?error=2";
			}
			else {
				# Se o login foi efetuado com sucesso.
				$address = "http://localhost/pictu/admin/index.php";
			}
		}
		
		header("location: $address");
	}
	
?>