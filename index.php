<?php include 'header.php';

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
				"_id"		=>	crypt($email,md5($nome))
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
