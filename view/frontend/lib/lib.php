<?php
	function sanitize($z){
		$z = strtolower($z);
		$z = preg_replace('/[^a-z0-9 -]+/', '', $z);
		$z = str_replace(' ', '-', $z);
		return trim($z, '-');
	}
	
	function initiales($z){
		$words = preg_split("/[\s,_-]+/", $z);
		$acronym = "";

		foreach ($words as $w) {
		  $acronym .= $w[0];
		}
		
		return $acronym;
	}
?>