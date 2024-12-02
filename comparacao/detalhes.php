<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="compar.css" />
    <title>Detalhes</title>
    <style>
        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<header>
<div class="logo">
    <a href="../home/index.html">
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
        <li><a href="../comparacao/index.php" style="background-color: #2c3e50; color: white;">Comparação</a></li>
        <li><a href="../perfil/perfil.php">Perfil</a></li>
    </ul>
</nav>
 
<?php
    $produtoA = $_POST['produtoA'];
    $produtoB = $_POST['produtoB'];

    # Conecta com o BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Seleciona os produtos conforme o código fornecido
    $sql = "SELECT * FROM produto WHERE codigoProduto = :codigoProduto";
    $stm = $con->prepare($sql);

    # Busca o produto A
    $stm->bindParam(':codigoProduto', $produtoA, PDO::PARAM_INT);
    $stm->execute();
    $produtoA = $stm->fetch(PDO::FETCH_ASSOC);

    # Busca o produto B
    $stm->bindParam(':codigoProduto', $produtoB, PDO::PARAM_INT);
    $stm->execute();
    $produtoB = $stm->fetch(PDO::FETCH_ASSOC);

    # Verifica se ambos os produtos foram encontrados
    if ($produtoA && $produtoB) {
        echo "<table class='comparacao'>";
        echo "<tr>";
        echo "<th>Produto A</th>";
        echo "<th>Produto B</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo "<div class='product'>";
        echo "<img src='../produtos/imagens/" . $produtoA['fotoProduto'] . "' />";
        echo "<h3>" . $produtoA['nomeProduto'] . "</h3>";
        echo "<p>R$" . $produtoA['precoProduto'] . "</p>";
        echo "<p>" . $produtoA['descricaoProduto'] . "</p>";
        echo "</div>";
        echo "</td>";
        echo "<td>";
        echo "<div class='product'>";
        echo "<img src='../produtos/imagens/" . $produtoB['fotoProduto'] . "' />";
        echo "<h3>" . $produtoB['nomeProduto'] . "</h3>";
        echo "<p>R$" . $produtoB['precoProduto'] . "</p>";
        echo "<p>" . $produtoB['descricaoProduto'] . "</p>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "<h2>Erro: Um ou ambos os produtos não foram encontrados.</h2>";
    }
?>

<!-- Botão para voltar à página de comparação -->
<a href="../comparacao/comparar.php" class="back-button">Voltar para Comparar Produtos</a>

</body>
</html>
