<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edita</title>
</head>
<body>
    <a href='index.php'>Inicial</a> 
            |
            <a href='pesquisa.php'>Pesquisa</a>
            <br>
        <h3>Cadastro de produtos</h3>
    <form method='POST' action='inserir.php' enctype="multipart/form-data">
        <label>Código: </label>
        <input name='codigoProduto'><br>
        <label>Nome: </label>
        <input name='nomeProduto'><br>
        <label>Descrição: </label>
        <input name='descricaoProduto'><br>
        <label>Preço </label>
        <input name='precoProduto'><br>
        <label>Quantidade </label>
        <input name='quantidadeProduto'><br>
        <label>Categoria </label>
        <select name='categoriaProduto'>
            <option value='1'>Eletrônicos</option>
            <option value='2'>Roupas</option>
            <option value='3'>Alimentos</option>
            <option value='4'>Livros</option>
            <option value='5'>Higiene</option>
            <option value='6'>Bebidas</option>
            <option value='7'>Casa</option>
            <option value='8'>Outros</option>
        </select>    
        <br>        
   Selecione uma imagem: <input name="arquivo" type="file" />
   <br/>
        <button type='submit'>Salvar</button>
    </form>
    <h3>Listagem de Produtos</h3>
    <table border>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Categoria</th>
            <th>Foto Produto</th>
            <th>Ações</th>
        </tr>
    <?php
        # Conecta com BD
        $ds = "mysql:host=localhost;dbname=e_market";
        $con = new PDO($ds, 'root', 'vertrigo');
    
        # Seleciona todos os registros
        $sql = "SELECT * FROM produto";
        $stm = $con->prepare($sql);
        $stm->execute();
    
        # Percorre os registros
        foreach($stm as $row){
            $codigoProduto = $row['codigoProduto'];
            
            echo "<tr>";
            echo "<td>" . $codigoProduto . "</td>";
            echo "<td>" . $row['nomeProduto'] . "</td>";
            echo "<td>" . $row['descricaoProduto'] . "</td>";
            echo "<td>" . $row['precoProduto'] . "</td>";
            echo "<td>" . $row['quantidadeProduto'] . "</td>";
            echo "<td>" . $row['categoriaProduto'] . "</td>";
            echo "<td><img src='imagens/" . $row['fotoProduto'] . "' width='60px'/></td>";
            echo "<td>
                    <a href='delete.php?codigoProduto=$codigoProduto'>Deletar</a>
                    |
                    <a href='edita.php?codigoProduto=$codigoProduto'>Editar</a>
                 </td>"; 
            echo "</tr>";
        }
    ?>
    </table>
    </body>
    </html>