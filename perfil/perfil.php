<?php
//Inclui o arquivo de verifica��o de sess�o.
    include_once("verifica.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="perfil.css">
    <title>E-Market</title>
</head>
<body>
    <header>
        <div class="logo">
             <img src="../imagens/mercado.png" alt="Logo">
        </div>
        <div class="search-bar">
            <input type="search" placeholder="Pesquisar...">
            <button type="submit">Buscar</button>
        </div>
        <div class="cart">
            <a href="  ">
            <img src="../imagens/carrinho.png" alt="Carrinho">
             </a>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../home/index.html">Home</a></li>
            <li><a href="../pedido/compra.php">Produtos</a></li>
            <li><a href="../comparacao/index.html">Comparação</a></li>
            <li><a href="../perfil/perfil.php" style="background-color: #2c3e50; color:white;" >Perfil</a></li> 
        </ul>
    </nav>

    <?php 
		$cpf = $_SESSION['cpf'];
	?>
    <!-- Informações pessoais -->   
        <br><img src="Perfil.png" class="foto_perfil">
            <!-- Deixar a foto de perfil personalizavel -->
        <?php
		    $datasource = 'mysql:host=localhost;dbname=e_market';
		    $user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);

			$query = "SELECT * FROM usuario WHERE cpfUsuario = '$cpf'";//Mudar de algum jeito que pegue o cpf de acordo com o email
			$stm = $db -> prepare($query);
            
            if ($stm -> execute()) {
                while ($row = $stm -> fetch()){
                    $nome = $row['nomeUsuario'];
                    $email = $row['emailUsuario'];
                    $estado = $row['estadoUsuario'];
                    $cidade = $row['cidadeUsuario'];
                    $bairro = $row['bairroUsuario'];
                    $endereco = $row['enderecoUsuario'];
                    $numero = $row['numeroUsuario'];
                    $complemento = $row['complementoUsuario'];
                
                    print "<br><br><label>CPf: $cpf</label><br>";
                    print "<label>Nome: $nome</label><br>";
                    print "<label>Email: $email</label><br>";
                    print "<label>Estado: $estado</label><br>";
                    print "<label>Cidade: $cidade</label><br>";
                    print "<label>Bairro: $bairro</label><br>";
                    print "<label>Endereco: $endereco</label><br>";
                    print "<label>Numero: $numero</label><br>";
                    print "<label>Complemento: $complemento</label><br>";

                    //Opção de alterar as informações(Alguns não podem(Chave Primária))
                        print "<button><a href='edita.php'>Alterar Informações</a></button>";
                }
            } else{
                print '<br><p>Erro ao listar as informações pessoais</p>';
            }
        
            
            ?>
    <!-- Histórico de compras -->
        <?php
			$query = "SELECT * FROM pedido WHERE cpfUsuario = '$cpf'";//Mudar de algum jeito que pegue o cpf de acordo com o email
			$stm = $db -> prepare($query);
            
            if ($stm -> execute()) {
                $encontrouPedido = false;
                while ($row = $stm -> fetch()){
                    $id = $row['idPedido'];
                    $data = $row['dataPedido'];
                    $hora = $row['horaPedido'];
                    $preco = $row['precoFinal'];
                    $status = $row['statusPedido'];
                    $complemento = $row['complementoUsuario'];
                    $encontrouPedido = true;
                    
                    if($status == 'finalizado'){            //Só vai aparecer os que estiverem finalizados
                        print "<br><label>ID: $id</label><br>";
                        print "<label>Data: $data</label><br>";
                        print "<label>Hora: $hora</label><br>";
                        print "<label>Complemento: $complemento</label><br>";
                        print "<label>Preco: $preco</label><br>";
                    }
                }
                if($encontrouPedido == false){
                    print "<br><br><label>Não foi feita nenhuma compra</label><br>";
                }
            } else{
                print '<br><p>Erro ao listar o histórico de compras</p>';
            }
        ?>    
    <!-- Dados de pagamento(Só se acabar tudo antes) -->
    <!-- Opção de entrar e sair -->
    <br><a href='logout.php'>Sair</a>
</body>
</html>