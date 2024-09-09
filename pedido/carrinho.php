<?php
//Inclui o arquivo de verifica��o de sess�o.
    include_once("../perfil/verifica.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de compras da E-Market</title>
    <link rel="stylesheet" type="text/css" href="carro.css" />
    </head>
    <style>
        .product{
            max-width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            margin-left: auto;
        }
        .center {
        text-align: center; /* Centraliza horizontalmente */
         }
    </style>
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
            <a href=" ../pedido/carrinho.php">
            <img src="../imagens/carrinho.png" alt="Carrinho">
             </a>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../home/index.html">Home</a></li>
            <li><a href="../pedido/compra.php">Produtos</a></li>
            <li><a href="../comparacao/index.php">Comparação</a></li>
            <li><a href="../perfil/perfil.php"  >Perfil</a></li> 
        </ul>
    </nav>
    <h3>Pedido</h3>
    <table border>
        
        <?php

// Conecta com BD
$ds = 'mysql:host=localhost;dbname=e_market';
$con = new PDO($ds, 'root', 'vertrigo');

#Recebe o id pela URL
$cpf = $_SESSION['cpf'];

// Seleciona todos os registros
$sql = "SELECT idPedido FROM pedido WHERE statusPedido = 'carrinho' AND cpfUsuario = :cpfUsuario";
$stm = $con->prepare($sql);
$stm->bindParam(':cpfUsuario', $cpf);
$stm->execute();
$row = $stm->fetch();
$idPedido = $row['idPedido'];
$sql = "SELECT * FROM itenspedido ip JOIN pedido p ON ip.idPedido = p.idPedido AND p.cpfUsuario = :cpfUsuario JOIN produto pr ON pr.codigoProduto = ip.idProduto WHERE p.idPedido = :idPedido";
$stm = $con->prepare($sql);
$stm->bindParam(':cpfUsuario', $cpf);
$stm->bindParam(':idPedido', $idPedido);
$stm->execute();
$resultado = $stm->fetch(PDO::FETCH_ASSOC);

if(empty($resultado)){
    print"<p>Não existe nenhum produto no carrinho. Adicione algum!</p>";
    print"<button onclick=\"window.location.href='compra.php'\">Produtos</button>";
}
else{
    print"
        <tr>
            <th>Foto do Produto</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Ações</th>
        </tr>";
    // Seleciona todos os registros
    $sql = "SELECT idPedido FROM pedido WHERE statusPedido = 'carrinho' AND cpfUsuario = :cpfUsuario";
    $stm = $con->prepare($sql);
    $stm->bindParam(':cpfUsuario', $cpf);
    $stm->execute();
    $row = $stm->fetch();
    $idPedido = $row['idPedido'];
    $sql = "SELECT * FROM itenspedido ip JOIN pedido p ON ip.idPedido = p.idPedido AND p.cpfUsuario = :cpfUsuario JOIN produto pr ON pr.codigoProduto = ip.idProduto WHERE p.idPedido = :idPedido";
    $stm = $con->prepare($sql);
    $stm->bindParam(':cpfUsuario', $cpf);
    $stm->bindParam(':idPedido', $idPedido);
    $stm->execute();

    // Percorre os registros
    $precoTotal = 0;
    foreach($stm as $row){
        $id = $row['idProduto'];
        $nome = $row['nomeProduto'];
        $quantidade = $row['quantidadeItensPedido'];
        $preco = $row['precoProduto'];
        $precoTotal += $preco * $quantidade;
        $idPedido = $row['idPedido'];
        $idItens = $row['idItensPedido'];
        $fotoProduto = $row['fotoProduto'];
//<img src="imagens/<?php echo htmlspecialchars($fotoPerfil); " class="foto_perfil" alt="Foto de Perfil">
        echo "<tr>";
        echo "<td align='center'>" . "<img src='../produtos/imagens/$fotoProduto' class='product'/>" . "</td>";
        echo "<td>" . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($quantidade, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($preco, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td align='center'>
        <a href='maisProduto.php?codigoProduto=" . urlencode($id) . "&idPedido=" . urlencode($idPedido) . "&idItensPedido=" . urlencode($idItens) . "'><img src='imgs/mais.png' alt='Adicionar produto' class='imgCart'></a>
        <a href='menosProduto.php?codigoProduto=" . urlencode($id) . "&idPedido=" . urlencode($idPedido) . "&idItensPedido=" . urlencode($idItens) . "'><img src='imgs/menos.png' alt='Diminuir produto' class='imgCart'></a>
        <a href='delete.php?codigoProduto=" . urlencode($id) . "&idPedido=" . urlencode($idPedido) . "&idItensPedido=" . urlencode($idItens) . "'><img src='imgs/lixeria.png' alt='Remover produto' class='imgCart'></a>
            </td>";
        echo "</tr>";
    }
        print"<tr>
                <th>Preço Total</th>
                <th>Ações</th>
            </tr>";
        echo "<tr>";
        echo "<td>" . htmlspecialchars($precoTotal, ENT_QUOTES, 'UTF-8') . " Reais</td>";
        echo "<td>
                <a href='.php?idPedido=" . urlencode($id) . "'>Fechar Pedido</a>
            </td>";
        echo "</tr>";

    }
?>
</table>
</body>
</html>

