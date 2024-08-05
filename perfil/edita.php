<link rel="stylesheet" href="perfil.css">
<!-- Informações pessoais -->
    <img src="Perfil.png" class="foto_perfil">
            <!-- Deixar a foto de perfil personalizavel -->
<?php
    #Recebe o id pela URL
    $cpf = $_GET['cpfUsuario'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $db = new PDO($ds, 'root', 'vertrigo');

    # Buscar dados do registro
    $query = "SELECT * from usuario WHERE cpfUsuario='1234568911'";
    $stm = $db->prepare($query);
    $stm->bindParam(1,$cpf);

    # Executa o SQL
    $stm->execute();

    # Pega o resultado
    $result = $stm->fetch();
    $nome = $result['nomeUsuario'];
    $email = $result['emailUsuario'];
    $estado = $result['estadoUsuario'];
    $cidade = $result['cidadeUsuario'];
    $bairro = $result['bairroUsuario'];
    $endereco = $result['enderecoUsuario'];
    $numero = $result['numeroUsuario'];
    $complemento = $result['complementoUsuario'];

    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mercado</title>
</head>
<body>
    <h3>Editar Perfil</h3>
    <form method='POST' action='atualiza.php' enctype="multipart/form-data">
        <input type='hidden' value='1234568911' name='cpfUsuario'>    
        <label>Nome: </label>
        <input name='nomeUsuario' value='<?php print"$nome"; ?>'><br>
        <label>Email: </label>
        <input name='emailUsuario'><br>
        <label>Estado: </label>
        <input name='estadoUsuario'><br>
        <label>Cidade: </label>
        <input name='cidadeUsuario'><br>
        <label>Bairro: </label>
        <input name='bairroUsuario'><br>
        <label>Endereco: </label>
        <input name='enderecoUsuario'><br>
        <label>Numero: </label>
        <input name='numeroUsuario'><br>
        <label>Complemento: </label>
        <input name='complementoUsuario'><br>
        
        <button type='submit'>Salvar</button>
    </form>
</body>
</html>
