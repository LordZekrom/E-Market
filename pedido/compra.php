<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>E-Market</title> 
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .product {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            height: 450px;
            margin: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            background-color: #f9f9f9;
            transition: box-shadow 0.3s;
        }

        .product:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .product img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .product h4 {
            font-size: 1.2em;
            color: #333;
            margin: 10px 0;
        }

        .product h5 {
            font-size: 1em;
            color: #666;
            margin: 5px 0;
        }

        .product table {
            width: 100%;
            margin-bottom: 20px;
        }

        table, th, td {
            border: none;
        }

        th {
            text-align: left;
            color: #333;
            font-weight: bold;
        }

        td {
            text-align: right;
            color: #666;
        }

        .product button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #2c3e50;
            color: white;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .product button:hover {
            background-color: #1abc9c;
        }

        /* Flex container for products */
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        @media (max-width: 768px) {
            .product {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../imagens/logo2.png" alt="Logo">
        </div>
        <div class="search-bar">
            <input type="search" placeholder="Pesquisar...">
            <button type="submit">Buscar</button>
        </div>
        <div class="cart">
            <a href=" ../pedido/carrinho.php">
                <img src="../imagens/carrinho.png" alt="Carrinho">
            </a>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../home/index.html">Home</a></li>
            <li><a href="../pedido/compra.php" style="background-color: #2c3e50; color:white;">Produtos</a></li>
            <li><a href="../comparacao/index.php">Comparação</a></li>
            <li><a href="../perfil/perfil.php">Perfil</a></li>
        </ul>
    </nav>
    <main>
    <div class="product-container">
    <?php
        # Conecta com BD
        $ds = "mysql:host=localhost;dbname=e_market";
        $con = new PDO($ds, 'root', 'vertrigo');
    
        # Seleciona todos os registros
        $sql = "SELECT * FROM produto";
        $stm = $con->prepare($sql);
        $stm->execute();
    
        # Percorre os registros
        foreach($stm as $row){
            $codigoProduto = $row['codigoProduto'];
            $linkComprar = "comprar.php?produto=" . $codigoProduto;
           
            echo "<div class='product'>
                <img src='../produtos/imagens/" . $row['fotoProduto'] . "' />
                <h4>" . $row['nomeProduto'] . "</h4>
                <table>
                    <tr>
                        <th>Preço</th>
                        <td>R$" . $row['precoProduto'] . "</td>
                    </tr>
                    <tr>
                        <th>Descrição</th>
                        <td>" . $row['descricaoProduto'] . "</td>
                    </tr>
                </table>
                <button onclick=\"window.location.href='addCarrinho.php?codigoProduto=$codigoProduto'\">Comprar</button>
                <button onclick=\"window.location.href='addCarrinho.php?codigoProduto=$codigoProduto'\">Adicionar ao carrinho</button>
            </div>";
        }
    ?>
    </div>
    <br>
    <a href='../produtos/index.php'>Editar produtos</a> 
    </main>
</body>
</html>
