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
	# Se o usuário preencheu o formulário de redefinição de senha.
	if($user_action == 'reset') {
		$user_email = $_POST['user_email'];
		
		# Se o usuário não preencheu corretamente o formulário de redefinição de senha.
		if(strlen($user_email) == 0) {
			$address = "http://localhost/pictu/admin/reset-password.php?error=1";
		}
		else {
			$user = new users($user_email,"000");
			
			$user->reset_password();
			$address = "http://localhost/pictu/admin/reset-password.php?success=1";
		}
		header("location: $address");
	}
	# Se o usuário quer encerrar uma seção iniciada.
	if((isset($_GET['action'])) && ($_GET['action'] == 'logout')) {
		session_start();
		$user_email = $_SESSION['email'];
		$user = new users($user_email,"000");
		$user->logout();
	}
	
?>