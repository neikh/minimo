<?php

	class CategoryRepository{
		private $_db; // Instance de PDO
		
		public function __construct($db)
		{
			$this->setDb($db);
		}
		
		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}
		
		public function getCategory(){
			$cats = [];
			
			$q = $this->_db->prepare("SELECT * FROM `category`");
			$q->execute();

			while ($data = $q->fetch(PDO::FETCH_ASSOC))
			{
				$cats[] = new Category($data);
			}

			return $cats;
		}
	}