<?php
//Inclui o arquivo de verifica��o de sess�o.
    include_once("../perfil/verifica.php");
?>
<?php
#Recebe o id pela URL
$cpf = $_SESSION['cpf'];
$codigoProduto = $_GET['codigoProduto'];
$idPedido = $_GET['idPedido'];
$idItens = $_GET['idItensPedido'];

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


###################### Remoção dos itens do pedido
$sql = "DELETE FROM itenspedido WHERE idProduto = $codigoProduto AND idPedido = $idPedido AND idItensPedido = $idItens";
$stm = $con->prepare($sql);
$r = $stm->execute();

if($r){
    print "<script>alert('Item Removido!')</script>";
    header("Location:../pedido/carrinho.php");
}
else {
    print "<script>alert('Erro ao remover o produto')</script>";
    print_r($stm->errorInfo());
    header("Location:../pedido/compra.php");
}
?>