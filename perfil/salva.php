<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="salva.css"> <!-- Substitua pelo nome do arquivo CSS -->
    <title>Salvar Dados</title>
</head>
<body>
    <div class="mensagem-centralizada">
        <p>     </p>
        <button>Voltar</button> <!-- Botão opcional -->
    </div>
</body>
</html>

<?php
// Recebendo os dados do formulário
$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$senha = md5($senha);

// Conectando com o banco de dados
$datasource = 'mysql:host=localhost;dbname=e_market';
$user = 'root';
$pass = 'vertrigo';
$db = new PDO($datasource, $user, $pass);

// Variável para armazenar o nome do arquivo da foto de perfil
$fotoPerfil = null;

// Verifica se um arquivo foi enviado
if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] == UPLOAD_ERR_OK) {
    $fotoPerfil = $_FILES['fotoPerfil']['name'];
    $extensao = pathinfo($fotoPerfil, PATHINFO_EXTENSION);
    $extensao = strtolower($extensao);

    // Verifica a extensão do arquivo
    if (in_array($extensao, ['jpg', 'jpeg', 'gif', 'png'])) {
        $novoNome = uniqid(time()) . '.' . $extensao;
        $destino = 'imagens/' . $novoNome;
        
        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $destino)) {
            $fotoPerfil = $novoNome;
        } else {
            echo "Erro ao enviar a imagem.";
            exit;
        }
    } else {
        echo "Tipo de arquivo não permitido.";
        exit;
    }
} else {
    // Define uma foto padrão se nenhuma foto for enviada
    $fotoPerfil = 'Perfil.png';
}

// Insere os dados no banco de dados
$query = "INSERT INTO usuario (cpfUsuario, nomeUsuario, emailUsuario, senhaUsuario, fotoPerfil) VALUES (?, ?, ?, ?, ?)";
$stm = $db->prepare($query);
$stm->bindParam(1, $cpf);
$stm->bindParam(2, $nome);
$stm->bindParam(3, $email);
$stm->bindParam(4, $senha);
$stm->bindParam(5, $fotoPerfil);

if ($stm->execute()) {
    echo "<p>Cadastro efetuado com sucesso</p>";
    echo "<a href='perfil.php'>Voltar</a>";
} else {
    echo "<p>Erro ao cadastrar usuário!</p>";
    echo "<a href='perfil.php'>Voltar</a>";
}
?>
