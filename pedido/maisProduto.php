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

###################### Agregação dos itens do pedido

    //Select na quantidade original
        $sql = "SELECT * FROM itenspedido WHERE idPedido = ? AND idProduto = ?";
        $stm = $con->prepare($sql);
        $stm->bindParam(1, $idPedido); 
        $stm->bindParam(2, $codigoProduto);
        $stm->execute();
        $row = $stm->fetch();
        $quantidade = $row['quantidadeItensPedido'];
        $quantidade = $quantidade + 1;

    $sql = "UPDATE itenspedido SET quantidadeItensPedido = ? WHERE idPedido = ? AND idProduto = ?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $quantidade);
    $stm->bindParam(2, $idPedido); 
    $stm->bindParam(3, $codigoProduto);
?>