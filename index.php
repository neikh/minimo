<?php
	require "controller/frontend.php";
	
	try {

		if (isset($_POST['action'])){
			
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
			} elseif($_POST['action'] == "addNewComment"){
				$com = (string)$_POST['com'];
				$name = (string)$_POST['name'];
				$postId = (int)$_POST['postId'];
				
				if (is_string($com) AND is_string($name) AND $name != '' AND $com != '' AND is_int($postId) AND $postId > 0){
					addNewComment($com, $name, $postId);
				} else {
					addNewComment('', '', $postId);
				}
			}
			
		} elseif (isset($_GET['page'])) {
			
			if ($_GET['page'] == "article"){
				$article = (int)$_GET['article'];
				
				if (is_int($article)){
					loadArticle($article);
				}
				
			}
			
		} else {
			
			loadIndex();
		
		}
		
	}  catch (Exception $e){
		echo 'Erreur : ' . $e->getMessage();
	}