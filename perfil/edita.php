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
    <title>Editar Dados</title>
    <link rel="stylesheet" href="edita.css">
</head>
<body>
<header>
        <div class="logo">
        <a href=" ../home/index.html">
             <img src="../imagens/logo2.png" alt="Logo">
            </a>
        </div>
        <div class="search-bar">
            <input type="search" placeholder="Pesquisar...">
            <button type="submit">Buscar</button>
        </div>
        <div class="cart">
            <a href="../pedido/carrinho.php">
                <img src="../imagens/carrinho.png" alt="Carrinho">
            </a>
        </div>
    </header>


    
<img src="imagens/<?php echo htmlspecialchars($fotoPerfil); ?>" class="foto_perfil" alt="Foto de Perfil"><br>

<div class="table-container">
    <form method='POST' action='atualiza.php' enctype="multipart/form-data">
        <table class="user-data-table">
            <tr>
                <th>Campo</th>
                <th>Informação</th>
            </tr>
            <tr>
                <td>Nome:</td>
                <td><input name='nomeUsuario' value='<?php echo htmlspecialchars($nome); ?>'></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input name='emailUsuario' value='<?php echo htmlspecialchars($email); ?>'></td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td><input name='estadoUsuario' value='<?php echo htmlspecialchars($estado); ?>'></td>
            </tr>
            <tr>
                <td>Cidade:</td>
                <td><input name='cidadeUsuario' value='<?php echo htmlspecialchars($cidade); ?>'></td>
            </tr>
            <tr>
                <td>Bairro:</td>
                <td><input name='bairroUsuario' value='<?php echo htmlspecialchars($bairro); ?>'></td>
            </tr>
            <tr>
                <td>Endereço:</td>
                <td><input name='enderecoUsuario' value='<?php echo htmlspecialchars($endereco); ?>'></td>
            </tr>
            <tr>
                <td>Número:</td>
                <td><input name='numeroUsuario' value='<?php echo htmlspecialchars($numero); ?>'></td>
            </tr>
            <tr>
                <td>Complemento:</td>
                <td><input name='complementoUsuario' value='<?php echo htmlspecialchars($complemento); ?>'></td>
            </tr>
            <tr>
                <td>Foto de Perfil:</td>
                <td><input type="file" name='fotoPerfil'></td>
            </tr>
        </table>
        
        <button type='submit' class="save-btn">Salvar</button>
        <a href="logout.php" class="logout-btn">Sair da conta</a>
    </form>
</div>
</body>
</html>
