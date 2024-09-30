<?php
//Inclui o arquivo de verifica��o de sess�o.
    include_once("../perfil/verifica.php");
?>
<?php
// Conecta com BD
$ds = 'mysql:host=localhost;dbname=e_market';
$con = new PDO($ds, 'root', 'vertrigo');

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
    //$sql = "SELECT quantidadeItensPedido FROM itensPedido WHERE idProduto = $codigoProduto AND ";//ARRUMANDO A QUESTÃO DE SE DELETAR TODA A QUANTIDADE, DE DEVOLVER ELA AO ESTOQUE
    include_once("almentarEstoque.php");

###################### Remoção dos itens do pedido
    //dar um select, ser for maior que 2, ele diminui em um. Caso for 1, ele apaga o produto do carrinho(da pra chamar o delete, eu acho)

    //Select na quantidade original
        $sql = "SELECT * FROM itenspedido WHERE idPedido = ? AND idProduto = ?";
        $stm = $con->prepare($sql);
        $stm->bindParam(1, $idPedido); 
        $stm->bindParam(2, $codigoProduto);
        $stm->execute();
        $row = $stm->fetch();
        $quantidade = $row['quantidadeItensPedido'];
        //Se for 1, remove tudo, mais que 2 remove um por um.
            if($quantidade > 1){
                $quantidade = $quantidade - 1;
            } else{
                header("Location:../pedido/delete.php?codigoProduto=" . urlencode($codigoProduto) . "&idPedido=" . urlencode($idPedido) . "&idItensPedido=" . urlencode($idItens));
                exit();
            }

    $sql = "UPDATE itenspedido SET quantidadeItensPedido = ? WHERE idPedido = ? AND idProduto = ?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $quantidade);
    $stm->bindParam(2, $idPedido); 
    $stm->bindParam(3, $codigoProduto);
    $r = $stm->execute();

    $url = "";
if($r){
    $url = "Location:../pedido/carrinho.php";
}
else {
    print "<script>alert('Erro ao diminuir a quantiade')</script>";
    print_r($stm->errorInfo());
    $url = "Location:../pedido/compra.php";
}
header($url);
?>