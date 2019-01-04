<?php
	// On enregistre notre autoload.
	function chargerClasse($classname)
	{
	  require 'model/'.$classname.'.php';
	}
	
	require "config.php";
	
	define("BASE_URL", $url, true);
	define("HOST", $host, true);
	define("BASE", $base, true);
	define("USER", $user, true);
	define("PASSWORD", $password, true);

	spl_autoload_register('chargerClasse');
	
	session_start(); // On appelle session_start() APRÈS avoir enregistré l'autoload.