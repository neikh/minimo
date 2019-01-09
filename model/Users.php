<?php

	class Users{
		private $_id,
				$_user_login,
				$_user_pass;
			
			
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
		public function id(){
			return $this->_id();
		}
		
		public function user_login(){
			return $this->_user_login();
		}
		
		public function user_pass(){
			return $this->_user_pass();
		}
		
		//setters
		public function setId($id){
			$id = (int)$id;
			
			if (is_int($id) AND $id > 0){
				$this->_id = $id;
			}			
		}
		
		public function setUser_login($log){
			$log = (string)$log;
			
			if (is_string($log)){
				$this->_user_login = $log;
			}			
		}
		
		public function setUser_pass($pass){
			$pass = (string)$pass;
			
			if (is_string($pass)){
				$this->_user_pass = $pass;
			}			
		}
				
	}