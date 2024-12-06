<?php
//Inclui o arquivo de verifica��o de sess�o.
    include_once("../../perfil/verifica.php");
    include_once("../../perfil/usuarios/verificaAdm.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Edita</title>
    <style>
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            text-align: center;
            font-size: 16px;
            transition: background-color 0.3s;
        }

    .logout-btn:hover {
        background-color: #34495e;
        color: #f1f1f1;
    }
    </style>
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
            <li><a href="../usuarios/usuarios.php" style="background-color: #2c3e50; color:white;">Cadastro</a></li>
            <li><a href="../usuarios/pesquisa.php" >Pesquisa</a></li>
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
            <option value='cliente'>Cliente</option>
            <option value='adm'>Adm</option>
        </select>    
        <br>        
        Selecione uma imagem: <input name="fotoPerfil" type="file"   />
   <br/>
        <button type='submit'>Salvar</button><br><br>
    <a href='../perfil.php' class="logout-btn">Voltar</a> 
    </body>
    </html>