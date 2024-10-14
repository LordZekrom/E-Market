<?php
    #Recebe o id pela URL
    $cpf = $_GET['cpfUsuario'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Buscar dados do registro
    $sql = "SELECT * from usuario WHERE cpfusuario=?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1,$cpf);

    # Executa o SQL
    $stm->execute();

    # Pega o resultado
    $result = $stm->fetch();
    $cpf = $result['cpfUsuario'];
    $nome = $result['nomeUsuario'];
    $email = $result['emailUsuario'];
    $estado = $result['estadoUsuario'];
    $cidade = $result['cidadeUsuario'];
    $bairro = $result['bairroUsuario '];
    $endereco = $result['enderecoUsuario'];
    $numero = $result['numeroUsuario'];
    $complemento = $result['complementoUsuario'];
    $senha = $result['senhaUsuario'];
    $foto = $result['fotoPerfil'];
    $tipo = $result['tipoUsuario'];

    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta charset="UTF-8">
    <title>Edição</title>
</head>
<body>
    <h3>Editar Produto</h3>
    <form method='POST' action='atualiza.php' enctype="multipart/form-data">
        <input name='codigoProduto' type="hidden"  value='<?php print $codigoProduto ?>'><br> 
        <label>Nome: </label>
        <input name='nomeProduto' value='<?php print $nome ?>'><br>
        <label>Descrição: </label>
        <input name='descricaoProduto' value='<?php print $descricao ?>'><br>
        <label>Preço </label>
        <input name='precoProduto' value='<?php print $preco ?>'><br>
        <label>Quantidade </label>
        <input name='quantidadeProduto' value='<?php print $quantidade ?>'><br>
        <label>Categoria </label>
        <select name='categoriaProduto' value='<?php print $categoria ?>'>
            <option value='1'>Cliente</option>
            <option value='2'>Adm</option>
        </select>    
        <br>        
   Selecione uma imagem: <input name="arquivo" type="file"   />
   <br/>
        <button type='submit'>Salvar</button>
    </form>
</body>
</html>