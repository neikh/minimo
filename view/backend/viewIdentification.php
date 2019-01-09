<?php
	ob_start();
	$title = "Admin";
	
	require "view/backend/lib/lib.php";
?>

<div class="grid-x grid-padding-x" id="identification">
	<div class="large-4 medium-4 small-4 cell"></div>
	
	<div class="large-4 medium-4 small-4 cell">
		<a href="/">
			<img src="assets/images/logo_minimo.png">
		</a>
		
		<p class="topMargin">
			<input type="text" id="login" placeholder="Identifiant">
		</p>
		
		<p>
			<input type="password" id="pass" placeholder="Mot de passe">
		</p>
		
		<p class="eCenter">
			<input type="button" value="Connexion" onclick="login(); return false">
		</p>
		
	</div>
	
	<div class="large-4 medium-4 small-4 cell"></div>
</div>

<?php
	$content = ob_get_clean();
	require "view/backend/templateSober.php";