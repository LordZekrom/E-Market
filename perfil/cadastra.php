<html>
	<head><title>Cadastrar Usuário</title>
    	<link rel="stylesheet" href="../perfil.css">
		<link rel="stylesheet" type="text/css" href="cadastra.css" />
	</head>
	<body>
	<header>
        <div class="logo">
		<a href=" ../home/index.html">
             <img src="../imagens/logo2.png" alt="Logo">
            </a>
        </div>
    </header>
		<form method="post" action="salva.php">
  			<div class="login-box">
				<h3 class="form-title">Cadastro</h3>
    				<div class="input-container">
      					<label>CPF:</label>
     					<input name="cpf" placeholder="Digite seu CPF" />
    				</div>
    				<div class="input-container">
      					<label>Nome:</label>
      					<input name="nome" placeholder="Digite seu nome" />
    				</div>
    				<div class="input-container">
      					<label>Email:</label>
      					<input name="email" placeholder="Digite seu email" />
    				</div>
    				<div class="input-container">
      					<label>Senha:</label>
      					<input type="password" name="senha" placeholder="Digite sua senha" />
    				</div>
    				<div class="input-container">
      					<label>Foto de Perfil:</label>
      					<input type="file" name="fotoPerfil" />
    				</div>
    			<button type="submit" class="submit">Cadastrar</button>
  			</div>
		</form>
	</body>
</html>