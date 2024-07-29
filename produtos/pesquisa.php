<html lang='pt-br'>
	<head>
		<meta charset='UTF-8'>
		<title>Market</title>
	</head>
	<body>
		<a href='index.php'>Inicial</a> 
		|
		<a href='pesquisa.php'>Pesquisa</a>
		<br>
		<h2>Pesquisa de Produtos</h2>
		<form method="post" action="pesquisa.php">
			<label>Produto:</label>
			<input type="text" name="nomeProduto" />
			<button type="submit">Pesquisar</button>
		</form>
		<h2>Listagem dos Produtos</h2>
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
			$nome = '';
			if (isset($_POST['nomeProduto'])){
				$nome = $_POST['nomeProduto'];
			}
		
			/* Conectando com o banco de dados para listar registros */
			$datasource = 'mysql:host=localhost;dbname=e_market';
			$user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);
	
			$query = "SELECT * FROM produto WHERE nomeProduto LIKE '%$nome%'";
			$stm = $db -> prepare($query);
			
			if ($stm -> execute()) {
				$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$codigoProduto = $row['codigoProduto'];
					$nome = $row['nomeProduto'];
					$descricao = $row['descricaoProduto'];
					$preco= $row['precoProduto'];
					$quantidade= $row['quantidadeProduto'];
					$categoria= $row['categoriaProduto'];

	
					print "<tr>
					<td>$codigoProduto</td>
					<td>$nome</td>
					<td>$descricao</td>
					<td>$preco</td>
					<td>$quantidade</td>
					<td>$categoria</td>
					<td><img src='imagens/" . $row['fotoProduto'] . "' width='60px'/></td>
					<td><a href='delete.php?id=$codigoProduto'>Excluir</a> | 	
					<a href='edita.php?id=$codigoProduto'>Editar</a></td>
					</tr>";					
				}				
			} else {
				print '<p>Erro ao listar produtos!</p>';
			}
		?>
		</table>
	</body>
</html>