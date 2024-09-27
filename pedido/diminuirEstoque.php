<?php
$quantidade = $quantidade - 1;
$sql = "UPDATE produto SET quantidadeProduto = $quantidade WHERE codigoProduto = $codigoProduto";
$stm = $con->prepare($sql);
$stm->execute();

?>