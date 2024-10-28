<?php
    $cpf = $_SESSION['cpf'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Buscar dados do registro
    $query = "SELECT * FROM usuario WHERE cpfUsuario = $cpf";
    $stm = $con->prepare($query);
    $stm->execute();

    # Pega o resultado
    $result = $stm->fetch();
    $tipoUsuario = $result['tipoUsuario'];

	if($tipoUsuario == "cliente"){
		header("Location:../../pedido/compra.php");
	}
?>