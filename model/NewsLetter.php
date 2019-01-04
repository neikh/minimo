<?php

	class NewsLetter{
		private $_id,
				$_newsletter_email;
				
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
		
		public function newsletter_email(){
			return $this->_newsletter_email;
		}

		//setters
		public function setId($id){
			$id = (int)$id;
			
			if (is_int($id) AND $id > 0){
				$this->_id = $id;
			}
		}
		
		public function setNewsletter_email($mail){
			$mail = (string)$mail;
			
			if (is_string($mail)){
				$this->_newsletter_email = $mail;
			}
		}
		
		
	}