<?php
	ob_start();
	$title = "Accueil";
?>

<div class="grid-x grid-padding-x">
	<div class="large-12 cell">
		<p class="topMargin fullDiv eCenter"><img src="/public/images/<?= $featuredArticle->post_name(); ?>" width="1024"></p>
	</div>
</div>
			
<div class="grid-x grid-padding-x topMargin botMargin">
	<div class="large-1 cell"></div>
	<div class="large-10 cell">
			<h2><?= $featuredArticle->post_category(); ?></h2>
			<h1><?= $featuredArticle->post_title(); ?></h1>
			<p class="content"><?= substr($featuredArticle->post_content(), 0, 350).'...'; ?></p>
			<h2>Leave a comment</h2>
	</div>
	<div class="large-1 cell"></div>
</div>

<?php
	
	$i = 0;
	forEach ($articles as $article){
	
		if ($i == 0){
			echo '<div class="grid-x grid-padding-x topMargin botMargin">
						<div class="large-1 cell"></div>';
						
		}
		
		echo '<div class="large-5 cell">
					<img src="/public/images/'.$article->post_name().'">
					<h2>'.$article->post_category().'</h2>
					<h1>'.$article->post_title().'</h1>
					<p class="content">'.substr($article->post_content(), 0, 150).'...</p>
				</div>';
				
		if ($i == 1){
			echo '<div class="large-1 cell"></div>
			</div>';
			$i = -1;
		}

		$i++;
	}
?>
			
<?php
	$content = ob_get_clean();
	require "template.php";