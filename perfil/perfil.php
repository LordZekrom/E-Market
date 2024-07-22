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

			$query = "SELECT * FROM cpfUsuario WHERE cpfUsuario = '12345678911'";//Mudar de algum jeito que pegue o cpf de acordo com o email
			$stm = $db -> prepare($query);
            
            if ($stm -> execute()) {
                $row = $stm -> fetch(){
                    $cpf = $row['cpfUsuario'];
                    $nome = $row['nomeUsuario'];
                    $email = $row['emailUsuario'];
                    $estado = $row['estadoUsuario'];
                    $cidade = $row['cidadeUsuario'];
                    $bairro = $row['bairroUsuario'];
                    $endereco = $row['enderecoUsuario'];
                    $numero = $row['numeroUsuario'];
                    $complemento = $row['complementoUsuario'];
                
                    //Não tá funcionando em mostrar as informações do usuario

                    print "<label>CPf: $cpf</label>";
                    print "<label>Nome: $nome</label>";
                    print "<label>Email: $email</label>";
                    print "<label>Estado: $estado</label>";
                    print "<label>Cidade: $cidade</label>";
                    print "<label>Bairro: $bairro</label>";
                    print "<label>Endereco: $endereco</label>";
                    print "<label>Numero: $numero</label>";
                    print "<label>Complemento: $complemento</label>";
                }
            } else{
                print '<p>Erro ao listar as informações pessoais</p>';
            }
        ?>
            <!-- Opção de alterar as informações(Alguns não podem(Chave Primária)) -->
		</form>
        <label></label>
    <!-- Histórico de compras -->
    <!-- Dados de pagamento(Talvez) -->
    <!-- Opção de entrar e sair -->
</body>
</html>