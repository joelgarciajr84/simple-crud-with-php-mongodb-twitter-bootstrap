<!DOCTYPE html>
<html>
  <head>
    <title>CRUD SIMPLES COM PHP + MongoDB + Twitter Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
	 <div  class="well" align="center">

		<h2>CRUD SIMPLES COM PHP + MongoDB + Twitter Bootstrap</h2>

		<ul class="nav nav-pills">
			<li class="active"><a href="#">Cadastrar</a></li>
			<li><a href="atualiza.php">Atualizar</a></li>
			<li><a href="deleta.php">Deletar</a></li>
		</ul>
	</div>
	<?php

		#Invoca o arquivo que faz a conexão com o MongoDB.

		require_once("conexao.php");

		// Capta os dados do formulário.

		if(!is_null( $_POST['nome']) && !is_null( $_POST['email']) && !is_null($_POST['cidade'])) {

			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$cidade = $_POST['cidade'];
			$datacriacao = date('d/m/Y  h:i:s');

		//Prepara o array que criará um documento na coleção pessoas.

			$addpessoas = array(

				"Nome" 		=> 	$nome,
				"Email"		=>	$email,
				"Cidade"	=>	$cidade,
				"criadoem"	=> 	$datacriacao,
				"_id"		=>	md5($nome)
			);

		// Insere o array $addpessoas na coleção pessoas.

			$pessoas->insert($addpessoas);
		}

		//Lê toda a coleção Pessoas -- Equivalente ao SELECT * FROM no SQL.

		$result = $pessoas->find();
	?>

	<form id="mostradados" name="exibedados" class="form-horizontal" action="<?php $_SERVER['REQUEST_URI']?>" method="post">
		
		<fieldset>

		<div class="control-group">

		  <label class="control-label" for="nome">Nome</label>
		  <div class="controls">
		    <input  autocomplete="off" id="nomeid"  name="nome" type="text" placeholder="Seu nome" class="input-xlarge" required>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="email">Email</label>
		  <div class="controls">
		    <input  autocomplete="off" id="email" name="email" type="email" placeholder="Seu email" class="input-xlarge" required>
		    
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="cidade">Cidade</label>
		  <div class="controls">
		    <input  autocomplete="off" id="cidade" name="cidade" type="text" placeholder="Sua Cidade" class="input-xlarge" required>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="singlebutton">Enviar</label>
		  <div class="controls">
		    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Confirmar</button>
		  </div>
		</div>

		</fieldset>
	</form>

	<legend>Exibição dos Dados</legend>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Email</th>
				<th>Cidade</th>
				<th>Data do Cadastro</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
				//Realiza um loop em result para exibir separadamente cada campo dos documentos cadastrados.
			
				foreach ($result as $resultado) {


					echo '<tr>';
						echo '<td>'. $resultado["_id"]. '</td>';
						echo '<td>'. $resultado["Nome"]. '</td>';
						echo '<td>'. $resultado["Email"]. '</td>';
						echo '<td>'. $resultado["Cidade"]. '</td>';
						echo '<td>'. $resultado["criadoem"]. '</td>';
						echo ' <td>

						<a href="atualiza.php?id='.$resultado["_id"].'" title="Alterar Dados">Editar</a>
						<a href="deleta.php?id='.$resultado["_id"].'" title="Deletar Dados">Deletar</a>
						
						</td>';
					echo '</tr>';
				}
				?>
		</tbody>
	</table>
  </body>
</html>