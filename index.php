<!DOCTYPE html>
<html>
  <head>
        <title>Simple MongoDB CRUD using PHP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="img/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="img/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="img/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="img/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="img/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="img/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
  </head>
  <body>
	 <div align="center" class="well">
        <h2>Simple MongoDB CRUD using PHP</h2>



		<ul class="nav nav-pills">
			<li class="active"><a href="#">Create</a></li>
			<li><a href="update.php">Update</a></li>
			<li><a href="delete.php">Delete</a></li>
		</ul>
	</div>
	<?php

		#Invoca o arquivo que faz a conexão com o MongoDB.

		require_once("connection.php");

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
            <legend>Create page</legend>

		<div class="control-group">

		  <label class="control-label" for="nome">Name</label>
		  <div class="controls">
		    <input  autocomplete="off" id="nomeid"  name="nome" type="text" placeholder="Your name" class="input-xlarge" required>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="email">Email</label>
		  <div class="controls">
		    <input  autocomplete="off" id="email" name="email" type="email" placeholder="Your e-mail" class="input-xlarge" required>

		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="cidade">City</label>
		  <div class="controls">
		    <input  autocomplete="off" id="cidade" name="cidade" type="text" placeholder="Your City" class="input-xlarge" required>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="singlebutton">Is it done?</label>
		  <div class="controls">
		    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Send</button>
		  </div>
		</div>

		</fieldset>
	</form>

	<legend>Showing the Data</legend>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>E-mail</th>
				<th>City</th>
				<th>Date of Register</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>

			<?php
				//Realiza um loop em result para exibir separadamente cada campo dos documentos cadastrados.
            if(!empty($result)):
				foreach ($result as $resultado) {


					echo '<tr>';
						echo '<td>'. $resultado["_id"]. '</td>';
						echo '<td>'. $resultado["Nome"]. '</td>';
						echo '<td>'. $resultado["Email"]. '</td>';
						echo '<td>'. $resultado["Cidade"]. '</td>';
						echo '<td>'. $resultado["criadoem"]. '</td>';
						echo ' <td>

						<a href="update.php?id='.$resultado["_id"].'" title="Alterar Dados">Edit</a>
						<a href="delete.php?id='.$resultado["_id"].'" title="Deletar Dados">Delete</a>

						</td>';
					echo '</tr>';
				}
            endif;
				?>
		</tbody>
	</table>
  </body>
</html>
