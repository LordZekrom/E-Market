<?php
//Inclui o arquivo de verifica��o de sess�o.
    include_once("../perfil/verifica.php");
?>
<?php
/*
    #Recebe o id pela URL
    $cpf = $_SESSION['cpf'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');



   if (isset($_GET['IdProduto']) /*&& isset($_GET['cpfUsuario'])/) {

    ###### Verificar se já existe um pedido com status CARRINHO, se existir pega o ID    
    $sql = "SELECT * FROM pedido WHERE cpfUsuario = ? AND statusPedido = 'carrinho'";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $cpf);
    $stm->execute();


    $idPedido = 0;


    if($row = $stm->fetch()){
        $idPedido = $row['idPedido'];  
           
    }
    else {
        ####### Caso não existe pedido com status CARRINHO, para este CPF, criamos um pedido com STATUS CARRINHO
        $sql = 'INSERT INTO pedido (cpfUsuario, statusPedido) VALUES(?,1)';
        $stm = $con->prepare($sql);
        $r = $stm->execute(array($cpf));


        #Vereficar inserção
        if($r){
            $idPedido = $con->lastInsertId();
        }
        else{
            print"<p>ERRO AO INSERIR<p>";
            print_r($stm->errorInfo());
        }


    }
    print "<p>ID pedido: $idPedido</p>";  
    print "<p>ID produto: $codigoProduto</p>";  

    ####### Primeiro, verificar se o item já está no carrinho
    $sqlCheck = 'SELECT * FROM itenspedido WHERE idItensPedido = :idPedido AND codigoProduto = :codigoProduto';
    $stmCheck = $con->prepare($sqlCheck);
    $stmCheck->execute([':idPedido' => $idPedido, ':codigoProduto' => $codigoProduto]);
   
    if($row = $stmCheck->fetch()){
        $idItensPedido = $row['idItensPedido'];      
        $quantidadeItensPedido =  $row['quantidadeItensPedido'] + 1;


        ########## Se item existe no carrinho (itempedido), eu atualizo a quantidade
        $sql = "UPDATE itenspedido SET quantidadeItensPedido=? WHERE idItensPedido=?";
        $stm = $con->prepare($sql);
        $stm->bindParam(1, $quantidadeItensPedido);
        $stm->bindParam(2, $idItensPedido);


        print "<p>ID itenspedido: $idItensPedido | Item existe no carrinho.</p>";


        # Executa SQL
        if ($stm->execute()){
            print "<p>OK OK</p>";
        }
        else{
            print "<p>Erro ao atualizar</p>";
        }
    }
    else{
        ############ Caso item não exista em itempedido, faço inserção
        $sql = 'INSERT INTO itenspedido (idPedido, codigoProduto, quantidadeItensPedido) VALUES(?,?,1)';
        $stm = $con->prepare($sql);
        $stm->bindParam(1, $idPedido);
        $stm->bindParam(2, $codigoProduto);
        


        #Vereficar inserção
        $r = $stm->execute();
        if($r){
            print "<p>Inseriu item no carrinho</p>";
            print "<p>Item inserido carrinho.</p>";
        }
        else{
            print"<p>ERRO AO INSERIR<p>";
            print_r($stm->errorInfo());
        }
    }
}*/
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
            <li><a href="../comparacao/index.html">Comparação</a></li>
            <li><a href="../perfil/perfil.php"  >Perfil</a></li> 
        </ul>
    </nav>
    <h3>Pedido</h3>
    <table border>
        <tr>
            <th>ID do Produto(Foto, depois)</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Ações</th>
        </tr>
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

// Percorre os registros
foreach($stm as $row){
    $id = $row['idProduto'];
    $nome = $row['nomeProduto'];
    $quantidade = $row['quantidadeItensPedido'];
    $preco = $row['precoProduto'];

    echo "<tr>";
    echo "<td>" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($quantidade, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($preco, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>
            <a href='delete.php?idPedido=" . urlencode($id) . "'>Deletar</a>
        </td>";
    echo "</tr>";
}
    print"<tr>
            <th>Preço Total</th>
            <th>Ações</th>
        </tr>";
        
?>
</table>
</body>
</html>

