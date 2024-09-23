<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Document</title>

</head>
<body>
<<<<<<< HEAD
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
            <a href=" ../pedido/carrinho.php">
=======
    <header>
    <div class="logo">
        <a href="../home/index.html">
            <img src="../imagens/mercado.png" alt="Logo">
        </a>
    </div>
    <div class="search-bar">
        <input type="search" placeholder="Pesquisar...">
        <button type="submit">Buscar</button>
    </div>
    <div class="cart">
        <a href="../pedido/carrinho.php">
>>>>>>> b896dd1894463466011d904418ad48ec3b997dd4
            <img src="../imagens/carrinho.png" alt="Carrinho">
        </a>
    </div>
</header>
<nav>
    <ul>
        <li><a href="../home/index.html" >Home</a></li>
        <li><a href="../pedido/compra.php">Produtos</a></li>
        <li><a href="../comparacao/index.php" style="background-color: #2c3e50; color: white;">Comparação</a></li>
        <li><a href="../perfil/perfil.php">Perfil</a></li>
    </ul>
</nav>
<main>
</body>
</html>

<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "vertrigo";
$database = "e_market";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifique se os índices existem em $_POST
$produto1_id = isset($_POST['produto1']) ? $_POST['produto1'] : null;
$produto2_id = isset($_POST['produto2']) ? $_POST['produto2'] : null;

if ($produto1_id && $produto2_id) {
    // Preparar consultas SQL
    $sql1 = "SELECT nomeProduto, precoProduto, fotoProduto FROM produto WHERE codigoProduto = ?";
    $sql2 = "SELECT nomeProduto, precoProduto, fotoProduto FROM produto WHERE codigoProduto = ?";

    // Consultas preparadas para evitar SQL Injection
    $stmt1 = $conn->prepare($sql1);
    if (!$stmt1) {
        die("Erro na preparação da consulta: " . $conn->error);
    }
    $stmt1->bind_param("i", $produto1_id);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    $stmt2 = $conn->prepare($sql2);
    if (!$stmt2) {
        die("Erro na preparação da consulta: " . $conn->error);
    }
    $stmt2->bind_param("i", $produto2_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result1->num_rows > 0 && $result2->num_rows > 0) {
        $produto1 = $result1->fetch_assoc();
        $produto2 = $result2->fetch_assoc();

        echo "<h2>Comparação de Produtos</h2>";

        // Caminho da imagem
        $imagemPath1 = '../produtos/imagens/' . htmlspecialchars($produto1['fotoProduto']);
        $imagemPath2 = '../produtos/imagens/' . htmlspecialchars($produto2['fotoProduto']);
        
        echo "<div class='pri'>Produto 1: " . htmlspecialchars($produto1['nomeProduto']) . "<br>";
        echo "<img src='$imagemPath1' alt='" . htmlspecialchars($produto1['nomeProduto']) . "' style='width: 100px; height: auto;'><br>";
        echo "Preço: R$ " . number_format($produto1['precoProduto'], 2, ',', '.') . "</p>";

        echo "<div class='sec'>Produto 2: " . htmlspecialchars($produto2['nomeProduto']) . "<br>";
        echo "<img src='$imagemPath2' alt='" . htmlspecialchars($produto2['nomeProduto']) . "' style='width: 100px; height: auto;'><br>";
        echo "Preço: R$ " . number_format($produto2['precoProduto'], 2, ',', '.') . "</p>";
    } else {
        echo "Um dos produtos não foi encontrado.";
    }

    // Fechar as declarações
    $stmt1->close();
    $stmt2->close();
} else {
    echo "Por favor, selecione um produto em cada tabela para comparar.";
}

// Fechar a conexão
$conn->close();
?>
