<?php
	class Category{
		private $_id_category,
				$_category_name;
				
		public function __construct(array $data)
		{
			$this->hydrate($data);
		}
		
		public function hydrate(array $data)
		{
			foreach ($data as $key => $value)
			{
				$method = 'set'.ucfirst($key);

				if (method_exists($this, $method))
				{
					$this->$method($value);
				}
			}
		}
				
		//getters
		public function id_category(){
			return $this->_id_category;
		}
		
		public function category_name(){
			return $this->_category_name;
		}
		
		//setters
		public function setId_category($id){
			$id = (int)$id;
			
			if (is_int($id) AND $id > 0){
				$this->_id_category = $id;
			}
		}
		
		public function setCategory_name($name){
			$name = (string)$name;
			
			if (is_string($name)){
				$this->_category_name = $name;
			}
		}
	}