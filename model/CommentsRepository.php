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

			$q = $this->_db->prepare("SELECT * FROM `comments` WHERE `post_id` = :id");
			$q->bindValue(":id", $id);
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$coms[] = new Comments($data);
			}

			return $coms;
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