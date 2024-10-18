<?php

    # Recebe o ID
    $cpf = $_GET['cpfUsuario'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    # SQL remoção
    $sql = "DELETE FROM usuario WHERE cpfUsuario=?";
    $stm = $con->prepare($sql);
    $r = $stm->execute(array($cpf));


    if($r){
        header("location:pesquisa.php");
    }
    else {
        print "<p>Erro ao remover</p>";
        header("location:usuarios.php?msg=erro");
    }
?>