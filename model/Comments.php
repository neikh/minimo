<?php

	class Comments{
		private $_id,
				$_post_id,
				$_comment_name,
				$_comment_email,
				$_comment_content,
				$_comment_date;
				
		
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
		
		public function post_id(){
			return $this->_post_id;
		}
		
		public function comment_name(){
			return $this->_comment_name;
		}
		
		public function comment_email(){
			return $this->_comment_email;
		}
		
		public function comment_content(){
			return $this->_comment_content;
		}
		
		public function comment_date(){
			return $this->_comment_date;
		}
		
		//setters
		public function setId($id){
			$id = (int)$id;
			
			if(is_int($id) AND $id > 0){
				$this->_id = $id;
			}
		}
		
		public function setPost_id($id){
			$id = (int)$id;
			
			if(is_int($id) AND $id > 0){
				$this->_post_id = $id;
			}
		}
		
		public function setComment_name($name){
			$name = (string)$name;
			
			if (is_string($name)){
				$this->_comment_name = $name;
			}
		}
		
		public function setComment_email($email){
			$email = (string)$email;
			
			if (is_string($email)){
				$this->_comment_email = $email;
			}
		}
		
		public function setComment_content($content){
			$content = (string)$content;
			
			if	(is_string($content)){
				$this->_comment_content = $content;
			}
		}
		
		public function setComment_date($date){
				$this->_comment_date = $date;
		}
				
	}