<?php
	function loadAdmin(){
		if (isset($_SESSION['user'])){
			
			if ($_SESSION['user'] == "admin"){
			
				$articlesRepository = databaseConnect("ArticlesRepository");
				$commentsRepository = databaseConnect("CommentsRepository");
				$contactRepository = databaseConnect("ContactRepository");
				
				
				$load = 10;
				$articles = $articlesRepository->getListArticles('all', 0, $load, 'DESC');
				
				$coms = $commentsRepository->getComments(0);
				
				$contacts =  $contactRepository->getContact($load);
				require "view/backend/viewIndex.php";
			} else {
				
				$message = '<img src="/assets/images/invalid.png" width="250"><br /><br />Seul les utilisateurs ayant les droits d\'administration sont autorisés à se connecter sur cette page.';
			}
			
			
		} else {
			require "view/backend/viewIdentification.php";
		}
	}
	
	function login($login = '', $pass = ''){

		if ($login != '' AND $pass != ''){
			$usersRepository = databaseConnect("UsersRepository");
			
			$user = $usersRepository->connection($login, $pass);
			$user = (string)$user;
			if ($user != ""){
				$message = '<img src="/assets/images/valid.png" width="250"><br /><br />Connexion réussie !';
				$_SESSION['user'] = $user;
				
			} else {
				$message = '<img src="/assets/images/invalid.png" width="250"><br /><br />Vos identifiants sont invalides. Veuillez réessayer.';
			}
		} else {
			$message = '<img src="/assets/images/invalid.png" width="250"><br /><br />Veuillez remplir les champs login et mot de passe avant de valider.';
		}
		require "view/update/connection.php";
	}
	
	function loadDeco(){
		require "view/update/unlink.php";
	}
	
	function loadCat(){
		if (isset($_SESSION['user'])){
			
			if ($_SESSION['user'] == "admin"){
				$articlesRepository = databaseConnect("ArticlesRepository");
				
				$category = $articlesRepository->getCategory();
				$articles = $articlesRepository->getListArticles('all', 0, 300, 'DESC');
	
				require "view/backend/viewCategory.php";
			} else {
				
				$message = '<img src="/assets/images/invalid.png" width="250"><br /><br />Seul les utilisateurs ayant les droits d\'administration sont autorisés à se connecter sur cette page.';
			}
			
		} else {
			require "view/backend/viewIdentification.php";
		}
	}
	
	
	function moveArticles($id, $cat){
		$articlesRepository = databaseConnect("ArticlesRepository");
		
		$moved = $articlesRepository->moveArticle($id, $cat);
		
		$category = $articlesRepository->getCategory();
		$articles = $articlesRepository->getListArticles('all', 0, 300, 'DESC');
		
		require "view/update/moveArticles.php";
	}