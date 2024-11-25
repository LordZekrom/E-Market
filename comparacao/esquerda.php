<?php
               
           # Conecta com BD
           $ds = "mysql:host=localhost;dbname=e_market";
           $con = new PDO($ds, 'root', 'vertrigo');
        
            $query = "SELECT * FROM produto WHERE nomeProduto LIKE '%$nome%'";
			$stm = $con -> prepare($query);
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

        ?>