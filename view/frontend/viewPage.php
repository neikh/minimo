<?php
	ob_start();
	$title = "Article";
	
	require "view/frontend/lib/lib.php";
?>

<div class="grid-x grid-padding-x" id="contact">
	<div class="large-12 cell">
		<h2><?= $article->post_title(); ?></h2>
		<p class="content">
			<?= $article->post_content(); ?>
		</p>
	</div>
</div>

<div class="grid-x grid-padding-x topMargin botMargin newsletter fullpad">
	<div class="large-12 cell">
		<h2>Vous aimerez peut-être aussi</h2>
	</div>
	
	<?php
		forEach($otherArticles as $otherArticle){
			echo '<div class="large-4 cell mediumColor littleTopMargin padBot">
						<a href="article/'.$otherArticle->id().'/'.sanitize($otherArticle->post_title()).'/">
							<img src="assets/images/'.$otherArticle->post_name().'">
							<p class="littleTopMargin">'.$otherArticle->post_title().'</p>
						</a>
				  </div>';
		}
	?>
	
</div>

<?php
	$content = ob_get_clean();
	require "template.php";