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
		
		public function getCategory($cat = ''){
			
			if ($cat == ''){
				$cats = [];
				$q = $this->_db->prepare("SELECT * FROM `category`");
				$q->execute();

				while ($data = $q->fetch(PDO::FETCH_ASSOC))
				{
					$cats[] = new Category($data);
				}
				
			} else {
				$cats = '';
				$q = $this->_db->prepare("SELECT * FROM `category` WHERE `category`.`category_name` = :name ORDER BY `category`.`category_name` ASC");
				$q->bindValue(":name", $cat);
				$q->execute();

				while ($data = $q->fetch(PDO::FETCH_ASSOC))
				{
					$cats = new Category($data);
				}
			}
			

			return $cats;
		}
		
		public function addCategory($cat){
			
			$q = $this->_db->prepare("INSERT INTO `category` (`id_category`, `category_name`) VALUES (NULL, :cat)");
			$q->bindValue(":cat", $cat);
			$q->execute();
			
			return "done";
		}
		
		public function delCategory($cat){
			
			$q = $this->_db->prepare("DELETE FROM `category` WHERE `category`.`id_category` = :cat");
			$q->bindValue(":cat", $cat);
			$q->execute();
			
			return "done";
		}
		
		public function renameCategory($id, $name){
			
			$q = $this->_db->prepare("UPDATE `category` SET `category_name` = :name WHERE `category`.`id_category` = :id");
			$q->bindValue(":name", $name);
			$q->bindValue(":id", $id);
			$q->execute();
			
			return "done";
		}
	}