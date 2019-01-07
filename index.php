<?php
	require "controller/frontend.php";
	
	try {

		if (isset($_POST['action'])){
			
			if ($_POST['action'] == "loadMoreArticles"){
				$cat = (string)$_POST['cat'];
				
				if (is_string($cat)){
					loadMoreArticles($cat);
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
			} elseif($_POST['action'] == "sendContact"){
				$com = (string)$_POST['com'];
				$name = (string)$_POST['name'];
				$mail = (string)$_POST['mail'];
				
				if (is_string($com) AND is_string($name) AND is_string($mail) AND $name != '' AND $com != '' AND $mail != ''){
					sendContact($com, $name, $mail);
				} else {
					sendContact('','','');
				}
			}
			
		} elseif (isset($_GET['page'])) {
			
			if ($_GET['page'] == "article"){
				$article = (int)$_GET['article'];
				
				if (is_int($article)){
					loadArticle($article);
				}
				
			} elseif ($_GET['page'] == "index"){
				$cat = (string)$_GET['cat'];
				
				if (is_string($cat)){
					loadIndex($cat);
				}
			}  elseif ($_GET['page'] == "legal"){
				
				loadPage('legal');
				
			}  elseif ($_GET['page'] == "contact"){
				
				loadPage('contact');
				
			}
			
		} else {
			
			loadIndex();
		
		}
		
	}  catch (Exception $e){
		echo 'Erreur : ' . $e->getMessage();
	}