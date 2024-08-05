<?php


    # Recebe os dados do formulário
    $codigoProduto = $_POST['codigoProduto'];
    $nome = $_POST['nomeProduto'];
    $descricao = $_POST['descricaoProduto'];
    $preco = $_POST['precoProduto'];
    $quantidade = $_POST['quantidadeProduto'];
    $categoria = $_POST['categoriaProduto'];
   
    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    # SQL para update
    $sql = "UPDATE produto SET nomeProduto=?, descricaoProduto=?, precoProduto=?, quantidadeProduto=?, categoriaProduto=? WHERE codigoProduto=?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $nome);
    $stm->bindParam(2, $descricao);
    $stm->bindParam(3, $preco);
    $stm->bindParam(4, $quantidade);
    $stm->bindParam(5, $categoria);
    $stm->bindParam(6, $codigoProduto);


    #Executa SQL
    if($stm->execute()){
        header('location:index.php');
    }
    else{
        print "<p>Erro ao atualizar</p>";
    }
    
?>