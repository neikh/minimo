<?php

	class ArticlesRepository{
		
		private $_db; // Instance de PDO
		
		public function __construct($db)
		{
			$this->setDb($db);
		}
		
		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}
		
		public function getFeaturedArticle($cat)
		{
			$article = '';
			
			if ($cat == "all"){
				$req = "SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, category.category_name, c1.post_name
						FROM `posts` c
						LEFT JOIN category ON c.id_category = category.id_category
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish'
						ORDER BY RAND()
						LIMIT 0,1";
			} else {
				$req = "SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, category.category_name, c1.post_name
						FROM `posts` c
						LEFT JOIN category ON c.id_category = category.id_category
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish' AND category.category_name = '".$cat."'
						ORDER BY RAND()
						LIMIT 0,1";
			}
			
			$q = $this->_db->prepare($req);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$data['post_category'] = $data['category_name'];
				$article = new Articles($data);
			}

			return $article;
		}
		
		public function getListArticles($cat, $offset = 0, $load = 2, $order = "DESC")
		{
			$articles = [];
			
			if ($cat == "all"){
				$req = "SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, c1.post_name, category.category_name
						FROM `posts` c
						LEFT JOIN category ON c.id_category = category.id_category
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish' 
						ORDER BY c.`post_date` ".$order."
						LIMIT ".$offset.", ".$load;
						
			} else {
				$req = "SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, c1.post_name, category.category_name
						FROM `posts` c
						LEFT JOIN category ON c.id_category = category.id_category
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish'  AND category.category_name = '".$cat."'
						ORDER BY c.`post_date` ".$order."
						LIMIT ".$offset.", ".$load;
			}
			
			$q = $this->_db->prepare($req);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$data['post_category'] = $data['category_name'];
				$articles[] = new Articles($data);
				if(!isset($_SESSION['loadedArticle'])){
					$_SESSION['loadedArticle'] = 0;
				}
				$_SESSION['loadedArticle']++;
				
			}

			return $articles;
		}
		
		public function getOtherArticles($id)
		{
			$articles = [];

			$q = $this->_db->prepare("SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, category.category_name, c1.post_name
						FROM `posts` c
						LEFT JOIN category ON c.id_category = category.id_category
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish' AND c.id <> :id
						LIMIT 0,3");
						
			$q->bindValue(":id", $id);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$data['post_category'] = $data['category_name'];
				$articles[] = new Articles($data);
			}

			return $articles;
		}
		
		public function getArticle($id)
		{
			$articles;

			$q = $this->_db->prepare("SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, category.category_name, c1.post_name
						FROM `posts` c
						LEFT JOIN category ON c.id_category = category.id_category
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish' AND c.id = :id
						LIMIT 0,1");
						
			$q->bindValue(":id", $id);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$data['post_category'] = $data['category_name'];
				$articles = new Articles($data);
			}

			return $articles;
		}
		
		public function getPage($title)
		{
			$articles;

			$q = $this->_db->prepare("SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, category.category_name, c1.post_name
						FROM `posts` c
						LEFT JOIN category ON c.id_category = category.id_category
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'page' AND c.`post_status` = 'publish' AND c.post_title = :title
						LIMIT 0,1");
						
			$q->bindValue(":title", $title);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$data['post_category'] = $data['category_name'];
				$articles = new Articles($data);
			}

			return $articles;
		}
		
		public function getPopularArticles(){
			$articles = [];
			
			$i = 0;
			$q = $this->_db->prepare("SELECT posts.id, posts.post_title, COUNT(comments.post_id) AS nb_com FROM `posts`, comments WHERE comments.post_id = posts.id GROUP BY comments.post_id ORDER BY nb_com DESC LIMIT 0,3");
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$articles[$i]['id'] = $data['id'];
				$articles[$i]['title'] = $data['post_title'];
				$articles[$i]['nb_com'] = $data['nb_com'];
				$i++;
			}

			return $articles;
		}
		
		public function moveArticle($id, $cat){
			$q = $this->_db->prepare("UPDATE `posts` SET `id_category` = :cat WHERE `id` = :id");
			$q->bindValue(":id", $id);
			$q->bindValue(":cat", $cat);
			$q->execute();
			
			return "done";
		}
		
		public function saveArticle($titre, $article, $cat_id){
			$titre_alt = str_replace(" ","_", $titre);
			
			$q = $this->_db->prepare("INSERT INTO `posts` (`id`, `post_author`, `post_date`, `post_content`, `post_title`, `post_status`, `post_name`, `post_type`, `id_category`) VALUES (NULL, 1, NOW(), :article, :titre, 'publish', :titre_alt, 'article', :id)");
			$q->bindValue(":article", $article);
			$q->bindValue(":titre", $titre);
			$q->bindValue(":titre_alt", $titre_alt);
			$q->bindValue(":id", $cat_id);
			$q->execute();
			
			return $this->_db->lastInsertId();
		}
		
		public function saveFile($pic, $title){
			
			$title = "Image principale pour l'article ".$title;
			
			$q = $this->_db->prepare("INSERT INTO `posts` (`id`, `post_author`, `post_date`, `post_content`, `post_title`, `post_status`, `post_name`, `post_type`, `id_category`) VALUES (NULL, 1, NULL, '', :title, 'publish', :pic, 'file', NULL)");
			$q->bindValue(":title", $title);
			$q->bindValue(":pic", $pic);
			$q->execute();
			
			return $this->_db->lastInsertId();
		}
		
		public function linking($id1, $id2){
			
			$q = $this->_db->prepare("INSERT INTO `posts_posts` (`post_id1`, `post_id2`) VALUES (:id1, :id2)");
			$q->bindValue(":id1", $id1);
			$q->bindValue(":id2", $id2);
			$q->execute();
			
			return "Done";
		}
		
		public function updateArticle($titre, $article, $cat_id, $id){
			$q = $this->_db->prepare("UPDATE `posts` SET `id_category` = :cat_id, `post_title` = :titre, `post_content` = :article WHERE `id` = :id");
			$q->bindValue(":id", $id);
			$q->bindValue(":cat_id", $cat_id);
			$q->bindValue(":titre", $titre);
			$q->bindValue(":article", $article);
			$q->execute();
			
			return "done";
		}

	}