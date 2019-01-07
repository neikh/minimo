<?php
	ob_start();
	$title = "Article";
	
	require "view/frontend/lib/lib.php";
?>

<div class="grid-x grid-padding-x">
	<div class="large-12 cell">
		<p class="fullDiv eCenter"><img src="assets/images/<?= $article->post_name(); ?>" width="100%"></p>
	</div>
</div>
			
<div class="grid-x grid-padding-x topMargin botMargin">
	<div class="large-1 cell"></div>
	<div class="large-8 cell">
		<a href="category/<?= $article->post_category(); ?>/">
			<h2><?= $article->post_category(); ?></h2>
		</a>
		<h1><?= $article->post_title(); ?></h1>
		<p class="content"><?= $article->post_content(); ?></p>
		
		<div class="menuTitre tameColor bigFont topMargin">
			share &nbsp;&nbsp;
			<i class="fab fa-facebook-f"></i> &nbsp;&nbsp;
			<i class="fab fa-twitter"></i> &nbsp;&nbsp;
			<i class="fab fa-google-plus-g"></i> &nbsp;&nbsp;
			<i class="fab fa-tumblr"></i> &nbsp;&nbsp;
			<i class="fab fa-pinterest"></i> &nbsp;&nbsp;
		</div>

			
	</div>
	<div class="large-3 cell">
		<img src="assets/images/auteur.png">
		<h1 class="littleTopMargin">À propos</h1>
		<p class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed libero enim sed faucibus turpis in. Nam at lectus urna duis convallis convallis. </p>
		<span class="menuTitre tameColor bigFont"> 
			<i class="fab fa-facebook-f"></i> &nbsp;&nbsp;
			<i class="fab fa-instagram"></i> &nbsp;&nbsp;
			<i class="fab fa-pinterest"></i>
		</span>
		
		<h2>Posts Populaires</h2>
		
		<?php
			echo "<ul class='list'>";
				forEach($popularArticles as $popularArticle){
					$com = ($popularArticle['nb_com'] != 1) ? "Commentaires" : "Commentaire";
					
					echo "<li><a href='article/".$popularArticle['id']."/".sanitize($popularArticle['title'])."/'>".$popularArticle['title']."</a>
							<h2>".$popularArticle['nb_com']." ".$com."</h2>
						</li>";
				}
			echo "</ul>";
		?>
		
		<div id="banner_spot"></div>
		
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

<div class="grid-x grid-padding-x topMargin botMargin">
	<div class="large-1 cell"></div>
	<div class="large-10 cell" id="commentsContainer">
		<h2><?= $nbCom;  echo ($nbCom == 1) ? " Commentaire" : " Commentaires"; ?></h2>
			
			<?php
				forEach($coms as $com){
					echo '<div class="grid-x grid-padding-x topMargin botMargin">
								<div class="large-2 small-2 cell eCenter">
									<div class="rounded">
										<div class="vCentered">'.strtoupper(initiales($com->comment_name())).'</div>
									</div>
								</div>
								<div class="large-10 small-10 cell">
									<p class="content bold">'.$com->comment_name().'</p>
									<p class="content">'.$com->comment_content().'</p>
									<h2>Répondre</h2>
								</div>
							</div>';
				}

				echo '<div class="grid-x grid-padding-x topMargin botMargin">
						<div class="large-2 small-2 cell eCenter">
							<div class="rounded">
								<div id="myName" class="vCentered"></div>
							</div>
						</div>
						<div class="large-10 small-10 cell">
							<p class="author">
								<input type="text" id="name" value="" placeholder="Mon nom" onkeyup="myName(this.value); return false">
							</p>
							<p class="comments">
								<input type="text" placeholder="Participez vous aussi à cette fantastique discussion !" onkeyup="addNewComment(this.value, '.$article->id().'); return false">
							</p>
						</div>
					</div>';
			?>
	</div>
	<div class="large-1 cell"></div>
</div>

<?php
	$content = ob_get_clean();
	require "template.php";
