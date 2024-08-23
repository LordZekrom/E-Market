<?php
// Inclui o arquivo de verificação de sessão.
include_once("verifica.php");

# Recebe o id pela URL
$cpf = $_SESSION['cpf'];

# Conecta com BD
$ds = "mysql:host=localhost;dbname=e_market";
$db = new PDO($ds, 'root', 'vertrigo');

# Buscar dados do registro
$query = "SELECT * FROM usuario WHERE cpfUsuario = :cpf";
$stm = $db->prepare($query);
$stm->bindParam(':cpf', $cpf);

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
$fotoPerfil = $result['fotoPerfil'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mercado</title>
    <link rel="stylesheet" href="perfil.css">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<header>
    <div class="logo">
        <img src="../imagens/mercado.png" alt="Logo">
    </div>
</header>
<h3>Editar Perfil</h3>
<img src="imagens/<?php echo htmlspecialchars($fotoPerfil); ?>" class="foto_perfil" alt="Foto de Perfil"><br><br>
<form method='POST' action='atualiza.php' enctype="multipart/form-data">
    <label>Nome: </label>
    <input name='nomeUsuario' value='<?php echo htmlspecialchars($nome); ?>'><br>
    <label>Email: </label>
    <input name='emailUsuario' value='<?php echo htmlspecialchars($email); ?>'><br>
    <label>Estado: </label>
    <input name='estadoUsuario' value='<?php echo htmlspecialchars($estado); ?>'><br>
    <label>Cidade: </label>
    <input name='cidadeUsuario' value='<?php echo htmlspecialchars($cidade); ?>'><br>
    <label>Bairro: </label>
    <input name='bairroUsuario' value='<?php echo htmlspecialchars($bairro); ?>'><br>
    <label>Endereco: </label>
    <input name='enderecoUsuario' value='<?php echo htmlspecialchars($endereco); ?>'><br>
    <label>Numero: </label>
    <input name='numeroUsuario' value='<?php echo htmlspecialchars($numero); ?>'><br>
    <label>Complemento: </label>
    <input name='complementoUsuario' value='<?php echo htmlspecialchars($complemento); ?>'><br>
    <label>Foto de Perfil: </label>
    <input type="file" name='fotoPerfil'><br>
    
    <button type='submit'>Salvar</button>
</form>
</body>
</html>
