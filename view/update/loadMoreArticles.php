<?php

	require "view/frontend/lib/lib.php";
	
	$i = 0;
	forEach ($articles as $article){
	
		if ($i == 0){
			echo '<div class="grid-x grid-padding-x topMargin botMargin visible">
						<div class="large-1 cell"></div>';
						
		}
		
		echo '<div class="large-5 cell">';
		
					if ($article->post_name() != NULL){
						echo '<a href="article/'.$article->id().'/'.sanitize($article->post_title()).'/"><img src="assets/images/'.$article->post_name().'"></a>';
					}
					
					echo'<a href="category/'.$article->post_category().'/">
						<h2>'.$article->post_category().'</h2>
					</a>
					<a href="article/'.$article->id().'/'.sanitize($article->post_title()).'/">
						<h1>'.$article->post_title().'</h1>
						<p class="content">'.substr($article->post_content(), 0, 150).'...</p>
					</a>
				</div>';
				
		if ($i == 1){
			echo '<div class="large-1 cell"></div>
			</div>';
			$i = -1;
		}
		
		$i++;
	}
	
	
	if ($i == 1){
		echo '</div>';
	}