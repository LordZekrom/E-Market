<?php
//Inclui o arquivo de verifica��o de sess�o.
    include_once("../perfil/verifica.php");
?>
<?php
#Recebe o id pela URL
$cpf = $_SESSION['cpf'];
$codigoProduto = $_GET['codigoProduto'];

################### Verificar se exite um PEDIDO com status CARRINHO, se existe, nós pegamos o ID desse pedido.

include_once "../bd/bd.php";

#Conferir estoque do produto
    $sql = "SELECT quantidadeProduto FROM produto WHERE codigoProduto = $codigoProduto";
    $stm = $con->prepare($sql);
    $stm->execute();
    $row = $stm->fetch();
    $quantidade = $row['quantidadeProduto'];
    if($quantidade <= 0){    
        echo "<script>
            alert('Item fora de estoque');
            window.location.href='../pedido/compra.php';
            </script>";
        exit();
    }
    include_once("diminuirEstoque.php");
    

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

###################### Procurar se já tem um item desse no carrinho
$sql = "SELECT * FROM itenspedido";
$stm = $con->prepare($sql);
$stm->execute();

$boolCtl1 = 0;
foreach($stm as $row){
    $idPedido2 = $row['idPedido'];
    $codigoProduto2 = $row['idProduto'];
    if($idPedido == $idPedido2 && $codigoProduto == $codigoProduto2){
        ###################### Inserção dos itens do pedido
        $quantidade = $row['quantidadeItensPedido'];
        $quantidade += 1;

        $sql = "UPDATE itenspedido SET quantidadeItensPedido = ? WHERE idPedido = ? AND idProduto = ?";
        $stm = $con->prepare($sql);
        $stm->bindParam(1, $quantidade);
        $stm->bindParam(2, $idPedido); 
        $stm->bindParam(3, $codigoProduto);
        $r = $stm->execute();
        $boolCtl1 = 1;
        break;
    } 
}
if($boolCtl1 == 0){
    ###################### Inserção dos itens do pedido
    $sql = "INSERT INTO itenspedido (idPedido, idProduto, quantidadeItensPedido) VALUES(?, ?, 1)";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $idPedido); 
    $stm->bindParam(2, $codigoProduto);
    $r = $stm->execute();
}

$url = "";
if($r){
    print "<script>alert('Item inserido!')</script>";
    $url = "Location:../pedido/carrinho.php";
}
else {
    print "<script>alert('Erro ao inserir o produto')</script>";
    print_r($stm->errorInfo());
    $url = "Location:../pedido/compra.php";
}
header($url);
?>