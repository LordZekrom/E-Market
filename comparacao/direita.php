<?php
                     
              # Conecta com BD
              $ds = "mysql:host=localhost;dbname=e_market";
              $con = new PDO($ds, 'root', 'vertrigo');
           
               $query = "SELECT * FROM produto WHERE nomeProduto LIKE '%$nome2%'";
               $stm = $con -> prepare($query);
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
                    <button onclick=\"selecionar('produtoB', $codigoProduto)\">Selecionar</button>
                </div>";
            }
        ?>