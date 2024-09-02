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

###################### Remoção dos itens do pedido
    dar um select, ser for maior que 2, ele diminui em um. Caso for 1, ele apaga o produto do carrinho(da pra chamar o delete, eu acho)

    $sql = "UPDATE itenspedido SET quantidadeItensPedido = ? WHERE idPedido = ? AND idProduto = ?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $quantidade);
    $stm->bindParam(2, $idPedido); 
    $stm->bindParam(3, $codigoProduto);
    $r = $stm->execute();
    $boolCtl1 = 1;
    break;

if($r){
    print "<script>alert('Quantidade Diminuida!')</script>";
    header("Location:../pedido/carrinho.php");
}
else {
    print "<script>alert('Erro ao diminuir a quantiade')</script>";
    print_r($stm->errorInfo());
    header("Location:../pedido/compra.php");
}
?>