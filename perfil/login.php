<!DOCTYPE html>
<html lang="pt-br">
	<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="perfil.css">
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
	<body>
	<header>
        <div class="logo">
		<a href=" ../home/index.html">
             <img src="../imagens/logo2.png" alt="Logo">
            </a>
        </div>
    </header>
		<div class="loga">
			<h3>Login</h3>
				<form method="post" action="confirmalogin.php">
					<label>CPF:</label>
					<input name="cpf" /><br>
					<label>Senha:</label>
					<input type="password" name="senha" /><br>
					<button type="submit">Logar</button>
				</form>
			<br><br><a href='cadastra.php'>Nâo tem login? Cadastre-se.</a>
		</div>
	</body>
</html>