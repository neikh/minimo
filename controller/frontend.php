<?php
	require "bootstrap.php";
	
	function databaseConnect($dataLoader){ // La fonction databaseConnect permet de créer une instance de Repository
		$db = new PDO('mysql:host='.HOST.';dbname='.BASE, USER, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
		return new $dataLoader($db);
	}
	
	function loadIndex($cat = 'all'){
		$articlesRepository = databaseConnect("ArticlesRepository");
		
		$_SESSION['loadedArticle'] = 0;
		$category = $articlesRepository->getCategory();
		$featuredArticle = $articlesRepository->getFeaturedArticle($cat);
		$articles = $articlesRepository->getListArticles($cat);
		require "view/frontend/viewIndex.php";
	}
	
	function loadMoreArticles($cat){
		$articlesRepository = databaseConnect("ArticlesRepository");
		
		$articleLoaded = $_SESSION['loadedArticle'];
		$articles = $articlesRepository->getListArticles($cat, $_SESSION['loadedArticle']);
		
		if ($articleLoaded == $_SESSION['loadedArticle']){
			$erreur = "Aucun article supplémentaire n'a été trouvé.";
		}
		
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
		
		$category = $articlesRepository->getCategory();
		$article = $articlesRepository->getArticle($id);
		$otherArticles = $articlesRepository->getOtherArticles($id);
		$popularArticles = $articlesRepository->getPopularArticles();
		
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