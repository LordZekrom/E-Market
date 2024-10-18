<?php
    $produtoA = $_POST['produtoA'];
    $produtoB = $_POST['produtoB'];

    # Conecta com o BD
    $ds = "mysql:host=localhost;dbname=e_market";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Seleciona os produtos conforme o código fornecido
    $sql = "SELECT * FROM produto WHERE codigoProduto = :codigoProdutoA";
    $stm = $con->prepare($sql);
    $stm->bindParam(':codigoProdutoA', $produtoA, PDO::PARAM_INT);
    $stm->execute();

    # Percorre os registros
    foreach($stm as $row){
        $codigoProduto = $row['codigoProduto'];
        echo "<div class='product listA' id='listA$codigoProduto'>
            <img src='../produtos/imagens/" . $row['fotoProduto'] . "' />
            " . $row['nomeProduto'] . "
            <table>
                <tr>
                    <h4>R$" . $row['precoProduto'] . "</h4>
                </tr>
                <br>
                <tr>
                    " . $row['descricaoProduto'] . "
                </tr>
            </table>
            <button onclick=\"selecionar('produtoA'," . $codigoProduto . ")\">Selecionar</button>
        </div>";
        
    }

     # Conecta com o BD
     $ds = "mysql:host=localhost;dbname=e_market";
     $con = new PDO($ds, 'root', 'vertrigo');
 
     # Seleciona os produtos conforme o código fornecido
     $sql = "SELECT * FROM produto WHERE codigoProduto = :codigoProdutoB";
     $stm = $con->prepare($sql);
     $stm->bindParam(':codigoProdutoB', $produtoA, PDO::PARAM_INT);
     $stm->execute();
 
     # Percorre os registros
     foreach($stm as $row){
         $codigoProduto = $row['codigoProduto'];
         echo "<div class='product listB' id='listB$codigoProduto'>
             <img src='../produtos/imagens/" . $row['fotoProduto'] . "' />
             " . $row['nomeProduto'] . "
             <table>
                 <tr>
                     <h4>R$" . $row['precoProduto'] . "</h4>
                 </tr>
                 <br>
                 <tr>
                     " . $row['descricaoProduto'] . "
                 </tr>
             </table>
             <button onclick=\"selecionar('produtoBn'," . $codigoProduto . ")\">Selecionar</button>
         </div>";
         
     }
?>
