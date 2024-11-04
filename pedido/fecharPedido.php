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

    include_once "../bd/bd.php";

    $sql = "UPDATE pedido SET statusPedido = 'finalizado' WHERE idPedido = ? AND cpfUsuario = ?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $idPedido);
    $stm->bindParam(2, $cpf); 
    $stm->execute();

    $sql = "INSERT INTO pedido (cpfUsuario, statusPedido) VALUES(?, 1)";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $cpf); 
    $r = $stm->execute();

// Busca os dados do usuário
$query = "SELECT * FROM usuario WHERE cpfUsuario = :cpf";
$stm = $db->prepare($query);
$stm->bindParam(':cpf', $cpf);

if ($stm->execute()) {
    $user = $stm->fetch(PDO::FETCH_ASSOC);

    $estado = $user['estadoUsuario'];
    $cidade = $user['cidadeUsuario'];
    $bairro = $user['bairroUsuario'];
    $endereco = $user['enderecoUsuario'];
    $numero = $user['numeroUsuario'];
    $complemento = $user['complementoUsuario'];
} 


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