<!DOCTYPE html>
<html lang="pt-br">
	<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" type="text/css" href="login.css" />
</head>
	<body>
	<header>
        <div class="logo">
		<a href=" ../home/index.html">
             <img src="../imagens/logo2.png" alt="Logo">
            </a>
        </div>
    </header>
	<form method="post" action="confirmalogin.php">
  		<div class="loga">
    		<p class="form-title">Entre com a sua conta</p>
    			<div class="input-container">
      				<input type="text" name="cpf" placeholder="Digite seu CPF">
    			</div>
			<div class="input-container">
      			<input type="password" name="senha" placeholder="Digite sua senha">
    		</div>
    	<button type="submit" class="submit">Entrar</button>
    		<p class="cadastrar-link">
      			Não tem uma conta?
      				<a href="cadastra.php">Cadastre-se</a>
    		</p>
  		</div>
	</form>

	</body>
</html>