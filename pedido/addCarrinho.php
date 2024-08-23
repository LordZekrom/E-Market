<?php
#Recebe o id pela URL
$cpf = $_SESSION['cpf'];
$codigoProduto = $_GET['codigoProduto'];

################### Verificar se exite um PEDIDO com status CARRINHO, se existe, nós pegamos o ID desse pedido.

include_once "../bd/bd.php";
    
$sql = "SELECT * FROM pedido WHERE cpfUsuario = ? AND statusPedido = 'carrinho' ";
$stm = $con->prepare($sql);
$stm->bindParam(1, $cpf);
$stm->execute();

$idPedido = 0;
if($row = $stm->fetch()){
    $idPedido = $row['idPedido'];   
}
else {
    ################### Verificar se exite um PEDIDO com status CARRINHO, se existe, nós pegamos o ID desse pedido.
    $sql = "INSERT INTO pedido (cpfUsuario, statusPedido) VALUES(?, 1)";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $cpf); 
    $r = $stm->execute();
    
    if($r){
        $idPedido = $con->lastInsertId();              
    }
    else {
        print "<p>Erro ao inserir</p>";
        print_r($stm->errorInfo());
    }
}

###################### Inserção dos itens do pedido
$sql = "INSERT INTO itenspedido (idPedido, idProduto) VALUES(?, ?)";
$stm = $con->prepare($sql);
$stm->bindParam(1, $idPedido); 
$stm->bindParam(2, $codigoProduto);
$r = $stm->execute();

if($r){
    print "<p>Item inserido.</p>";          
}
else {
    print "<p>Erro ao inserir</p>";
    print_r($stm->errorInfo());
}
?>