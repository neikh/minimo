<?php

	function dateRewritting($date){
		
		$rewrited = 'Le ';
		
		$ymd = explode(" ", $date);
		$fullDate = explode("-", $ymd[0]);
		
		$rewrited .= $fullDate[2]." ".monthToLetter($fullDate[1])." ".$fullDate[0];
		
		return $rewrited;

	}
	
	function monthToLetter($month){
		$month = (int)$month;
		$months = array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
		
		return $months[$month-1];
	}