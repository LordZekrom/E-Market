<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="compar.css" />
    <title>Comparar Produto</title>
    <style>
        /* Estilo para o modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }

        .modal-content button {
            margin-top: 10px;
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



<div class="center">
    <div class="esquerdo">
        <div class="pesquisa1">
            <form method="post">
                <label>Produto:</label>
                <input type="text" name="nomeProduto" />
                <button type="submit">Pesquisar</button>
            </form>
        </div>
        <?php include("esquerda.php")?>
    </div>
 
    <div class="compare-button">
        <form action="detalhes.php" method="post">
            <input type="hidden" name="produtoA" id="produtoA" value="">
            <input type="hidden" name="produtoB" id="produtoB" value="">
            <button type="submit">Comparar Produtos</button>
        </form>
    </div>

    <div class="direita">
        <div class="pesquisa2">
        <form method="post">
                <label>Produto:</label>
                <input type="text" name="nomeProduto2" />
                <button type="submit">Pesquisar</button>
            </form>
          </div>
          <?php include("direita.php")?>
    </div>

</div>

<script>    

    // Função para abrir o modal e selecionar o produto
    function selecionar(campoProduto, codigoProduto) {
        if (campoProduto == "produtoA"){
            document.getElementById('produtoA').value = codigoProduto;
            let div_list = document.querySelectorAll(".listA");
            let div_array = [...div_list]; // converts NodeList to Array
            div_array.forEach(el => {
                el.style.backgroundColor = "#f9f9f9";           
            });
            document.querySelector("#listA" + codigoProduto).style.backgroundColor = "lightgreen";
        }
        else {
            document.getElementById('produtoB').value = codigoProduto;
            let div_list = document.querySelectorAll(".listB");
            let div_array = [...div_list]; // converts NodeList to Array
            div_array.forEach(el => {
                el.style.backgroundColor = "#f9f9f9";           
            });
            document.querySelector("#listB" + codigoProduto).style.backgroundColor = "lightgreen";
        }
               
    }

  

    // Função para realizar a comparação
    function comparar(tipo) {
        alert('Comparando por ' + tipo); // Ação para a comparação
       
    }
</script>

<button onclick="window.location.href='http://localhost/inf22/E-Market/comparacao/index.php'">Voltar para Comparação</button>

</body>
</html>
