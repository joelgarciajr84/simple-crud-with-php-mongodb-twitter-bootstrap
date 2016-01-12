<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
	// Estabelece uma conexão com o MongoDB -> http://php.net/manual/pt_BR/class.mongoclient.php
	$MongoDBConnection = new MongoClient();

	// Seleciona um banco, caso não exista o MongoDB cria.
	$DB = $MongoDBConnection->selectDB('SimpleCrud');

	//Cria a coleção pessoas(Caso nao exista).
	$pessoas = $DB->pessoas;
