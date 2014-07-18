<?php 

	// Estabelece uma conexão com o MongoDB -> http://php.net/manual/pt_BR/class.mongoclient.php
	$conexao = new MongoClient();

	// Seleciona um banco, caso não exista o MongoDB cria.
	$banco = $conexao->selectDB('SimpleCrud');

	//Cria a coleção pessoas(Caso nao exista).
	$pessoas = $banco->pessoas;
?>