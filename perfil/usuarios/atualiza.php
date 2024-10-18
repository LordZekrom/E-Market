<?php
    # Recebe os dados do formulário
    $cpfAntigo = $_POST['cpfAntigo'];
    $cpf = $_POST['cpfUsuario'];
    $nome = $_POST['nomeUsuario'];
    $email = $_POST['emailUsuario'];
    $estado = $_POST['estadoUsuario'];
    $cidade = $_POST['cidadeUsuario'];
    $bairro = $_POST['bairroUsuario'];
    $endereco = $_POST['enderecoUsuario'];
    $numero = $_POST['numeroUsuario'];
    $complemento = $_POST['complementoUsuario'];
    $tipo = $_POST['tipoUsuario'];
    $foto = $_POST['fotoPerfil'];
   
    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    # SQL para update
    $sql = "UPDATE usuario SET cpfUsuario=?, nomeUsuario=?, emailUsuario=?, estadoUsuario=?, cidadeUsuario=?, bairroUsuario =?, enderecoUsuario=?, numeroUsuario=?, complementoUsuario=?, tipoUsuario=? WHERE cpfUsuario = $cpfAntigo";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $cpf);
    $stm->bindParam(2, $nome);
    $stm->bindParam(3, $email);
    $stm->bindParam(4, $estado);
    $stm->bindParam(5, $cidade);
    $stm->bindParam(6, $bairro);
    $stm->bindParam(7, $endereco);
    $stm->bindParam(8, $numero);
    $stm->bindParam(9, $complemento);
    $stm->bindParam(10, $tipo);
    $r = $stm->execute();


if($r){
    
}
else {
    print "<p>Erro ao inserir</p>";
    print_r($stm->errorInfo());
}
$redirecionar = false;


     // verifica se foi enviado um arquivo 
if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
    echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'arquivo' ][ 'name' ] . '</strong><br />';
    echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'arquivo' ][ 'type' ] . ' </strong ><br />';
    echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'arquivo' ][ 'tmp_name' ] . '</strong><br />';
    echo 'Seu tamanho é: <strong>' . $_FILES[ 'arquivo' ][ 'size' ] . '</strong> Bytes<br /><br />';
 
    $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
    $nome = $_FILES[ 'arquivo' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = '../../perfil/imagens/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            
            $sql = "UPDATE usuario set fotoPerfil = ? WHERE cpfUsuario = $cpf";
            $stm = $con->prepare($sql);            
            $r = $stm->execute(array($novoNome));

            if($r){
                $redirecionar = true;
            }
            else {
                print "<p>Erro ao atualizar</p>";
                print_r($stm->errorInfo());
            }
            
            
        }
        else{
        echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
    }
}
else{
echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
}
}
else{
echo 'Você não enviou nenhum arquivo!';
$redirecionar = true;
}

if ($redirecionar){
header("location:pesquisa.php");
}

 
    
?>