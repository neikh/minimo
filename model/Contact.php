<?php

	class Contact{
		private $_id,
				$_contact_name,
				$_contact_email,
				$_contact_message,
				$_contact_date;
				
				
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
			return $this->_id;
		}
		
		public function contact_name(){
			return $this->_contact_name;
		}
		
		public function contact_email(){
			return $this->_contact_email;
		}
		
		public function contact_message(){
			return $this->_contact_message;
		}
		
		public function contact_date(){
			return $this->_contact_date;
		}
		
		//setters
		public function setId($id){
			$id = (int)$id;
			
			if (is_int($id) AND $id > 0){
				$this->_id = $id;
			}
		}
		
		public function setContact_name($name){
			$name = (string)$name;
			
			if (is_string($name)){
				$this->_contact_name = $name;
			}
		}
		
		public function setContact_email($email){
			$email = (string)$email;
			
			if (is_string($email)){
				$this->_contact_email = $email;
			}
		}
		
		public function setContact_message($message){
			$message = (string)$message;
			
			if (is_string($message)){
				$this->_contact_message = $message;
			}
		}
		
		public function setContact_date($date){
			$this->_contact_date = $date;
		}
		
	
	}