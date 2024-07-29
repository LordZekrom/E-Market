<?php
    #Recebendo os dados
    $cbid = $_POST['cbid'];
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $validade = $_POST['validade'];
   
    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=mercado";
    $con = new PDO($ds, 'root', 'vertrigo');

    # SQL para update
    $sql = "UPDATE market SET cbid=?, nome=?, valor=?, validade=? WHERE cbid=?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $cbid);
    $stm->bindParam(2, $nome);
    $stm->bindParam(3, $valor);
    $stm->bindParam(4, $validade);
    $stm->bindParam(5, $cbid);

    #Executa SQL
    if($stm->execute()){
        header('location:index.php');
    }
    else{
        print "<p>Erro ao atualizar</p>";
    }
?>