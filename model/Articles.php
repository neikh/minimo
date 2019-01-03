<?php

	class Articles{
		private $_id,
				$_post_date,
				$_post_content,
				$_post_title,
				$_post_status,
				$_post_name,
				$_post_type,
				$_post_category;
			
			
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
		
		public function post_date(){
			return $this->_post_date;
		}
		
		public function post_content(){
			return $this->_post_content;
		}
		
		public function post_title(){
			return $this->_post_title;
		}
		
		public function post_status(){
			return $this->_post_status;
		}
		
		public function post_name(){
			return $this->_post_name;
		}
		
		public function post_type(){
			return $this->_post_type;
		}
		
		public function post_category(){
			return $this->_post_category;
		}
		
		//setters
		
		public function setId($id){
			$id = (int)$id;
			
			if (is_int($id) AND $id > 0){
				$this->_id = $id;
			}
		}
		
		public function setPost_date($post_date){
			$this->_post_date = $post_date;
		}
		
		public function setPost_content($post_content){
			$post_content = (string)$post_content;
			
			if (is_string($post_content)){
				$this->_post_content = $post_content;
			}
		}
		
		public function setPost_title($post_title){
			$post_title = (string)$post_title;
			
			if (is_string($post_title)){
				$this->_post_title = $post_title;
			}
		}
		
		public function setPost_status($post_status){
			$post_status = (string)$post_status;
			
			if (is_string($post_status)){
				$this->_post_status = $post_status;
			}
		}
		
		public function setPost_name($post_name){
			$post_name = (string)$post_name;
			
			if (is_string($post_name)){
				$this->_post_name = $post_name;
			}
		}
		
		public function setPost_type($post_type){
			$post_type = (string)$post_type;
			
			if (is_string($post_type)){
				$this->_post_type = $post_type;
			}
		}
		
		public function setPost_category($post_category){
			$post_category = (string)$post_category;
			
			if (is_string($post_category)){
				$this->_post_category = $post_category;
			}
		}
					
	}