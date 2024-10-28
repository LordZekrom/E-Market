<?php
    # Recebe dados do FORM
    $cpf = $_POST['cpfUsuario'];
    $nome = $_POST['nomeUsuario'];
    $email = $_POST['emailUsuario'];
    $estado = $_POST['estadoUsuario'];
    $cidade = $_POST['cidadeUsuario'];
    $bairro = $_POST['bairroUsuario'];
    $endereco = $_POST['enderecoUsuario'];
    $numero = $_POST['numeroUsuario'];
    $complemento = $_POST['complementoUsuario'];
    $senha = $_POST['senhaUsuario'];
    $tipo = $_POST['tipoUsuario'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    //VERIFICAR SE O CPF OU O EMAIL JÁ NÃO EXISTE

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
            $destino = '../../perfil/imagens/' . $novoNome;
            
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

    # Insere no BD
    $sql = "INSERT INTO usuario (cpfUsuario, nomeUsuario, emailUsuario, estadoUsuario, cidadeUsuario, bairroUsuario, enderecoUsuario, numeroUsuario, complementoUsuario, senhaUsuario, fotoPerfil, tipoUsuario)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
    $stm = $con->prepare($sql);
    $r = $stm->execute(array($cpf, $nome, $email, $estado, $cidade, $bairro, $endereco, $numero, $complemento, $senha, $fotoPerfil, $tipo));

    if($r){
        header("location:pesquisa.php");
    }
    else {
        print "<p>Erro ao inserir</p>";
        print_r($stm->errorInfo());
    }
    
?>