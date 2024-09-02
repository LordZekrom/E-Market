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

// Busca os dados do usuário
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
            <li><a href="../comparacao/index.php">Comparação</a></li>
            <li><a href="../perfil/perfil.php" style="background-color: #2c3e50; color:white;">Perfil</a></li> 
        </ul>
    </nav>

    <!-- Informações pessoais -->
    <div class="perfil-info">
        <br>
        <!-- Exibe a foto de perfil personalizada -->
        <img src="imagens/<?php echo htmlspecialchars($fotoPerfil); ?>" class="foto_perfil" alt="Foto de Perfil">
        <br><br>
        <label>CPF: <?php echo htmlspecialchars($cpf); ?></label><br>
        <label>Nome: <?php echo htmlspecialchars($nome); ?></label><br>
        <label>Email: <?php echo htmlspecialchars($email); ?></label><br>
        <label>Estado: <?php echo htmlspecialchars($estado); ?></label><br>
        <label>Cidade: <?php echo htmlspecialchars($cidade); ?></label><br>
        <label>Bairro: <?php echo htmlspecialchars($bairro); ?></label><br>
        <label>Endereço: <?php echo htmlspecialchars($endereco); ?></label><br>
        <label>Número: <?php echo htmlspecialchars($numero); ?></label><br>
        <label>Complemento: <?php echo htmlspecialchars($complemento); ?></label><br>
        
        <!-- Opção de alterar as informações -->
        <button><a href='edita.php'>Alterar Informações</a></button>
    </div>

    <!-- Histórico de compras -->
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
            $complemento = $row['complementoUsuario'];
            $encontrouPedido = true;

            if ($status == 'finalizado') { // Só vai aparecer os que estiverem finalizados
                print "<br><label>ID: $id</label><br>";
                print "<label>Data: $data</label><br>";
                print "<label>Hora: $hora</label><br>";
                print "<label>Complemento: $complemento</label><br>";
                print "<label>Preço: $preco</label><br>";
            }
        }
        if (!$encontrouPedido) {
            print "<br><br><label>Não foi feita nenhuma compra</label><br>";
        }
    } else {
        print '<br><p>Erro ao listar o histórico de compras</p>';
    }
    ?>

    <!-- Dados de pagamento (Comentado, se necessário no futuro) -->
    <!-- Opção de entrar e sair -->
    <br><a href='logout.php'>Sair</a>
</body>
</html>
