 <!DOCTYPE html>
 <html>
  <head>
    <title>CRUD SIMPLES COM PHP + MongoDB + Twitter Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/javascript">
		$(document).ready(function(){

			$("#singlebutton").on("click", null, function(){

		        return confirm("Tem Certeza?");
		    });

		 });
	</script>
  </head>
  <body>

    <div  class="well" align="center">

		<h2>CRUD SIMPLES COM PHP + MongoDB + Twitter Bootstrap</h2>

		<ul class="nav nav-pills">
			<li><a href="index.php">Cadastrar</a></li>
			<li class="active"><a href="#">Atualizar</a></li>
			<li><a href="deleta.php">Deletar</a></li>
		</ul>
    </div>
	<?php 

		// Invoca o arquivo que realiza a conexão com o MongoDB.

		require_once("conexao.php");

		//Capta os dados solicitados para edição.

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
			
			echo '<span class="label label-warning">Escolha um Registro para Editar</span>';
			
		}

		//Salvando a edição dos Dados.

		if(!is_null( $_POST['nome']) && !is_null( $_POST['email']) && !is_null($_POST['cidade'])) {

			//Capta os dados que foram editados (ou não) pelo usuário.

			$PegaID = $_POST['id'];
			$PegaData = $_POST['criacao'];
			$AtualizaNome = $_POST['nome'];
			$AtualizaEmail = $_POST['email'];
			$AtualizaCidade = $_POST['cidade'];


			//$Atualizador passa a ser nosso parametro de busca na Collection, novamente algo como WHERE no SQL.

			$atualizador = array('_id' => 'id');

			//Realiza a busca na Collection pessoas passando o parametro $atualizador.

			$AtPessoa = $pessoas->findOne($atualizador);

			//Popula o $AtPessoa com os novos dados a serem inseridos

			$AtPessoa['Nome'] = $AtualizaNome;
			$AtPessoa['Email'] = $AtualizaEmail;
			$AtPessoa['Cidade'] = $AtualizaCidade;
			$AtPessoa['_id'] = $PegaID;
			$AtPessoa['criadoem'] = $PegaData;



			//Atualiza o Documento com os dados em $AtPessoa

			$pessoas->save($AtPessoa);


		}
		
		//Le a coleção Pessoas algo como SELECT * FROM no SQL.

		$result = $pessoas->find();
	?>

	  <form id="mostradados" name="exibedados" class="form-horizontal" action="atualiza.php" method="post">
		<fieldset>
		<legend>Editando</legend>

		<div class="control-group">
		  <label class="control-label" for="id">ID</label>
		  <div class="controls">
		    <input autocomplete="off" id="pessoaid" value="<?php echo $id; ?>"  name="id" type="text" placeholder="Seu nome" class="input-xlarge" readonly>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="criacao">Data Criação</label>
		  <div class="controls">
		    <input autocomplete="off" id="criacao" value="<?php echo $criado; ?>"  name="criacao" type="text" placeholder="Seu nome" class="input-xlarge" readonly>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="nome">Nome</label>
		  <div class="controls">
		    <input  autocomplete="off" id="nomeid" value="<?php echo $nome; ?>"  name="nome" type="text" placeholder="Seu nome" class="input-xlarge" required>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="email">Email</label>
		  <div class="controls">
		    <input autocomplete="off" id="email" value="<?php echo $email; ?>" name="email" type="email" placeholder="Seu email" class="input-xlarge" required>
		    
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="cidade">Cidade</label>
		  <div class="controls">
		    <input autocomplete="off" id="cidade" value="<?php echo $cidade; ?>" name="cidade" type="text" placeholder="Sua Cidade" class="input-xlarge" required>
		  </div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="singlebutton">Enviar</label>
		  <div class="controls">
		    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Atualizar</button>
		  </div>
		</div>

		</fieldset>
	</form>
	<legend>Exibição dos Dados</legend>

	<table id="dlg" class="table table-striped">
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
