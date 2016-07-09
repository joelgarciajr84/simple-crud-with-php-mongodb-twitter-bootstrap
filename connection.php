<?php
	// Estabelece uma conexão com o MongoDB -> http://php.net/manual/pt_BR/class.mongoclient.php
	$MongoDBConnection = new MongoClient();

	// Seleciona um banco, caso não exista o MongoDB cria.
	$DB = $MongoDBConnection->selectDB('SimpleCrud');

	//Cria a coleção pessoas(Caso nao exista).
	$pessoas = $DB->pessoas;
