<?php
// Inicia a sess�o.
session_start();

// Pegando os dados de login enviados.
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$senha = md5($senha);

/* Conectando com o banco de dados para cadastrar registros */
$datasource = 'mysql:host=localhost;dbname=e_market';
$user = 'root';
$pass = 'vertrigo';
$db = new PDO($datasource, $user, $pass);
	
$query = "SELECT * FROM usuario WHERE cpfUsuario=? AND senhaUsuario=?";
$stm = $db->prepare($query);
$stm->bindParam(1, $cpf);
$stm->bindParam(2, $senha);
$stm->execute();

if ($stm -> fetch()) {
	// Login efetuado com sucesso.

	// Armazenando usuário na sessão.
	$_SESSION['cpf'] = $cpf;
	
	// Redirecionando para a página inicial.
	header("location:perfil.php");
} else {
	// Caso usuário ou senha estejam incorretos.
	print "<p>Usuário e/ou Senha Inválidos!</p>";
	print "<a href='perfil.php'>Voltar</a>";
}
?>
