<?php
// Inclui o arquivo de verificação de sessão.
include_once("verifica.php");

// Recebe o cpf da sessão
$cpf = $_SESSION['cpf'];

// Conecta com BD
$datasource = 'mysql:host=localhost;dbname=e_market';
$user = 'root';
$pass = 'vertrigo';
$db = new PDO($datasource, $user, $pass);

// Busca os dados do usuárioo
$query = "SELECT * FROM usuario WHERE cpfUsuario = :cpf";
$stm = $db->prepare($query);
$stm->bindParam(':cpf', $cpf);

if ($stm->execute()) {
    $user = $stm->fetch(PDO::FETCH_ASSOC);

    $nome = $user['nomeUsuario'];
    $email = $user['emailUsuario'];
    $estado = $user['estadoUsuario'];
    $cidade = $user['cidadeUsuario'];
    $bairro = $user['bairroUsuario'];
    $endereco = $user['enderecoUsuario'];
    $numero = $user['numeroUsuario'];
    $complemento = $user['complementoUsuario'];
    $tipoUsuario = $user['tipoUsuario'];
    $fotoPerfil = $user['fotoPerfil'] ?: 'Perfil.png'; // Usa 'default.png' se 'fotoPerfil' estiver vazio
} else {
    echo '<br><p>Erro ao listar as informações pessoais</p>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css" />
    <link rel="stylesheet" href="perfil.css">
    <title> Perfil E-Market</title>
    <style>
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            text-align: center;
            font-size: 16px;
            transition: background-color 0.3s;
            position: relative;
            right: 45%;
        }

    .logout-btn:hover {
        background-color: #34495e;
        color: #f1f1f1;
    }
    </style>
</head>
<body>
    <header>
    <div class="logo">
        <a href=" ../home/index.html">
             <img src="../imagens/logo2.png" alt="Logo">
            </a>
        </div>
        <div class="search-bar">
            <input type="search" placeholder="Pesquisar...">
            <button type="submit">Buscar</button>
        </div>
        <div class="cart">
        <a href="../pedido/carrinho.php">
                <img src="../imagens/carrinho.png" alt="Carrinho">
            </a>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../home/index.html">Home</a></li>
            <li><a href="../pedido/compra.php">Produtos</a></li>
            <li><a href="../comparacao/index.php">Comparação</a></li>
            <li><a href="../perfil/perfil.php" style="background-color: #2c3e50; color:white;">Perfil</a></li> 
        </ul>
    </nav>
    <div class=bloco-peril>
        <div class="perfil-info">
        <br>
        <img src="imagens/<?php echo htmlspecialchars($fotoPerfil); ?>" class="foto_perfil" alt="Foto de Perfil">
        <br><br>
        <table border="1">
        <tr>
            <th>Campos</th>
            <th>Dados pessoais</th>
        </tr>
        <tr>    
            <td>CPF</td>
            <td><?php echo htmlspecialchars($cpf); ?></td>
        </tr>
        <tr>
            <td>Nome</td>
            <td><?php echo htmlspecialchars($nome); ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo htmlspecialchars($email); ?></td>
        </tr>
        <tr>
            <td>Estado</td>
            <td><?php echo htmlspecialchars($estado); ?></td>
        </tr>
        <tr>
            <td>Cidade</td>
            <td><?php echo htmlspecialchars($cidade); ?></td>
        </tr>
        <tr>
            <td>Bairro</td>
            <td><?php echo htmlspecialchars($bairro); ?></td>
        </tr>
        <tr>
            <td>Endereço</td>
            <td><?php echo htmlspecialchars($endereco); ?></td>
        </tr>
        <tr>
            <td>Número</td>
            <td><?php echo htmlspecialchars($numero); ?></td>
        </tr>
        <tr>
            <td>Complemento</td>
            <td><?php echo htmlspecialchars($complemento); ?></td>
        </tr>
        </table>
        <button><a href='edita.php' >Alterar Informações</a></button>
    </div>
    <div class="pedidos-finalizados">
    <h2>Histórico de Pedidos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Preço</th>
        </tr>
        <?php
            $query = "SELECT * FROM pedido WHERE cpfUsuario = :cpf";
            $stm = $db->prepare($query);
            $stm->bindParam(':cpf', $cpf);

            if ($stm->execute()) {
                $encontrouPedido = false;

                while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['idPedido'];
                    $data = $row['dataPedido'];
                    $hora = $row['horaPedido'];
                    $preco = $row['precoFinal'];
                    $status = $row['statusPedido'];
                    $encontrouPedido = true;

                    if ($status == 'finalizado') {
                        echo "<tr>
                                <td>$id</td>
                                <td>$data</td>
                                <td>$hora</td>
                                <td>R$ $preco</td>
                              </tr>";
                    }
                }

                if (!$encontrouPedido) {
                    echo "<tr><td colspan='5'>Não foi feita nenhuma compra</td></tr>";
                }
            } else {
                echo '<tr><td colspan="5">Erro ao listar o histórico de compras</td></tr>';
            }
        ?>
    </table>
</div>

        <?PHP 
            if($tipoUsuario == "adm"){
            echo "<br><a href='usuarios/usuarios.php' class='logout-btn'>Editar Usuarios</a><br>";
            }
        ?>
        <br><a href="logout.php" class="logout-btn">Sair da conta</a>
    </div>
</body>
</html>
