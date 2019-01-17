<html>
	<head>
		<meta charset="UTF-8">
		<base href="<?= BASE_URL ?>">
		<link rel="icon" href="assets/images/favicon.ico" />
		<link rel="stylesheet" href="assets/css/foundation.css">
		<link rel="stylesheet" href="assets/css/app.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/auto-complete.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<?php
			if ($title == "Creation d'un article"){
				echo '<script src="assets/js/nicEdit-latest.js"></script>';
				echo '<script src="assets/js/auto-complete.js"></script>';
			}
		?>
		<script src="assets/js/fade.js"></script>
		<script src="assets/js/inside.js"></script>
		
		
	</head>
	
	<?php
		if ($title == "Creation d'un article"){
			echo '<body class="greyBack" id="admin" onbeforeunload="saveMyWork(0, , '.$article.')">';
		} else {
			echo '<body class="greyBack" id="admin">';
		}
	?>
	
		<div class="grid-container fullDiv topMargin botMargin whiteBack fullPadA">
			
			<?php
				require "header.php";
				echo $content;
				require "footer.php";
			?>
			<script src="assets/js/ajax.js"></script>
			<?php
				if ($title == "Creation d'un article"){
					echo '<script src="assets/js/createArticle.js"></script>';
				}
			?>
		</div>
	</body>
	
</html>	
