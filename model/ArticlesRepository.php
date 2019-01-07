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
				$req = "SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, c.`post_category`, c1.post_name
						FROM `posts` c
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish'
						ORDER BY RAND()
						LIMIT 0,1";
			} else {
				$req = "SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, c.`post_category`, c1.post_name
						FROM `posts` c
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish' AND c.`post_category` = '".$cat."'
						ORDER BY RAND()
						LIMIT 0,1";
			}
			
			$q = $this->_db->prepare($req);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$article = new Articles($data);
			}

			return $article;
		}
		
		public function getListArticles($cat, $offset = 0, $load = 2)
		{
			$articles = [];
			
			if ($cat == "all"){
				$req = "SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, c.`post_category`, c1.post_name
						FROM `posts` c
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish' 
						LIMIT ".$offset.", ".$load;
						
			} else {
				$req = "SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, c.`post_category`, c1.post_name
						FROM `posts` c
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish'  AND c.`post_category` = '".$cat."'
						LIMIT ".$offset.", ".$load;
			}
			
			$q = $this->_db->prepare($req);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$articles[] = new Articles($data);
				$_SESSION['loadedArticle']++;
			}

			return $articles;
		}
		
		public function getOtherArticles($id)
		{
			$articles = [];

			$q = $this->_db->prepare("SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, c.`post_category`, c1.post_name
						FROM `posts` c
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish' AND c.id <> :id
						LIMIT 0,3");
						
			$q->bindValue(":id", $id);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$articles[] = new Articles($data);
			}

			return $articles;
		}
		
		public function getArticle($id)
		{
			$articles;

			$q = $this->_db->prepare("SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, c.`post_category`, c1.post_name
						FROM `posts` c
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'article' AND c.`post_status` = 'publish' AND c.id = :id
						LIMIT 0,1");
						
			$q->bindValue(":id", $id);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$articles = new Articles($data);
			}

			return $articles;
		}
		
		public function getPage($title)
		{
			$articles;

			$q = $this->_db->prepare("SELECT c.`id`, c.`post_author`, c.`post_date`, c.`post_content`, c.`post_title`, c.`post_status`, c.`post_type`, c.`post_category`, c1.post_name
						FROM `posts` c
						LEFT JOIN posts_posts ON c.id = posts_posts.post_id1
						LEFT JOIN `posts` c1 ON c1.id = posts_posts.post_id2 AND c1.`post_type` = 'file' 
						WHERE c.`post_type` = 'page' AND c.`post_status` = 'publish' AND c.post_title = :title
						LIMIT 0,1");
						
			$q->bindValue(":title", $title);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
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
		
		public function getCategory(){
			$cat = [];
			
			
			$q = $this->_db->prepare("SELECT `post_category` FROM `posts` WHERE `post_category` IS NOT NULL GROUP BY `post_category` ORDER BY `post_category` ASC");
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$cat[] = $data['post_category'];
			}
			
			return $cat;
		}
		
	}