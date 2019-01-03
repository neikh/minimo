<?php
	require "bootstrap.php";
	
	function databaseConnect($dataLoader){ // La fonction databaseConnect permet de créer une instance de PersonnagesRepository
		$db = new PDO('mysql:host=localhost;dbname=minimo', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
		return new $dataLoader($db);
	}
	
	function loadIndex(){
		$articlesRepository = databaseConnect("ArticlesRepository");
		
		$featuredArticle = $articlesRepository->getFeaturedArticle(1);
		$articles = $articlesRepository->getListArticles();
		require "view/frontend/viewIndex.php";
	}