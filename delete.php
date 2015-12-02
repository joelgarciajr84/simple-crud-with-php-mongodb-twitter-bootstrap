 <!DOCTYPE html>
 <html>
  <head>
    <title>Simple MongoDB CRUD using PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/javascript">
		$(document).ready(function(){

			$("#singlebutton").on("click", null, function(){

		        return confirm("Are you SURE?");
		    });
		});
	</script>
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
 	<div  class="well" align="center">

		<h2>Simple MongoDB CRUD using PHP</h2>

		<ul class="nav nav-pills">
			<li><a href="index.php">Create</a></li>
			<li><a href="update.php">Update</a></li>
			<li class="active"><a href="#">Delete</a></li>
		</ul>
    </div>
	<?php

		// Invoca o arquivo que faz a conexão com o MongoDB

		require_once("connection.php");

		//Capta os Dados para exclusão

		if (!empty($_GET['id'])) {

			$id = $_GET['id'];

			//$pessoa vai ser nosso critério de busca na Collection, algo como WHERE no SQL

			$pessoa = array('_id' => $id );

			//Realiza a busca na Collection pessoas usando como parametro $pessoa.

			$query = $pessoas->findOne($pessoa);

			//Separando em variáveis para uma melhor organização cada campo do documento recebido.
			//Essa variáveis serão invocadas no formulário abaixo.

			$nome = $query['Nome'];
			$email = $query['Email'];
			$cidade = $query['Cidade'];
			$criado = $query['criadoem'];
			$pessoaid = $query['_id'];

		}else{


			echo '<span class="label label-warning">Choose a registry to delete</span>';
		}

		//Deletando o Documento solicitado

		if(!is_null( $_POST['nome']) && !is_null( $_POST['email']) && !is_null($_POST['cidade'])) {

			// Capta Dados

			$PegaID = $_POST['id'];
			$PegaData = $_POST['criacao'];
			$AtualizaNome = $_POST['nome'];
			$AtualizaEmail = $_POST['email'];
			$AtualizaCidade = $_POST['cidade'];


			//Prepara Documento a ser deletado.

			$atualizador = array('_id' => 'id');

			$AtPessoa = $pessoas->findOne($atualizador);

			$AtPessoa['Nome'] = $AtualizaNome;
			$AtPessoa['Email'] = $AtualizaEmail;
			$AtPessoa['Cidade'] = $AtualizaCidade;
			$AtPessoa['_id'] = $PegaID;
			$AtPessoa['criadoem'] = $PegaData;



			//Delete o Documento questão da Collection pessoas.

			$pessoas->remove($AtPessoa);
		}

		//Le a coleção Pessoas

		$result = $pessoas->find();

	 ?>

	  <form id="mostradados" name="exibedados" class="form-horizontal" action="delete.php" method="post">
		<fieldset>
            <legend>Delete page</legend>

		<div class="control-group">
		  <label class="control-label" for="id">ID</label>
		  <div class="controls">
		    <input autocomplete="off" id="pessoaid" value="<?php echo $id; ?>"  name="id" type="text" placeholder="ID" class="input-xlarge" readonly>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="criacao">Registration date</label>
		  <div class="controls">
		    <input autocomplete="off" id="criacao" value="<?php echo $criado; ?>"  name="criacao" type="text" placeholder="Registration date" class="input-xlarge" readonly>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="nome">Name</label>
		  <div class="controls">
		    <input  autocomplete="off" id="nomeid" value="<?php echo $nome; ?>"  name="nome" type="text" placeholder="Name" class="input-xlarge" readonly>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="email">E-mail</label>
		  <div class="controls">
		    <input autocomplete="off" id="email" value="<?php echo $email; ?>" name="email" type="email" placeholder="E-mail" class="input-xlarge" readonly>

		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="cidade">City</label>
		  <div class="controls">
		    <input autocomplete="off" id="cidade" value="<?php echo $cidade; ?>" name="cidade" type="text" placeholder="City" class="input-xlarge" readonly>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="singlebutton">Is it done?</label>
		  <div class="controls">
		    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Delete</button>
		  </div>
		</div>

		</fieldset>
	</form>
	<legend>Showing the Data</legend>

	<table id="dlg" class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>E-mail</th>
				<th>City</th>
                <th>Date of register</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>

			<?php
            if(!empty($result)):
				foreach ($result as $resultado) {
					echo '<tr>';
						echo '<td>'. $resultado["_id"]. '</td>';
						echo '<td>'. $resultado["Nome"]. '</td>';
						echo '<td>'. $resultado["Email"]. '</td>';
						echo '<td>'. $resultado["Cidade"]. '</td>';
						echo '<td>'. $resultado["criadoem"]. '</td>';
						echo ' <td>

						<a href="update.php?id='.$resultado["_id"].'" title="Alterar Dados">Editar</a>
						<a class="delete" href="delete.php?id='.$resultado["_id"].'" title="Deletar Dados">Deletar</a>


						</td>';
					echo '</tr>';
				}
            endif;
				?>
		</tbody>
	</table>
  </body>
</html>
