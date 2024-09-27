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
		<form method="post" action="confirmalogin.php">
			<div  class="form"> 
  			<p class="form-title">Entre com a sua conta</p>
  				<div class="input-container">
    				<input type="cpf" placeholder="Digite seu CPF">
  				</div>
  			<div class="input-container">
    			<input type="password" placeholder="Digite sua senha">
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