<html>
	<head>
		<meta charset="UTF-8">
		<base href="<?= BASE_URL ?>">
		<link rel="stylesheet" href="assets/css/foundation.css">
		<link rel="stylesheet" href="assets/css/app.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<script src="assets/js/ajax.js"></script>
	</head>
	
	<body class="greyBack" id="admin">
	
		<div class="grid-container fullDiv topMargin botMargin whiteBack fullPadA">
			
			<?php
				require "header.php";
				echo $content;
				require "footer.php";
			?>
			
		</div>
	</body>
	
</html>	
