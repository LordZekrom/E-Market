<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="compar.css" />
    <title>Comparação de Produtos</title>
    <style>
      .bota {
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #2c3e50;
    color: white;
    cursor: pointer;
    width: 100%;  /* O botão ocupa toda a largura do contêiner */
    margin: 0 auto;  /* Centraliza o botão horizontalmente */
    margin-bottom: 10px;
    transition: background-color 0.3s;
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


</div>
    </form>
    </div>
    <div class="certo">
    <div class="teste">              
                <div class="teste2">
                <h2>Comparar</h2>
                <p>Veja as melhores comparações</p>
                    <p>Encontre grandes comparações em diversos produtos.</p>
                    <button class="bota" onclick="window.location.href='comparar.php';">Comparar</button>
                </div>
</div>
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
