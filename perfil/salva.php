<?php	
	/* Recebendo os dados do formul�rio */
	$cpf = $_POST['cpf'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	
	/* Conectando com o banco de dados para cadastrar registros */
	$datasource = 'mysql:host=localhost;dbname=e_market';
	$user = 'root';
	$pass = 'vertrigo';
	$db = new PDO($datasource, $user, $pass);
	
	$query = "INSERT INTO usuario (cpfUsuario,nomeUsuario,emailUsuario,senhaUsuario) VALUES(?,?,?,?)";			
	$stm = $db->prepare($query);
	$stm->bindParam(1, $cpf);
	$stm->bindParam(2, $nome);
	$stm->bindParam(3, $email);
	$stm->bindParam(4, $senha);
		
	if($stm->execute()) {
		print "<p>Cadastro efetuado com sucesso</p>";
		print "<a href='perfil.php'>Voltar</a>";
	}
	else {
		print "<p>Erro ao cadastrar usu�rio!</p>";
		print "<a href='perfil.php'>Voltar</a>";
	}	
?>