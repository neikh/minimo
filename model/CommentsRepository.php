<?php

	class CommentsRepository{
		
		private $_db; // Instance de PDO
		
		public function __construct($db)
		{
			$this->setDb($db);
		}
		
		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}
		
		public function nbComment($id)
		{
			$com = 0;
			
			$q = $this->_db->prepare("SELECT COUNT(`id`) as nbComment FROM `comments` WHERE `post_id` = :id");
			$q->bindValue(":id", $id);
			$q->execute();
			
			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$com = $data['nbComment'];
			}

			return $com;
		}
		
		public function getComments($id)
		{
			$coms = [];

			if ($id != 0){
				$req = "SELECT * FROM `comments` WHERE `post_id` = :id";
			
				$q = $this->_db->prepare($req);
				$q->bindValue(":id", $id);
				$q->execute();

				while ($data = $q->fetch(PDO::FETCH_ASSOC))
				{
					$coms[] = new Comments($data);
				}

				return $coms;
				
			} else {
				$req = "SELECT `posts`.`id`, `comment_name`, `comment_content`, `comment_date`, `post_title` FROM `comments`, `posts` WHERE `comments`.`post_id` = `posts`.`id` ORDER BY `comment_date` DESC LIMIT 0,10";
				
				$q = $this->_db->prepare($req);
				$q->execute();

				while ($data = $q->fetch(PDO::FETCH_ASSOC))
				{
					$coms[] = $data;
				}

				return $coms;
			}
		}
		
		public function addComment($com, $name, $postId)
		{
			
			$q = $this->_db->prepare("INSERT INTO `comments` (`id`, `post_id`, `comment_name`, `comment_email`, `comment_content`, `comment_date`) VALUES (NULL, :id, :name, NULL, :com, NOW());");
			$q->bindValue(":id", $postId);
			$q->bindValue(":name", $name);
			$q->bindValue(":com", $com);
			$q->execute();

			return 'Commentaire ajouté avec succès !';
			
		}
	}