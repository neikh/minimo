<?php
	ob_start();
	$title = "Admin";
	
	require "view/backend/lib/lib.php";
?>

<div class="grid-x grid-padding-x topMargin" id="identification">
	<div class="large-9 medium-9 small-9 cell">
		<input type="text" id="title" placeHolder="Titre de l'article">
		<textarea id="newArticle" cols="80" rows="15"></textarea>
	</div>
	
	<div class="large-3 medium-3 small-3 cell" id="upload">
		Select image to upload:
		<input type="file" id="fileToUpload">
		<input type="submit" value="Upload Image" id="startUpload">
		
		<div class="large-12 medium-12 small-12 cell">
			<progress id="progress" value="0"></progress>
			<span id="display"></span>
		</div>
	</div>
	
</div>

<?php
	$content = ob_get_clean();
	require "view/backend/template.php";