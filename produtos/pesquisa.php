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
			<input type="text" name="nome" />
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
					
				</th>
				<th>Ações</th>
			</tr>
		<?php
			$nome = '';
			if (isset($_POST['nome'])){
				$nome = $_POST['nome'];
			}
		
			/* Conectando com o banco de dados para listar registros */
			$datasource = 'mysql:host=localhost;dbname=agenda';
			$user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);
	
			$query = "SELECT * FROM market WHERE nome LIKE '%$nome%'";
			$stm = $db -> prepare($query);
			
			if ($stm -> execute()) {
				$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$cbid = $row['cbid'];
					$nome = $row['nome'];
					$valor = $row['valor'];
					$validade= $row['validade'];
	
					print "<tr>
					<td>$cbid</td>
					<td>$nome</td>
					<td>$valor</td>
					<td>$validade</td>
					<td><a href='delete.php?id=$cbid'>Excluir</a> | 	
					<a href='edita.php?id=$cbid'>Editar</a></td>
					</tr>";					
				}				
			} else {
				print '<p>Erro ao listar produtos!</p>';
			}
		?>
		</table>
	</body>
</html>