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
		    $datasource = 'mysql:host=localhost;dbname=e_market';
		    $user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);

			$query = "SELECT * FROM usuario WHERE cpfUsuario = '1234568911'";//Mudar de algum jeito que pegue o cpf de acordo com o email
			$stm = $db -> prepare($query);
            
            if ($stm -> execute()) {
                while ($row = $stm -> fetch()){
                    $cpf = $row['cpfUsuario'];
                    $nome = $row['nomeUsuario'];
                    $email = $row['emailUsuario'];
                    $estado = $row['estadoUsuario'];
                    $cidade = $row['cidadeUsuario'];
                    $bairro = $row['bairroUsuario'];
                    $endereco = $row['enderecoUsuario'];
                    $numero = $row['numeroUsuario'];
                    $complemento = $row['complementoUsuario'];
                
                    print "<br><label>CPf: $cpf</label><br>";
                    print "<label>Nome: $nome</label><br>";
                    print "<label>Email: $email</label><br>";
                    print "<label>Estado: $estado</label><br>";
                    print "<label>Cidade: $cidade</label><br>";
                    print "<label>Bairro: $bairro</label><br>";
                    print "<label>Endereco: $endereco</label><br>";
                    print "<label>Numero: $numero</label><br>";
                    print "<label>Complemento: $complemento</label><br>";
                }
            } else{
                print '<p>Erro ao listar as informações pessoais</p>';
            }
        ?>
            <!-- Opção de alterar as informações(Alguns não podem(Chave Primária)) -->
		</form>
    <!-- Histórico de compras -->
    <!-- Dados de pagamento(Talvez) -->
    <!-- Opção de entrar e sair -->
</body>
</html>