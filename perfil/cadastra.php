<html>
	<head><title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<h3>Login</h3>
		<form method="post" action="salva.php">
			<label>CPF:</label>
			<input name="cpf" /><br>
			<label>Nome:</label>
			<input name="nome" /><br>
			<label>Email:</label>
			<input name="email" /><br>
			<label>Senha:</label>
			<input type="password" name="senha" /><br>
			<label>Foto de Perfil:</label>
            <input type="file" name="fotoPerfil" /><br>
			<button type="submit">Cadastrar</button>
		</form>
	</body>
</html>