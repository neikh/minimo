<?php
	ob_start();
	$title = "Accueil";
	
	require "view/frontend/lib/lib.php";
?>

<div class="grid-x grid-padding-x">
	<div class="large-12 cell">
	    <a href="article/<?= $featuredArticle->id().'/'.sanitize($featuredArticle->post_title()) ?>/">
			<p class="fullDiv eCenter"><img src="assets/images/<?= $featuredArticle->post_name(); ?>" width="100%"></p>
		</a>
	</div>
</div>
			
<div class="grid-x grid-padding-x topMargin botMargin">
	<div class="large-1 cell"></div>
	<div class="large-10 cell">
	<a href="category/<?= $featuredArticle->post_category(); ?>/"><h2><?= $featuredArticle->post_category(); ?></h2></a>
		<a href="article/<?= $featuredArticle->id().'/'.sanitize($featuredArticle->post_title()) ?>/">
			<h1><?= $featuredArticle->post_title(); ?></h1>
			<p class="content"><?= substr($featuredArticle->post_content(), 0, 350).'...'; ?></p>
			<h2>Leave a comment</h2>
		</a>
	</div>
	<div class="large-1 cell"></div>
</div>

<?php
	
	$i = 0;
	$c = 0;
	forEach ($articles as $article){
	
		if ($i == 0){
			echo '<div class="grid-x grid-padding-x topMargin botMargin">
						<div class="large-1 cell"></div>';
						
		}
		
		echo '<div class="large-5 cell">
					<a href="article/'.$article->id().'/'.sanitize($article->post_title()).'/">
						<img src="assets/images/'.$article->post_name().'">
					</a>
					<a href="category/'.$article->post_category().'/">
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
		
		$c++;
		$i++;
	}
	
	if ($i == 1){
		echo '</div>';
	}
?>


<div class="grid-x grid-padding-x newsletter fullpad" id="news">
	<div class="large-2 cell"></div>
	
	<div class="large-8 cell">
		<p class="eCenter">Inscrivez-vous à notre newsletter !</p>
		
		<?php
			//required pattern="\A[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9]*.(?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\z"
		?>
			
		<p class="eCenter">
				<input type="email" id="mail" placeholder="Entrez une adresse e-mail valide"/><i class="fas fa-play float pointer" onclick="subscribeNewsletter(document.getElementById('mail').value); return false"></i>
		</p>
	</div>
	
	<div class="large-2 cell"></div>
</div>


<div id="articles"></div>


<div class="grid-x grid-padding-x">
	<div class="large-12 cell">
		<p class="eCenter">
			<?php
				echo '<a href="#" class="button fullPad" onclick="articleLoader(\''.$cat.'\'); return false">Load more</a>';
			?>
		</p>
	</div>
</div>
<?php
	$content = ob_get_clean();
	require "template.php";