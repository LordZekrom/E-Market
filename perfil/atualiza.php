<?php
//Inclui o arquivo de verifica��o de sess�o.
    include_once("verifica.php");
?>
<?php
    $cpf = $_SESSION['cpf'];
    #Recebendo os dados
    $nome = $_POST['nomeUsuario'];
    $email = $_POST['emailUsuario'];
    $estado = $_POST['estadoUsuario'];
    $cidade = $_POST['cidadeUsuario'];
    $bairro = $_POST['bairroUsuario'];
    $endereco = $_POST['enderecoUsuario'];
    $numero = $_POST['numeroUsuario'];
    $complemento = $_POST['complementoUsuario'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    # SQL para update
    $query = "UPDATE usuario SET nomeUsuario=?, emailUsuario=?, estadoUsuario=?, cidadeUsuario=?, bairroUsuario=?, enderecoUsuario=?, numeroUsuario=?, complementoUsuario=? WHERE cpfUsuario=?";
    $stm = $con->prepare($query);
    $stm->bindParam(1, $nome);
    $stm->bindParam(2, $email);
    $stm->bindParam(3, $estado);
    $stm->bindParam(4, $cidade);
    $stm->bindParam(5, $bairro);
    $stm->bindParam(6, $endereco);
    $stm->bindParam(7, $numero);
    $stm->bindParam(8, $complemento);
    $stm->bindParam(9, $cpf);


    #Executa SQL
    if($stm->execute()){
        header('location:perfil.php');
    }
    else{
        print "<p>Erro ao atualizar</p>";
        print_r($stm->errorInfo());
    }
?>