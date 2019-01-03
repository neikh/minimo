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
		
		public function getFeaturedArticle($id)
		{
			$article = '';

			$q = $this->_db->prepare("SELECT * FROM `posts` LEFT JOIN posts_posts ON posts.id = posts_posts.post_id1 WHERE `post_type` = 'article' AND `post_status` = 'publish' AND posts.id = :id LIMIT 0,1");
			$q->bindValue(":id", $id);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$data['post_name'] = $this->getPicture($data['post_id2']);
				$article = new Articles($data);
			}

			return $article;
		}
		
		public function getListArticles($offset = 0, $load = 2)
		{
			$articles = [];

			$q = $this->_db->prepare("SELECT * FROM `posts` LEFT JOIN posts_posts ON posts.id = posts_posts.post_id1 WHERE `post_type` = 'article' AND `post_status` = 'publish' LIMIT ".$offset.", ".$load);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$data['post_name'] = $this->getPicture($data['post_id2']);
				$articles[] = new Articles($data);
			}

			return $articles;
		}
		
		public function getPicture($id)
		{
			$article = "";

			$q = $this->_db->prepare("SELECT `post_name`  FROM `posts`, posts_posts WHERE posts.id = posts_posts.post_id2 AND `post_type` = 'file' AND posts.id = :id LIMIT 0, 1");
			$q->bindValue(":id", $id);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$article = $data['post_name'];
			}

			return $article;
		}
	}