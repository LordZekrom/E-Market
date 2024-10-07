<?php
//Inclui o arquivo de verifica��o de sess�o.
    include_once("../../perfil/verifica.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Edita</title>
</head>
<body>
<header>
        <div class="logo">
             <img src="../../imagens/logo2.png" alt="Logo">
        </div>
        <div class="edit">
           <h4 style="color:white">Gerenciamento de Usuários  </h4>
        </div>
        <div class="cart">
            
        </div>
        
        
    </header>
    <nav>
        <ul>
            <li><a href="../../produtos/index.php" style="background-color: #2c3e50; color:white;">Inicial</a></li>
            <li><a href="../../produtos/pesquisa.php" >Pesquisa</a></li>
        </ul>
    </nav>
            <?php
        if (isset($_GET['msg'])){
            print "<span style='color:red'>Produto não pode ser removido devido a registros em venda.</span>";
        }
    ?>
        <h3>Cadastro de Usuário</h3>
    <form method='POST' action='inserir.php' enctype="multipart/form-data">
        <label>Cpf: </label>
        <input name='cpfUsuario'><br>
        <label>Nome: </label>
        <input name='nomeUsuario'><br>
        <label>Email: </label>
        <input name='emailUsuario'><br>
        <label>Estado: </label>
        <input name='estadoUsuario'><br>
        <label>Cidade: </label>
        <input name='cidadeUsuario'><br>
        <label>Bairro: </label>
        <input name='bairroUsuario'><br>
        <label>Endereco: </label>
        <input name='enderecoUsuario'><br>
        <label>Numero: </label>
        <input name='numeroUsuario'><br>
        <label>Complemento: </label>
        <input name='complementoUsuario'><br>
        <label>Senha: </label>
        <input name='senhaUsuario'><br>
        <label>Tipo: </label>
        <select name='tipoUsuario'>
            <option value='1'>Cliente</option>
            <option value='2'>Adm</option>
        </select>    
        <br>        
   Selecione uma imagem: <input name="fotoUsuario" type="file" />
   <br/>
        <button type='submit'>Salvar</button>
    </form>
    <h3>Listagem de Produtos</h3>
    <table border>
        <tr>
            <th>Cpf</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Bairro</th>
            <th>Endereco</th>
            <th>Numero</th>
            <th>Complemento</th>
            <th>Foto Usuário</th>
            <th>Ações</th>
        </tr>
    <?php
    // Recebe o cpf da sessão
    $cpf = $_SESSION['cpf'];
        # Conecta com BD
        $ds = "mysql:host=localhost;dbname=e_market";
        $con = new PDO($ds, 'root', 'vertrigo');
    
        # Seleciona todos os registros
        $sql = "SELECT * FROM usuario";
        $stm = $con->prepare($sql);
        $stm->execute();
    
        # Percorre os registros
        foreach($stm as $row){
            echo "<tr>";
            echo "<td>" . $cpf . "</td>";
            echo "<td>" . $row['nomeUsuario'] . "</td>";
            echo "<td>" . $row['emailUsuario'] . "</td>";
            echo "<td>" . $row['estadoUsuario'] . "</td>";
            echo "<td>" . $row['cidadeUsuario'] . "</td>";
            echo "<td>" . $row['bairroUsuario'] . "</td>";
            echo "<td>" . $row['enderecoUsuario'] . "</td>";
            echo "<td>" . $row['numeroUsuario'] . "</td>";
            echo "<td>" . $row['complementoUsuario'] . "</td>";
/*Falte esse tbm*/            echo "<td><img src='imagens/" . $row['fotoProduto'] . "' width='60px'/></td>";
            echo "<td>
                    <a href='delete.php?codigoProduto=$codigoProduto'>Deletar</a>
                    |
                    <a href='edita.php?codigoProduto=$codigoProduto'>Editar</a>
                 </td>"; 
            echo "</tr>";
        }
    ?>
    </table>
    <a href='../pedido/compra.php'>Voltar</a> 
    </body>
    </html>