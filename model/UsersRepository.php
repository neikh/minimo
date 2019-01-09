<?php
	class UsersRepository{
		private $_db; // Instance de PDO
			
		public function __construct($db)
		{
			$this->setDb($db);
		}
		
		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}
		
		function connection($login, $pass){
			$user = '';
			$q = $this->_db->prepare("SELECT * FROM `users` WHERE `user_login` = :login AND `user_pass` = :pass LIMIT 0,1");
			$q->bindValue(":login", $login);
			$q->bindValue(":pass", $pass);
			$q->execute();
			
			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$user = $data['user_login'];
			}

			return $user;
		}
	}