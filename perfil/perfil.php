<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="perfil.css">
</head>
<body>
    <!-- Informações pessoais -->
        <img src="Perfil.png" class="foto_perfil">
            <!-- Deixar a foto de perfil personalizavel -->
        <?php
		    /* Conectando com o banco de dados para listar registros */
		    $datasource = 'mysql:host=localhost;dbname=atividades';
		    $user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);
            
			$query = "SELECT * FROM pesquisa";
			$stm = $db -> prepare($query);
            //TENTATIVA DE CONECTAR AOS DADOS DO BANCO DE DADOS
        ?>
            <!-- Opção de alterar as informações(Alguns não podem(Chave Primária)) -->
		</form>
    <!-- Histórico de compras -->
    <!-- Dados de pagamento(Talvez) -->
    <!-- Opção de entrar e sair -->
</body>
</html>