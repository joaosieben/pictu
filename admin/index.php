<?php
	# Verificando se já existe uma sessão iniciada.
	session_start();
	if(!isset($_SESSION['id'])) {
		# Se não existe uma sessão iniciada, redireciona para a tela de login.
		$address = "http://localhost/pictu/admin/login.php";
		header("location: $address");
	}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<title>pictu. (painel)</title>
		<base href="http://localhost/pictu/" />
		<script type="text/javascript" src="includes/js/bootstrap.js"></script>
		<script type="text/javascript" src="includes/js/jquery.js"></script>
		<script type="text/javascript" src="includes/js/modernizr.js"></script>
		<script type="text/javascript" src="includes/js/popcorn.js"></script>
		<link rel="stylesheet" type="text/css" href="includes/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="includes/css/style.css" />
		<link rel="stylesheet" type="text/css" href="includes/css/admin.css" />
	</head>
	<body class="admin dash">
		<div id="primary">
			<header id="masthead">
				<hgroup id="branding">
					<h1 class="site-title">
						<a href="index.php" target="_self" title="pictu. (página inicial)">pictu.</a>
					</h1> <!-- .site-title -->
					<h2 class="page-title">/ painel</h2>
				</hgroup> <!-- #branding -->
				<nav id="main-navigation">
					<p>Olá, <?php echo $_SESSION['name']; ?>. Gerencie <a href="admin/films.php" target="_self" title="Gerenciar filmes">filmes</a>, <a href="admin/people.php" target="_self" title="Gerenciar pessoas">pessoas</a> ou <a href="admin/logout.php" target="_self" title="pictu. (sair)">dê tchau</a>.
				</nav> <!-- #main-navigation -->
			</header> <!-- #masthead -->
		</div> <!-- #primary -->
	</body>
</html>