<?php
	ob_start();
	$title = "Creation d'un article";
	
	require "view/backend/lib/lib.php";
?>

<div id="reminder" class="eCenter bold"></div>

<div class="grid-x grid-padding-x topMargin">
	<div class="large-9 medium-9 small-9 cell">
		<input type="text" id="title" placeHolder="Titre de l'article" value="<?php if (isset($_SESSION['temp']['title'])){ echo $_SESSION['temp']['title']; } ?>">
		<input type="text" id="cat-container" placeHolder="catégorie de l'article" value="<?php if (isset($_SESSION['temp']['category'])){ echo $_SESSION['temp']['category']; } ?>">
		<textarea id="newArticle" cols="80" rows="15">
			<?php
				if (isset($_SESSION['temp']['article'])){
					echo $_SESSION['temp']['article'];
				}
			?>
		</textarea>
	</div>
	
	<div class="large-3 medium-3 small-3 cell eCenter" id="upload">
		<?php
			if (isset($_SESSION['temp']['photo'])){
				echo '<img src='.$_SESSION['temp']['photo'].'>';
				echo '<input type="hidden" id="picture" value="'.$_SESSION['temp']['photo'].'">';
			} else {
				echo '<input type="hidden" id="picture" value="">';
			}
		?>
		<label for="fileToUpload" class="label-file">Choisir une image de couverture</label>
		<input id="fileToUpload" class="input-file" type="file">
		<input type="submit" value="Upload" id="startUpload" DISABLED>
		
		<div class="large-12 medium-12 small-12 cell eCenter">
			<div id="displayFile"></div>
			<progress id="progress" value="0"></progress><br />
			<span id="display"></span>
		</div>
	</div>
	
</div>

<div class="grid-x grid-padding-x littleTopMargin">
	<div class="large-12 medium-12 small-12 cell eCenter">
		<input type="submit" value="Sauvegarder" onclick="saveMyWork(1, <?= $article; ?>); return false">
		<div id="saver"></div>
	</div>
</div>
<?php
	$content = ob_get_clean();
	require "view/backend/template.php";
	require "view/backend/lib/autoComplete.php";
	
	