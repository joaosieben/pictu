<?php
	# Verificando se já existe uma seção iniciada.
	session_start();
	if(isset($_SESSION['id'])) {
		$address = "http://localhost/pictu/admin/index.php";
		header("location: $address");
	}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<title>pictu. (entrar)</title>
		<base href="../" />
		<script type="text/javascript" src="includes/js/bootstrap.js"></script>
		<script type="text/javascript" src="includes/js/jquery.js"></script>
		<script type="text/javascript" src="includes/js/modernizr.js"></script>
		<link rel="stylesheet" type="text/css" href="includes/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="includes/css/style.css" />
		<link rel="stylesheet" type="text/css" href="includes/css/admin.css" />
	</head>
	<body class="admin auth">
		<div id="primary">
			<header id="masthead">
				<hgroup id="branding">
					<h1 class="site-title">
						<a href="index.php" target="_self" title="pictu. (página inicial)">pictu.</a>
					</h1>
					<h2 class="page-title">/ entrar</h2>
				</hgroup> <!-- #branding -->
				<nav id="main-navigation">
					<p><a href="admin/login.php" target="_self" title="pictu. (entrar)">Entre</a> ou <a href="admin/recover-password.php" target="_self" title="pictu. (recuperar senha)">recupere sua senha</a>.</p>
				</nav> <!-- #main-navigation -->
			</header> <!-- #masthead -->
			<article id="main">
				<header>
					<?php
						# Verificando se existe uma mensagem de erro no GET.
						if(isset($_GET['error'])) {
							if($_GET['error'] == 1) {
						?>
					<h3 class="section-title error">Verifique se você preencheu todos os campos.</h3>	
						<?php
							}
							else {
						?>
					<h3 class="section-title error">O email ou a senha estão incorretos.</h3>
						<?php
							}
						}
						else {
							# Se não existe uma mensagem de erro.
					?>
					<h3 class="section-title">Informe seus dados para entrar.</h3>
					<?php
						}
					?>
				</header>
				<form action="includes/auth.php" method="post">
					<p>
						<label for="user_email">Email:</label>
						<input type="email" name="user_email" placeholder="eu@exemplo.com" required />
					</p>
					<p>
						<label for="user_pass">Senha:</label>
						<input type="password" name="user_pass" placeholder="ultrasecreta" required />
					</p>
					<p class="submit">
						<input type="hidden" name="user_action" value="login" />
						<button type="submit">Entrar</button>
					</p>
				</form>
			</article> <!-- #main -->
			<footer id="colophon">
				<p>&copy; pictu.</p>
			</footer> <!-- #colophon -->
		</div> <!-- #primary -->
	</body>
</html>