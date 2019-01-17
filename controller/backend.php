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
				$categoryRepository = databaseConnect("CategoryRepository");
				
				$category = $categoryRepository->getCategory();
				$articles = $articlesRepository->getListArticles('all', 0, 300, 'DESC');
				
	
				require "view/backend/viewCategory.php";
			} else {
				
				$message = '<img src="/assets/images/invalid.png" width="250"><br /><br />Seul les utilisateurs ayant les droits d\'administration sont autorisés à se connecter sur cette page.';
			}
			
		} else {
			require "view/backend/viewIdentification.php";
		}
	}
	
	function createCat($newCat = ''){
		$categoryRepository = databaseConnect("CategoryRepository");
		$articlesRepository = databaseConnect("ArticlesRepository");
		
		if ($newCat != ''){
			$categoryRepository->addCategory($newCat);
		}
		
		$category = $categoryRepository->getCategory();
		$articles = $articlesRepository->getListArticles('all', 0, 300, 'DESC');
		
		require "view/update/moveArticles.php";
	}
	
	function deleteCat($delCat = ''){
		$categoryRepository = databaseConnect("CategoryRepository");
		$articlesRepository = databaseConnect("ArticlesRepository");
		
		if ($delCat != ''){
			$categoryRepository->delCategory($delCat);
			
		}
		
		$category = $categoryRepository->getCategory();
		$articles = $articlesRepository->getListArticles('all', 0, 300, 'DESC');
		
		require "view/update/moveArticles.php";
	}
	
	function renameCat($id = '', $name = ''){
		$categoryRepository = databaseConnect("CategoryRepository");
		$articlesRepository = databaseConnect("ArticlesRepository");
		
		if ($id != '' AND $name != ''){
			
			$categoryRepository->renameCategory($id, $name);
	
		}
		
		$category = $categoryRepository->getCategory();
		$articles = $articlesRepository->getListArticles('all', 0, 300, 'DESC');
		require "view/update/moveArticles.php";
	}
	
	
	function moveArticles($id, $cat){
		$articlesRepository = databaseConnect("ArticlesRepository");
		$categoryRepository = databaseConnect("CategoryRepository");
		
		$cat = str_replace("_", " ", $cat);
		$idCat = $categoryRepository->getCategory($cat);

		$moved = $articlesRepository->moveArticle($id, $idCat->id_category());

		$category = $categoryRepository->getCategory();
		$articles = $articlesRepository->getListArticles('all', 0, 300, 'DESC');
		
		require "view/update/moveArticles.php";
	}
	
	function loadPost($article){
		if (isset($_SESSION['user'])){
			
			if ($_SESSION['user'] == "admin"){
				
				$categoryRepository = databaseConnect("CategoryRepository");
				$articlesRepository = databaseConnect("ArticlesRepository");
				
				$category = $categoryRepository->getCategory();
				if ($article != 0){
					unset($_SESSION['temp']);
					$articleToLoad = $articlesRepository->getArticle($article);
					$_SESSION['temp']['title'] = $articleToLoad->post_title();
					$_SESSION['temp']['article'] = $articleToLoad->post_content();
					$_SESSION['temp']['photo']= 'assets/images/'.$articleToLoad->post_name();
					
					$_SESSION['temp']['category'] = $articleToLoad->post_category();
				}
				
				require "view/backend/viewPosts.php";
			} else {
				
				$message = '<img src="/assets/images/invalid.png" width="250"><br /><br />Seul les utilisateurs ayant les droits d\'administration sont autorisés à se connecter sur cette page.';
			}
			
		} else {
			require "view/backend/viewIdentification.php";
		}
	}
	
	function uploadFile($pic){
		
		$target_dir = "assets/images/";
		$target_file = $target_dir . basename($pic["name"]);
		
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		$check = getimagesize($pic["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$erreur = "Votre fichier n'est pas une image.<br />";
			$uploadOk = 0;
		}
		
		
		if (file_exists($target_file)) {
			$erreur = "Le fichier existe déjà.<br />";
			$uploadOk = 0;
		}
		
		if ($pic["size"] > 500000000) {
			$erreur = "Votre fichier est trop gros (500mo max!).<br />";
			$uploadOk = 0;
		}
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$erreur = "Seules les images JPG, JPEG, PNG & GIF sont autorisées.<br />";
			$uploadOk = 0;
		}
		
		if ($uploadOk == 0) {
			
		} else {
			if (move_uploaded_file($pic["tmp_name"], $target_file)) {
				$erreur = "Votre fichier a bien été uploadé.";
				$photo = $target_file;
			} else {
				$erreur = "Il y a eu une erreur en uploadant votre fichier...";
			}
		}
		unset($_FILES);
		require "view/update/uploadFile.php";
	}
	
	function save($title, $article, $cat, $pic, $state, $id){
		
		if ($state == 0){
			$_SESSION['temp']['title'] = trim($title);
			$_SESSION['temp']['article'] = trim($article);
			$_SESSION['temp']['category'] = trim($cat);
		} else {
			
			if ($id == 0){
				$articlesRepository = databaseConnect("ArticlesRepository");
				$categoryRepository = databaseConnect("CategoryRepository");
				
				$category = $categoryRepository->getCategory($cat);
				
				if (!isset($category)){
					$category = $categoryRepository->addCategory($cat);
					$category = $categoryRepository->getCategory($cat);
				}
				
				$pic_tab = explode("/", $pic);
				$pic = $pic_tab[2];
				
				$lastId1 = $articlesRepository->saveArticle($title, $article, $category->id_category());
				$lastId2 = $articlesRepository->saveFile($pic, $title);
				
				$finalInsert = $articlesRepository->linking($lastId1, $lastId2);

				echo $lastId1;
			} else {
				$articlesRepository = databaseConnect("ArticlesRepository");
				$categoryRepository = databaseConnect("CategoryRepository");
				
				$category = $categoryRepository->getCategory($cat);
				
				$lastId1 = $articlesRepository->updateArticle($title, $article, $category->id_category(), $id);
				echo $id;
			}
			
		}
	}