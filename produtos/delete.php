<?php

    # Recebe o ID
    $cbid = $_GET['cbid'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=mercado";
    $con = new PDO($ds, 'root', 'vertrigo');

    # SQL remoção
    $sql = "DELETE FROM market WHERE cbid=?";
    $stm = $con->prepare($sql);
    $stm->execute(array($id));

    if($stm){
        header("location:index.php");
    }
    else {
        print "<p>Erro ao remover</p>";
    }
?>