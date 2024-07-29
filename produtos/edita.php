<?php
    #Recebe o id pela URL
    $cbid = $_GET['cbid'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=mercado";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Buscar dados do registro
    $sql = "SELECT * from market WHERE cbid=?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1,$cbid);

    # Executa o SQL
    $stm->execute();

    # Pega o resultado
    $result = $stm->fetch();
    $cbid = $result['cbid'];
    $nome = $result['nome'];
    $valor = $result['valor'];
    $validade = $result['validade'];

    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mercado</title>
</head>
<body>
    <h3>Editar Produto</h3>
    <form method='post' action='atualiza.php'>
        <label>Código de barras: </label>
        <input type='hidden' name='id' value='<?php print $cbid ?>'>
        <label>Nome: </label>
        <input name='nome' value='<?php print $nome ?>'><br>
        <label>Valor: </label>
        <input name='valor' value='<?php print $valor ?>'><br>
        <label>Validade: </label>
        <input name='validade' value='<?php print $validade ?>'><br>
        <button type='submit'>Atualizar</button>
</form>
</body>
</html>