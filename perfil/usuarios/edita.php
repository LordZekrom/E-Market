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
    $nome = $result['nomeUsuario'];
    $email = $result['emailUsuario'];
    $estado = $result['estadoUsuario'];
    $cidade = $result['cidadeUsuario'];
    $bairro = $result['bairroUsuario'];
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
    <h3>Editar Usuario</h3>
    <form method='POST' action='atualiza.php' enctype="multipart/form-data">
        <input name='cpfAntigo' type="hidden"  value='<?php print $cpf ?>'><br> 
        <label>Cpf: </label>
        <input name='cpfUsuario' value='<?php print $cpf ?>'><br>
        <label>Nome: </label>
        <input name='nomeUsuario' value='<?php print $nome ?>'><br>
        <label>Email: </label>
        <input name='emailUsuario' value='<?php print $email ?>'><br>
        <label>Estado: </label>
        <input name='estadoUsuario' value='<?php print $estado ?>'><br>
        <label>Cidade: </label>
        <input name='cidadeUsuario' value='<?php print $cidade ?>'><br>
        <label>Bairro: </label>
        <input name='bairroUsuario' value='<?php print $bairro ?>'><br>
        <label>Endereco: </label>
        <input name='enderecoUsuario' value='<?php print $endereco ?>'><br>
        <label>Numero: </label>
        <input name='numeroUsuario' value='<?php print $numero ?>'><br>
        <label>Complemento: </label>
        <input name='complementoUsuario' value='<?php print $complemento ?>'><br>
        <label>Tipo Usuário: </label>
        <select name='tipoUsuario' value='<?php print $tipo ?>'>
            <option value='cliente'>Cliente</option>
            <option value='adm'>Adm</option>
        </select>    <br>
        <label>Foto: </label>
        <?php echo "<img src='../../perfil/imagens/" . $foto. "' width='32px'/>"?>
        
        <br>     
   Selecione uma imagem: <input name="arquivo" type="file"   />
   <br/>
        <button type='submit'>Salvar</button>
    </form>
    <br><a href='pesquisa.php'>Voltar</a> 
</body>
</html>