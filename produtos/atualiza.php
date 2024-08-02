<?php
    #Recebendo os dados
    $codigoProduto = $_POST['codigoProduto'];
    $nome = $_POST['nomeProduto'];
    $descricao = $_POST['descricaoProduto'];
    $preco = $_POST['precoProduto'];
    $quantidade = $_POST['quantidadeProduto'];
    $categoria = $_POST['categoriaProduto'];
   
    # Conecta com BD
    $ds = "mysql:host=localhost;e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    # SQL para update
    $sql = "UPDATE produto SET codigoProduto=?, nomeProduto=?, descricaoProduto=?, precoProduto=?, quantidadeProduto=?, categoriaProduto WHERE codigoProduto=?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $codigoProduto);
    $stm->bindParam(2, $nome);
    $stm->bindParam(3, $descricao);
    $stm->bindParam(4, $preco);
    $stm->bindParam(5, $quantidade);
    $stm->bindParam(6, $categoria);


    #Executa SQL
    if($stm->execute()){
        header('location:index.php');
    }
    else{
        print "<p>Erro ao atualizar</p>";
    }
?>