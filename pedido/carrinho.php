<?php


    $cpfUsuario = "12345678911";


   if (isset($_GET['IdProduto']) /*&& isset($_GET['cpfUsuario'])*/) {




    #Recebe os parâmetros da URL
    $idProduto = $_GET['idProduto'];
    #$cpfusuario = $_GET['cpfUsuario'];


    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');




    ###### Verificar se já existe um pedido com status CARRINHO, se existir pega o ID    
    $sql = "SELECT * FROM pedido WHERE cpfUsuario = ? AND statusPedido = 'carrinho'";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $cpfUsuario);
    $stm->execute();


    $idPedido = 0;


    if($row = $stm->fetch()){
        $idPedido = $row['idPedido'];  
           
    }
    else {
        ####### Caso não existe pedido com status CARRINHO, para este CPF, criamos um pedido com STATUS CARRINHO
        $sql = 'INSERT INTO pedido (cpfUsuario, statusPedido) VALUES(?,1)';
        $stm = $con->prepare($sql);
        $r = $stm->execute(array($cpfUsuario));


        #Vereficar inserção
        if($r){
            $idPedido = $con->lastInsertId();
        }
        else{
            print"<p>ERRO AO INSERIR<p>";
            print_r($stm->errorInfo());
        }


    }
    print "<p>ID pedido: $idPedido</p>";  
    print "<p>ID produto: $codigoProduto</p>";  


    ####### Primeiro, verificar se o item já está no carrinho
    $sqlCheck = 'SELECT * FROM itenspedido WHERE idItensPedido = :idPedido AND codigoProduto = :codigoProduto';
    $stmCheck = $con->prepare($sqlCheck);
    $stmCheck->execute([':idPedido' => $idPedido, ':codigoProduto' => $codigoProduto]);
   
    if($row = $stmCheck->fetch()){
        $idItensPedido = $row['idItensPedido'];      
        $quantidadeItensPedido =  $row['quantidadeItensPedido'] + 1;


        ########## Se item existe no carrinho (itempedido), eu atualizo a quantidade
        $sql = "UPDATE itenspedido SET quantidadeItensPedido=? WHERE idItensPedido=?";
        $stm = $con->prepare($sql);
        $stm->bindParam(1, $quantidadeItensPedido);
        $stm->bindParam(2, $idItensPedido);


        print "<p>ID itenspedido: $idItensPedido | Item existe no carrinho.</p>";


        # Executa SQL
        if ($stm->execute()){
            print "<p>OK OK</p>";
        }
        else{
            print "<p>Erro ao atualizar</p>";
        }
    }
    else{
        ############ Caso item não exista em itempedido, faço inserção
        $sql = 'INSERT INTO itenspedido (idPedido, codigoProduto, quantidadeItensPedido) VALUES(?,?,1)';
        $stm = $con->prepare($sql);
        $stm->bindParam(1, $idPedido);
        $stm->bindParam(2, $codigoProduto);
        


        #Vereficar inserção
        $r = $stm->execute();
        if($r){
            print "<p>Inseriu item no carrinho</p>";
            print "<p>Item inserido carrinho.</p>";
        }
        else{
            print"<p>ERRO AO INSERIR<p>";
            print_r($stm->errorInfo());
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>

<?php
    # Recebe o CPF pela URL
    $cpfUsuario = isset($_GET['cpfUsuario']) ? $_GET['cpfUsuario'] : '';
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de compras da E-Market</title>
    <link rel="stylesheet" href="../pedido/carrinho.css">
    </head>
<body>
    <header>
        <div class="logo">
             <img src="../imagens/mercado.png" alt="Logo">
        </div>
        <div class="search-bar">
            <input type="search" placeholder="Pesquisar...">
            <button type="submit">Buscar</button>
        </div>
        <div class="cart">
            <a href=" ../pedido/carrinho.php">
            <img src="../imagens/carrinho.png" alt="Carrinho">
             </a>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../home/index.html">Home</a></li>
            <li><a href="../pedido/compra.php">Produtos</a></li>
            <li><a href="../comparacao/index.html">Comparação</a></li>
            <li><a href="../perfil/perfil.php"  >Perfil</a></li> 
        </ul>
    </nav>
    <form method="POST" action="inserir.php">
        <label>CPF: </label>
        <input name="cpfUsuario" value="<?php echo htmlspecialchars($cpfUsuario, ENT_QUOTES, 'UTF-8'); ?>">
        <br>
       
        <h3>Listagem de Produtos</h3>
        <table border>
            <tr>
                <th>Ações</th>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Excluir</th>
            </tr>


            <?php
                // Conecta com BD
                $ds = 'mysql:host=localhost;dbname=e_market';
                $con = new PDO($ds, 'root', 'vertrigo');


                // Seleciona todos os registros
                $sql = 'SELECT * FROM produto';
                $stm = $con->prepare($sql);
                $stm->execute();


                // Percorre os registros
                foreach($stm as $row){
                    $codigoProduto = $row['codigoProduto']; // Verifique se está sendo atribuído corretamente
                    $nomeProduto = $row['nomeProduto'];
                    $precoProduto = $row['precoProduto'];


                    echo '<tr>';
                    echo "<td>
                        <a href='inserir.php?codigoProduto=" . urlencode($codigoProduto) . "&cpfUsuario=" . urlencode($cpfUsuario) . "'>Adicionar ao carrinho</a>
                        <form action='salvar.php' method='post' style='display:inline;'>
                            <input type='hidden' name='idProduto' value='" . htmlspecialchars($codigoProduto, ENT_QUOTES, 'UTF-8') . "'>
                            <input type='hidden' name='nomeProduto' value='" . htmlspecialchars($nomeProduto, ENT_QUOTES, 'UTF-8') . "'>
                            <input type='hidden' name='precoProduto' value='" . htmlspecialchars($precoProduto, ENT_QUOTES, 'UTF-8') . "'>
                        </form>
                    </td>";
                    echo '<td>' . htmlspecialchars($row['codigoProduto'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td>' . htmlspecialchars($row['nomeProduto'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td>' . htmlspecialchars($row['precoProduto'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    <button type='submit'>Salvar</button>


    <h3>Pedidos</h3>
    <table border>
        <tr>
            <th>ID</th>
            <th>CPF Cliente</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Preço Final</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>


        <?php

// Conecta com BD
$ds = 'mysql:host=localhost;dbname=e_market';
$con = new PDO($ds, 'root', 'vertrigo');


// Seleciona todos os registros
$sql = "SELECT * FROM pedido";
$stm = $con->prepare($sql);
$stm->execute();


// Percorre os registros
foreach($stm as $row){
    $datetime = $row['dataPedido'];
    $datetimeObj = new DateTime($datetime);
    $data = $datetimeObj->format('d/m/Y');
    $hora = $datetimeObj->format('H:i:s');
    $id = $row['idPedido'];


    echo "<tr>";
    echo "<td>" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($row['cpfUsuario'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($data, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($hora, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($row['precoFinal'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($row['statusPedido'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>
            <a href='delete.php?idPedido=" . urlencode($id) . "'>Deletar</a>
            |
            <a href='edita.php?idPedido=" . urlencode($id) . "'>Editar</a>
        </td>";
    echo "</tr>";
}
?>
</table>
</body>
</html>

