<?php
	
	class ContactRepository{
		private $_db; // Instance de PDO
			
		public function __construct($db)
		{
			$this->setDb($db);
		}
		
		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}
		
		public function addContact($com, $name, $mail){
			
			$contact = '';
			
			$req = "INSERT INTO `contact` (`id`, `contact_name`, `contact_email`, `contact_message`, `contact_date`) VALUES (NULL, :name, :mail, :com, NOW())";
			$q = $this->_db->prepare($req);
			$q->bindValue(":name", $name);
			$q->bindValue(":mail", $mail);
			$q->bindValue(":com", $com);
			$q->execute();
			
			return "<img src='/assets/images/valid.png' width='250'><br />Votre message à bien été envoyé.";
		}
	}