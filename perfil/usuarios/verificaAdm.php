<?php
    
    # Buscar dados do registro
    $query = "SELECT * FROM usuario WHERE cpfUsuario = $cpf";
    $stm = $db->prepare($query);

    # Executa o SQL
    $stm->execute();

    # Pega o resultado
    $result = $stm->fetch();
    $nome = $result['nomeUsuario'];
    TNTANDO TERMINAR AINDA
    if ($stm->execute()) {
	//Verifica se há dados ativos na sessão
	if(empty($_SESSION["cpf"]))
	{
		//Caso não exista dados registrados, exige login
		header("Location:../perfil/login.php");
	}
?>