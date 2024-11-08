<?php
//Inclui o arquivo de verifica��o de sess�o.
    include_once("../perfil/verifica.php");
?>
<?php
//Muda o id do carrinho para finalizado e cria um novo com status carriho
#Recebe o id pela URL
    $cpf = $_SESSION['cpf'];
    $idPedido = $_GET['idPedido'];
    $precoTotal = $_GET['preco'];
    $data = date('Y-m-d');
    $hora = date('H:i:s');

    include_once "../bd/bd.php";

    $sql = "UPDATE pedido SET statusPedido = 'finalizado' WHERE idPedido = ? AND cpfUsuario = ?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $idPedido);
    $stm->bindParam(2, $cpf); 
    $stm->execute();

// Incerção do pedido finalizado
    $sql = "UPDATE pedido SET dataPedido = ?, horaPedido = ?, precoFinal = ? WHERE idPedido = ? AND cpfUsuario = ?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $data); 
    $stm->bindParam(2, $hora); 
    $stm->bindParam(3, $precoTotal); 
    $stm->bindParam(4, $idPedido); 
    $stm->bindParam(5, $cpf); 
    $r = $stm->execute();


$url = "";
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