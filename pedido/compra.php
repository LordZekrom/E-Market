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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        #menu-categorias {
            list-style-type: none; /* Remove os marcadores da lista */
            padding: 0; /* Remove o padding */
            display: flex; /* Usa flexbox para organizar os itens */
            justify-content: center; /* Centraliza os itens */
            margin: ;/* Margem reduzida para aproximar do menu principal */
            background-color: #ffffff; /* Fundo branco */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra para profundidade */
        }

        #menu-categorias li {
            margin: 0 10px; /* Espaçamento entre os itens */
        }

        #menu-categorias a {
            text-decoration: none; /* Remove o sublinhado */
            color: #2c3e50; /* Cor do texto */
            padding: 12px 15px; /* Espaçamento interno */
            border: 1px solid transparent; /* Borda invisível para manter o layout */
            border-radius: 5px; /* Bordas arredondadas */
            transition: background-color 0.3s, color 0.3s, border 0.3s; /* Transição suave */
            font-weight: 600; /* Fonte em negrito */
            text-align: center; /* Centraliza o texto */
            font-size: 16px; /* Tamanho da fonte */
        }

        #menu-categorias a:hover {
            background-color: #21a3b4; /* Cor de fundo ao passar o mouse */
            color: white; /* Cor do texto ao passar o mouse */
            border: 1px solid #21a3b4; /* Borda ao passar o mouse */
        }
        .product {
            border: 1px solid #ccc;
            padding: 10px;
            width: 220px;
            height: 380px;
            margin: 4px;
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            background-color: #f9f9f9;
            transition: box-shadow 0.3s;
            align-items: center;
        }

        .product:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .product img {
            max-width: 65%;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 2px;
            height: auto;
        }

        .product h3 {
            color: #333;
            margin: 10px 0;
        }

        .product h4 {
            font-size: 1.2em;
            color: #00991f;
            margin: 10px 0;
        }

        .product h5 {
            font-size: 1em;
            color: #666;
            margin: 5px 0;
        }

        .product h6 {
            color: #333;
            margin: 10px 0;
            font-size: 0.9em;
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


        .buy {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #2c3e50;
            color: white;
            cursor: pointer;
            width: 70%;
            margin-bottom: 10px;
            transition: background-color 0.3s;
            width: 138px;
        }

        .car {
            padding: 9px;
            border: none;
            border-radius: 5px;
            background-color: #2c3e50;
            color: white;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            transition: background-color 0.3s;
            width: 38px;
        }

        .buy:hover {
            background-color: #21a3b4;
        }

        .product button:hover {
            background-color: #21a3b4;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .quantity-controls button {
            width: 30px;
            height: 30px;
            border-radius: 5px;
            background-color: #e0e0e0;
            border: none;
            cursor: pointer;
        }

        .quantity-controls input {
            width: 40px;
            text-align: center;
            margin: 0 5px;

        }

        .car:hover {
            background-color: #21a3b4;;
        }

        .product button{
           display:inline-block;
           margin-right: px; /* Espaço entre os botões */
        }
        /* Flex container for products */
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .button-container {
            display: flex; /* Usa flexbox para alinhar os botões */
            justify-content: center; /* Centraliza os botões */
            gap: 4px; /* Espaço entre os botões */
           
        }
        .button-container img{
            border-radius: 0px;
            
           
        }

        .car img {
            width: 100%; /* A imagem ocupa toda a largura do botão */
         height: 100%; /* A imagem ocupa toda a altura do botão */
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
            <a href="../pedido/carrinho.php">
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
        <ul id="menu-categorias">
            <li><a href="#" data-categoria="Alimentos">Alimentos</a></li>
            <li><a href="#" data-categoria="Bebidas">Bebidas</a></li>
            <li><a href="#" data-categoria="Eletrônicos">Eletrônicos</a></li>
            <li><a href="#" data-categoria="Casa">Casa</a></li>
            <li><a href="#" data-categoria="Hiegiene">Higiene</a></li>
            <li><a href="#" data-categoria="Livros">Livros</a></li>
            <li><a href="#" data-categoria="Roupas">Roupas</a></li>
            <li><a href="#" data-categoria="Outros">Outros</a></li>
        </ul>
    </nav>
    <main>

    <div class="product-container">
    <?php

        $addcar=0;
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
           
            echo "<div class='product' data-categoria='" . $row['categoriaProduto'] . "'>
            <img src='../produtos/imagens/" . $row['fotoProduto'] . "' />
            " . $row['nomeProduto'] .  "
                <table>
                    <tr>
                        <h4>R$" . $row['precoProduto'] . "</h4>
                    </tr>
                    <br>
                    <tr>
                        " . $row['descricaoProduto'] . "
                    </tr>
                </table>
                <div class='button-container'>
                    <button onclick=\"window.location.href='addCarrinho.php?addcar=0&codigoProduto=$codigoProduto'\" class='buy'>Comprar</button>
                    <button onclick=\"window.location.href='addCarrinho.php?addcar=1&codigoProduto=$codigoProduto'\" class='car'>
                         <img src='../imagens/addcarao.png' alt='Adicionar ao Carrinho'>
                    </button>

                </div>
            </div>";
        }
    ?>
    </div>
    <br>
    <a href='../produtos/index.php'>Editar produtos</a>  
    </main>
    <script>
    document.querySelectorAll('#menu-categorias a').forEach(item => {
    item.addEventListener('click', function(event) {
        event.preventDefault();
        const categoria = this.getAttribute('data-categoria');
        const produtos = document.querySelectorAll('.product');

        produtos.forEach(produto => {
            // Exibir todos se a categoria for 'todos'
            if (categoria === 'todos' || produto.getAttribute('data-categoria') === categoria) {
                produto.style.display = 'block';
            } else {
                produto.style.display = 'none';
            }
        });
    });
    });

    </script>

</body>
</html>
