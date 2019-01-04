<?php
	require "controller/frontend.php";
	
	try {
		if(isset($_POST['action'])){
			
			if ($_POST['action'] == "loadMoreArticles"){
				$offset = (int)$_POST['offset'];
				
				if (is_int($offset)){
					loadMoreArticles($offset);
				}
			} elseif($_POST['action'] == "subscribeNewsletter"){
				$mail = (string)$_POST['mail'];
				
				if (is_string($mail)){
					subscribeNewsletter($mail);
				}
			}
			
		} elseif (isset($_POST['page'])) {
			
			if ($_POST['page'] == "article"){
				$article = (int)$_POST['article'];
				
				if (is_int($article)){
					loadArticle();
				}
				
			}
			
		} else {
			
			loadIndex();
		
		}
		
	}  catch (Exception $e){
		echo 'Erreur : ' . $e->getMessage();
	}