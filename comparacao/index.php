<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Comparação de Produtos</title>
</head>
<body>
<header>
    <div class="logo">
        <a href="../home/index.html">
            <img src="../imagens/logo2.png.png" alt="Logo">
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
        <li><a href="../home/index.html" >Home</a></li>
        <li><a href="../pedido/compra.php">Produtos</a></li>
        <li><a href="../comparacao/index.php" style="background-color: #2c3e50; color: white;">Comparação</a></li>
        <li><a href="../perfil/perfil.php">Perfil</a></li>
    </ul>
</nav>
<main>
<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "vertrigo";
$database = "e_market";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Função para gerar a tabela de produto
function gerarTabelaProduto($conn, $categoria, $inputNamePrefix) {
    $sql = "SELECT codigoProduto, nomeProduto, precoProduto, fotoProduto FROM produto WHERE categoriaProduto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $categoria);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Produto</th><th>Preço</th><th>Selecionar</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["nomeProduto"]) . "</td>";
            echo "<td>R$ " . number_format($row["precoProduto"], 2, ',', '.') . "</td>";
            echo "<td><img src='../produtos/imagens/" . $row['fotoProduto'] . "' width='60px'/></td>";

            echo "<td><input type='radio' name='" . $inputNamePrefix . "' value='" . $row["codigoProduto"] . "'></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum produto encontrado.";
    }

    $stmt->close();
}
?>

<div class="container">
    <form method="get" action="">
        <label for="categoria1">Selecione a categoria para o Produto 1:</label>
        <select name="categoria1" id="categoria1" onchange="this.form.submit()">
            <option value="">Escolha uma categoria</option>
            <option value="Eletrônicos" <?php echo isset($_GET['categoria1']) && $_GET['categoria1'] === 'Eletrônicos' ? 'selected' : ''; ?>>Eletrônicos</option>
            <option value="Roupas" <?php echo isset($_GET['categoria1']) && $_GET['categoria1'] === 'Roupas' ? 'selected' : ''; ?>>Roupas</option>
            <option value="Alimentos" <?php echo isset($_GET['categoria1']) && $_GET['categoria1'] === 'Alimentos' ? 'selected' : ''; ?>>Alimentos</option>
            <option value="Livros" <?php echo isset($_GET['categoria1']) && $_GET['categoria1'] === 'Livros' ? 'selected' : ''; ?>>Livros</option>
            <option value="Higiene" <?php echo isset($_GET['categoria1']) && $_GET['categoria1'] === 'Higiene' ? 'selected' : ''; ?>>Higiene</option>
            <option value="Bebidas" <?php echo isset($_GET['categoria1']) && $_GET['categoria1'] === 'Bebidas' ? 'selected' : ''; ?>>Bebidas</option>
            <option value="Casa" <?php echo isset($_GET['categoria1']) && $_GET['categoria1'] === 'Casa' ? 'selected' : ''; ?>>Casa</option>
            <option value="Outros" <?php echo isset($_GET['categoria1']) && $_GET['categoria1'] === 'Outros' ? 'selected' : ''; ?>>Outros</option>
        </select>
        <br><br>
        <label for="categoria2">Selecione a categoria para o Produto 2:</label>
        <select name="categoria2" id="categoria2" onchange="this.form.submit()">
            <option value="">Escolha uma categoria</option>
            <option value="Eletrônicos" <?php echo isset($_GET['categoria2']) && $_GET['categoria2'] === 'Eletrônicos' ? 'selected' : ''; ?>>Eletrônicos</option>
            <option value="Roupas" <?php echo isset($_GET['categoria2']) && $_GET['categoria2'] === 'Roupas' ? 'selected' : ''; ?>>Roupas</option>
            <option value="Alimentos" <?php echo isset($_GET['categoria2']) && $_GET['categoria2'] === 'Alimentos' ? 'selected' : ''; ?>>Alimentos</option>
            <option value="Livros" <?php echo isset($_GET['categoria2']) && $_GET['categoria2'] === 'Livros' ? 'selected' : ''; ?>>Livros</option>
            <option value="Higiene" <?php echo isset($_GET['categoria2']) && $_GET['categoria2'] === 'Higiene' ? 'selected' : ''; ?>>Higiene</option>
            <option value="Bebidas" <?php echo isset($_GET['categoria2']) && $_GET['categoria2'] === 'Bebidas' ? 'selected' : ''; ?>>Bebidas</option>
            <option value="Casa" <?php echo isset($_GET['categoria2']) && $_GET['categoria2'] === 'Casa' ? 'selected' : ''; ?>>Casa</option>
            <option value="Outros" <?php echo isset($_GET['categoria2']) && $_GET['categoria2'] === 'Outros' ? 'selected' : ''; ?>>Outros</option>
        </select>
    </form>
    
    <div class="table-container">
        <h3>Produtos da Categoria 1</h3>
        <?php 
        if (isset($_GET['categoria1']) && !empty($_GET['categoria1'])) {
            gerarTabelaProduto($conn, $_GET['categoria1'], 'produto1'); 
        }
        ?>
    </div>

    <div class="table-container">
        <h3>Produtos da Categoria 2</h3>
        <?php 
        if (isset($_GET['categoria2']) && !empty($_GET['categoria2'])) {
            gerarTabelaProduto($conn, $_GET['categoria2'], 'produto2'); 
        }
        ?>
    </div>
</div>

<div class="compare-button">
    <form action="comparar.php" method="post">
        <input type="hidden" name="produto1" id="produto1" value="">
        <input type="hidden" name="produto2" id="produto2" value="">
        <button type="submit">Comparar Produtos</button>
    </form>
</div>
</main>
<script>
    document.querySelectorAll('input[name="produto1"]').forEach(input => {
        input.addEventListener('change', () => {
            document.getElementById('produto1').value = input.value;
        });
    });

    document.querySelectorAll('input[name="produto2"]').forEach(input => {
        input.addEventListener('change', () => {
            document.getElementById('produto2').value = input.value;
        });
    });
</script>

<?php $conn->close(); ?>

</body>
</html>
