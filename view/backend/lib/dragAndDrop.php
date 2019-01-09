<script>
<?php
		foreach($category as $cat){
		?>
		
			var <?= $cat; ?>= document.querySelector('#<?= $cat; ?>');
			var <?= $cat.'Element'; ?>= document.querySelector('#<?= $cat; ?>');
			
			<?= $cat; ?>.addEventListener('dragover', function(e) {
				e.preventDefault(); // Annule l'interdiction de drop
			});
			
			<?= $cat; ?>.addEventListener('dragenter', function() {
				<?= $cat; ?>.style.borderStyle = 'solid';
			});
			
			<?= $cat; ?>.addEventListener('dragleave', function() {
				<?= $cat; ?>.style.borderStyle = 'dotted';
			});
			
			document.addEventListener('dragend', function() {
				//console.log("Un Drag & Drop vient de se terminer mais l'événement dragend ne sait pas si c'est un succès ou non.");
			});
			
			<?= $cat; ?>.addEventListener('drop', function(e) {
				e.preventDefault(); // Cette méthode est toujours nécessaire pour éviter une éventuelle redirection inattendue
				//console.log(e.dataTransfer.getData('text/plain'));
				
				var response = "<tr draggable='true' id='"+e.dataTransfer.getData('text/plain')+"'>"+document.getElementById(e.dataTransfer.getData('text/plain')).innerHTML+"</tr>";
				
				
				
				xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function()
				{
					if(xhr.readyState == 4 && xhr.status == 200)
					{
						document.getElementById('identification').innerHTML = xhr.response;
					}
				}
				
				xhr.open("POST",'index.php',true);
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhr.send("action=moveArticles&id="+e.dataTransfer.getData('text/plain')+"&cat="+this.id);
				
				var element = document.getElementById(e.dataTransfer.getData('text/plain'));
				element.parentNode.removeChild(element);
				
				if (<?= $cat.'Element'; ?>.innerHTML != ''){
					<?= $cat.'Element'; ?>.innerHTML += response;
				} else {
					<?= $cat.'Element'; ?>.innerHTML = response;
				}

				<?= $cat; ?>.style.borderStyle = 'dotted';
			});
			
		<?php
			foreach ($cats[$cat] as $key => $c){
		?>
		
			document.querySelector("[id='<?= $key ?>']").addEventListener('dragstart', function(e) {
				e.dataTransfer.setData("Text/plain", e.target.id);
			});
			
		<?php
			}
			
		}
		
	?>

</script>