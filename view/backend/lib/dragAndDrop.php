<script>
	function handlers(){
<?php
		foreach($category as $cat){
		?>
			if (document.querySelector('#<?= str_replace(" ", "_", $cat->category_name()); ?>')){
				var <?= str_replace(" ", "_", $cat->category_name()); ?>= document.querySelector('#<?= str_replace(" ", "_", $cat->category_name()); ?>');
			}
			
			if (document.querySelector('#<?= str_replace(" ", "_", $cat->category_name()); ?>')){
				var <?= str_replace(" ", "_", $cat->category_name()).'Element'; ?>= document.querySelector('#<?= str_replace(" ", "_", $cat->category_name()); ?>');
			}
			
			<?= str_replace(" ", "_", $cat->category_name()); ?>.addEventListener('dragover', function(e) {
				e.preventDefault(); // Annule l'interdiction de drop
			});
			
			<?= str_replace(" ", "_", $cat->category_name()); ?>.addEventListener('dragenter', function() {
				<?= str_replace(" ", "_", $cat->category_name()); ?>.style.borderStyle = 'solid';
			});
			
			<?= str_replace(" ", "_", $cat->category_name()); ?>.addEventListener('dragleave', function() {
				<?= str_replace(" ", "_", $cat->category_name()); ?>.style.borderStyle = 'dotted';
			});
			
			document.addEventListener('dragend', function() {
				//console.log("Un Drag & Drop vient de se terminer mais l'événement dragend ne sait pas si c'est un succès ou non.");
			});
			
			<?= str_replace(" ", "_", $cat->category_name()); ?>.addEventListener('drop', function(e) {
				e.preventDefault(); // Cette méthode est toujours nécessaire pour éviter une éventuelle redirection inattendue
				//console.log(e.dataTransfer.getData('text/plain'));
				
				var response = "<tr draggable='true' id='"+e.dataTransfer.getData('text/plain')+"'>"+document.getElementById(e.dataTransfer.getData('text/plain')).innerHTML+"</tr>";
				
				xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function()
				{
					if(xhr.readyState == 4 && xhr.status == 200)
					{
						document.getElementById('identification').innerHTML = xhr.response;
						handlers();
					}
				}
				
				xhr.open("POST",'index.php',true);
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhr.send("action=moveArticles&id="+e.dataTransfer.getData('text/plain')+"&cat="+this.id);
				
				var element = document.getElementById(e.dataTransfer.getData('text/plain'));
				element.parentNode.removeChild(element);
				
				if (<?= str_replace(" ", "_", $cat->category_name()).'Element'; ?>.innerHTML != ''){
					<?= str_replace(" ", "_", $cat->category_name()).'Element'; ?>.innerHTML += response;
				} else {
					<?= str_replace(" ", "_", $cat->category_name()).'Element'; ?>.innerHTML = response;
				}

				<?= str_replace(" ", "_", $cat->category_name()); ?>.style.borderStyle = 'dotted';
			});
			
		<?php
			if (isset($cats[str_replace(" ", "_", $cat->category_name())])){
				foreach ($cats[str_replace(" ", "_", $cat->category_name())] as $key => $c){
		?>
		
				document.querySelector("[id='<?= $key ?>']").addEventListener('dragstart', function(e) {
					e.dataTransfer.setData("Text/plain", e.target.id);
				});
			
		<?php
				}
			}
		}
		
	?>
	}

	handlers();
</script>