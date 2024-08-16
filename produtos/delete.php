<?php

    # Recebe o ID
    $codigoProduto = $_GET['codigoProduto'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    # SQL remoção
    $sql = "DELETE FROM produto WHERE codigoProduto=?";
    $stm = $con->prepare($sql);
    $stm->execute(array($codigoProduto));


    if($stm){
        header("location:index.php");
    }
    else {
        print "<p>Erro ao remover</p>";
    }
?>