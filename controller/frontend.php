<?php
	require "bootstrap.php";
	
	function databaseConnect($dataLoader){ // La fonction databaseConnect permet de créer une instance de Repository
		$db = new PDO('mysql:host='.HOST.';dbname='.BASE, USER, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
		return new $dataLoader($db);
	}
	
	function loadIndex(){
		$articlesRepository = databaseConnect("ArticlesRepository");
		
		$featuredArticle = $articlesRepository->getFeaturedArticle(1);
		$articles = $articlesRepository->getListArticles();
		require "view/frontend/viewIndex.php";
	}
	
	function loadMoreArticles($offset){
		$articlesRepository = databaseConnect("ArticlesRepository");
		
		$articles = $articlesRepository->getListArticles($offset);
		require "view/update/loadMoreArticles.php";
	}
	
	function subscribeNewsletter($mail){
		$newsLetterRepository = databaseConnect("NewsLetterRepository");
		
		if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$message = $newsLetterRepository->addEmail($mail);
		} else {
			$message = '<img src="/assets/images/invalid.png" width="250"><br />Cette chaine ne correspond même pas à une chaine valide, sérieusement...';
		}
		require "view/update/subscribeNewsletter.php";
	}
	
	function loadArticle($id){
		$articlesRepository = databaseConnect("ArticlesRepository");
		$commentsRepository = databaseConnect("CommentsRepository");
		
		$article = $articlesRepository->getFeaturedArticle($id);
		$otherArticles = $articlesRepository->getOtherArticles($id);
		
		$nbCom = $commentsRepository->nbComment($id);
		$coms = $commentsRepository->getComments($id);
		require "view/frontend/viewArticle.php";
	}
	
	function addNewComment($com, $name, $postId){
		$commentsRepository = databaseConnect("CommentsRepository");
		
		if ($com != '' AND $name != ''){
			$addComment = $commentsRepository->addComment($com, $name, $postId);
		} else {
			$addComment = "Erreur. Veuillez bien remplir les champs noms et commentaires.";
		}

		$nbCom = $commentsRepository->nbComment($postId);
		$coms = $commentsRepository->getComments($postId);

		require "view/update/addNewComment.php";
	}