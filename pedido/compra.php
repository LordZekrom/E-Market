<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <title>E-Market</title>        
</head>
<body>
    <header>
        <div class="logo">
             <img src="../mercado.png" alt="Logo">
        </div>
        <div class="search-bar">
            <input type="search" placeholder="Pesquisar...">
            <button type="submit">Buscar</button>
        </div>
        <div class="cart">
            <img src="carrinho.png" alt="Logoc">
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Produtos</a></li>
            <li><a href="#">Comparação</a></li>
            <li><a href="#">Perfil</a></li> 
        </ul>
    </nav>
    <main>
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
           
            echo "<div class='product'><img src='../produtos/imagens/" . $row['fotoProduto'] . "' width='60px'/><br>
            <h4>" . $row['nomeProduto'] . "</h4>
            <h5>" . $row['precoProduto'] . "</h5>
            <button onclick=\"window.location.href='addCarrinho.php?codigoProduto=$codigoProduto'\">Comprar</button></div>";
        }
    ?>
    
    </main>
</body>
</html>
