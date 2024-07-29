<?php
    #Recebe o id pela URL
    $codigoProduto = $_GET['codigoProduto'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Buscar dados do registro
    $sql = "SELECT * from produto WHERE codigoProduto=?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1,$codigoProduto);

    # Executa o SQL
    $stm->execute();

    # Pega o resultado
    $result = $stm->fetch();
    $codigoProduto = $result['codigoProduto'];
    $nome = $result['nomeProduto'];
    $descricao = $result['descricaoProduto'];
    $preco = $result['precoProduto'];
    $quantidade = $result['quantidadeProduto'];
    $categoria = $result['categoriaProduto'];

    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mercado</title>
</head>
<body>
    <h3>Editar Produto</h3>
    <form method='POST' action='atualiza.php' enctype="multipart/form-data">
        <label>Código: </label>
        <input name='codigoProduto'><br>
        <label>Nome: </label>
        <input name='nomeProduto'><br>
        <label>Descrição: </label>
        <input name='descricaoProduto'><br>
        <label>Preço </label>
        <input name='precoProduto'><br>
        <label>Quantidade </label>
        <input name='quantidadeProduto'><br>
        <label>Categoria </label>
        <select name='categoriaProduto'>
            <option value='1'>Eletrônicos</option>
            <option value='2'>Roupas</option>
            <option value='3'>Alimentos</option>
            <option value='4'>Livros</option>
            <option value='5'>Higiene</option>
            <option value='6'>Bebidas</option>
            <option value='7'>Casa</option>
            <option value='8'>Outros</option>
        </select>    
        <br>        
   Selecione uma imagem: <input name="arquivo" type="file" />
   <br/>
        <button type='submit'>Salvar</button>
    </form>
</body>
</html>