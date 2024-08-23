<?php
// Inclui o arquivo de verificação de sessão.
include_once("verifica.php");

// Recebe o id pela URL
$cpf = $_SESSION['cpf'];

// Conecta com BD
$ds = "mysql:host=localhost;dbname=e_market";
$db = new PDO($ds, 'root', 'vertrigo');

// Atualiza os dados do usuário
$query = "UPDATE usuario SET 
    nomeUsuario = :nome, 
    emailUsuario = :email, 
    estadoUsuario = :estado, 
    cidadeUsuario = :cidade, 
    bairroUsuario = :bairro, 
    enderecoUsuario = :endereco, 
    numeroUsuario = :numero, 
    complementoUsuario = :complemento";

if ($_FILES['fotoPerfil']['name']) {
    // Se uma nova imagem foi enviada
    $fotoPerfil = $_FILES['fotoPerfil']['name'];
    $extensao = pathinfo($fotoPerfil, PATHINFO_EXTENSION);
    $extensao = strtolower($extensao);

    // Verifica a extensão do arquivo
    if (in_array($extensao, ['jpg', 'jpeg', 'gif', 'png'])) {
        $novoNome = uniqid(time()) . '.' . $extensao;
        $destino = 'imagens/' . $novoNome;
        
        if (move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $destino)) {
            $query .= ", fotoPerfil = :fotoPerfil";
        } else {
            echo "Erro ao enviar a imagem.";
            exit;
        }
    } else {
        echo "Tipo de arquivo não permitido.";
        exit;
    }
}

$query .= " WHERE cpfUsuario = :cpf";

$stm = $db->prepare($query);
$stm->bindParam(':nome', $_POST['nomeUsuario']);
$stm->bindParam(':email', $_POST['emailUsuario']);
$stm->bindParam(':estado', $_POST['estadoUsuario']);
$stm->bindParam(':cidade', $_POST['cidadeUsuario']);
$stm->bindParam(':bairro', $_POST['bairroUsuario']);
$stm->bindParam(':endereco', $_POST['enderecoUsuario']);
$stm->bindParam(':numero', $_POST['numeroUsuario']);
$stm->bindParam(':complemento', $_POST['complementoUsuario']);
$stm->bindParam(':cpf', $cpf);

if (isset($novoNome)) {
    $stm->bindParam(':fotoPerfil', $novoNome);
}

if ($stm->execute()) {
    header("Location: perfil.php");
} else {
    echo "<p>Erro ao atualizar</p>";
    print_r($stm->errorInfo());
}
?>
