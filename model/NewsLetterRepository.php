<?php

	class NewsLetterRepository{
		
		private $_db; // Instance de PDO
		
		public function __construct($db)
		{
			$this->setDb($db);
		}
		
		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}
		
		public function addEmail($email)
		{

			$myMail = $this->isExist($email);
			
			if ($myMail == 0){
				$q = $this->_db->prepare("INSERT INTO `newsletter` (`id`, `newsletter_email`) VALUES (NULL, :mail)");
				$q->bindValue(":mail", $email);
				$q->execute();

				return '<img src="assets/images/valid.png" width="250"><br />Inscription réussie !';
			} else {
				return '<img src="assets/images/invalid.png" width="250"><br />Cet email est déjà inscrit !';
			}
		}
		
		public function isExist($email)
		{
			$testMail = 0;
			
			$q = $this->_db->prepare("SELECT `id` FROM `newsletter` WHERE `newsletter_email` = :mail");
			$q->bindValue(":mail", $email);
			$q->execute();
			
			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$testMail = 1;
			}

			return $testMail;
		}
	}