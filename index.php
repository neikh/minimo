<?php
	require "controller/frontend.php";
	
	try {
		
		loadIndex();
		
	}  catch (Exception $e){
		echo 'Erreur : ' . $e->getMessage();
	}