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

//################### Verificar se exite um PEDIDO com status CARRINHO, se existe, nós pegamos o ID desse pedido.

include_once "../bd/bd.php";

#Almentar no estoque
$sql = "SELECT quantidadeProduto FROM produto WHERE codigoProduto = $codigoProduto";
$stm = $con->prepare($sql);
$stm->execute();
$row = $stm->fetch();
$quantidade = $row['quantidadeProduto'];
include_once("almentarEstoque.php");

###################### Remoção dos itens do pedido
$sql = "DELETE FROM itenspedido WHERE idProduto = $codigoProduto AND idPedido = $idPedido AND idItensPedido = $idItens";
$stm = $con->prepare($sql);
$r = $stm->execute();

$url = ""
if($r){
    print "<script>alert('Carrinho finalizado!')</script>";
    $url = "Location:../pedido/carrinho.php";
}
else {
    print "<script>alert('Erro ao finalizar carrinho')</script>";
    print_r($stm->errorInfo());
    $url = "Location:../pedido/compra.php";
}
header($url)
?>