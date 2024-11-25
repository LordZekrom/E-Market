<?php
// Conexão com o banco de dados
    $datasource = 'mysql:host=localhost;dbname=e_market';
    $user = 'root';
    $pass = 'vertrigo';
    $db = new PDO($datasource, $user, $pass);

// Inicializa a mensagem como vazia
$mensagem = "";

// Recebe os dados do formulário
$cpf = $_POST['cpf'] ?? null;
$nome = $_POST['nome'] ?? null;
$email = $_POST['email'] ?? null;
$senha = $_POST['senha'] ?? null;
// Converte a senha para hash MD5
$senha = md5($senha);
// Verifica se os campos obrigatórios estão preenchidos
if (empty($cpf) || empty($nome) || empty($email) || empty($senha)) {
    $mensagem = "Todos os campos são obrigatórios.";

    $query = "INSERT INTO usuario (cpfUsuario, nomeUsuario, emailUsuario, senhaUsuario, fotoPerfil) VALUES ($cpf, $nome, $email, $senha,";

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
            $query .= ":fotoPerfil)";
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
    if (isset($novoNome)) {
    $stm->bindParam(':fotoPerfil', $novoNome);
    }

    if ($stm->execute()) {
    header("Location: perfil.php");
    } else {
    echo "<p>Erro ao atualizar</p>";
    print_r($stm->errorInfo());
    }
}

/*
    // Conexão com o banco de dados
    $datasource = 'mysql:host=localhost;dbname=e_market';
    $user = 'root';
    $pass = 'vertrigo';
    $db = new PDO($datasource, $user, $pass);

// Inicializa a mensagem como vazia
$mensagem = "";

// Recebe os dados do formulário
$cpf = $_POST['cpf'] ?? null;
$nome = $_POST['nome'] ?? null;
$email = $_POST['email'] ?? null;
$senha = $_POST['senha'] ?? null;
// Converte a senha para hash MD5
$senha = md5($senha);
// Verifica se os campos obrigatórios estão preenchidos
if (empty($cpf) || empty($nome) || empty($email) || empty($senha)) {
    $mensagem = "Todos os campos são obrigatórios.";
} else {
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
                $mensagem = "Erro ao salvar a imagem de perfil.";
            }
        } else {
            $mensagem = "Tipo de arquivo não permitido para a imagem.";
        }
    } else {
        // Define uma foto padrão se nenhuma foto for enviada
        $fotoPerfil = 'Perfil.png';
    }

    // Se não houver mensagem de erro até aqui, insere os dados no banco
    if (empty($mensagem)) {
        $query = "INSERT INTO usuario (cpfUsuario, nomeUsuario, emailUsuario, senhaUsuario, fotoPerfil) VALUES (?, ?, ?, ?, ?)";
        $stm = $db->prepare($query);
        $stm->bindParam(1, $cpf);
        $stm->bindParam(2, $nome);
        $stm->bindParam(3, $email);
        $stm->bindParam(4, $senha);
        $stm->bindParam(5, $novoNome);

        if ($stm->execute()) {
            $mensagem = "Cadastro efetuado com sucesso!";
        } else {
            $mensagem = "Não foi possível realizar o cadastro.";
        }
    }
}*/
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="salva.css">
    <title>Salvar Dados</title>
</head>
<body>
    <div class="voltar">
        <!-- Exibe a mensagem gerada -->
        <p><?= htmlspecialchars($mensagem) ?></p>
        <button onclick="window.location.href='perfil.php';">Voltar</button>
    </div>
</body>
</html>
