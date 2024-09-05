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
            <th>ID do Produto(Foto, depois)</th>
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

        echo "<tr>";
        echo "<td>" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($quantidade, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($preco, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>
        <a href='maisProduto.php?codigoProduto=" . urlencode($id) . "&idPedido=" . urlencode($idPedido) . "&idItensPedido=" . urlencode($idItens) . "'>Adicionar</a>
        <a href='menosProduto.php?codigoProduto=" . urlencode($id) . "&idPedido=" . urlencode($idPedido) . "&idItensPedido=" . urlencode($idItens) . "'>Diminuir</a>
        <a href='delete.php?codigoProduto=" . urlencode($id) . "&idPedido=" . urlencode($idPedido) . "&idItensPedido=" . urlencode($idItens) . "'>Remover</a>
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

