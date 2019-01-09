<?php
	ob_start();
	$title = "Admin";
	
	require "view/backend/lib/lib.php";
	
	$cats = [];
	
	foreach($articles as $article){
		$cats[$article->post_category()][$article->id()] = $article->post_title();
	}
?>

<div class="grid-x grid-padding-x topMargin" id="identification">
	<?php
		foreach($category as $cat){
			echo '<div class="large-4 medium-4 small-4 cell"><table id="'.$cat.'"><thead><tr><th>'.ucfirst($cat).'</th></tr></thead><tbody id="'.$cat.'Element">';
			
			foreach ($cats[$cat] as $key => $c){
				echo '<tr draggable="true" id="'.$key.'"><td>'.$c.'</td></tr>';
			}
			
			echo'</tbody></table></div>';
		}
		
	?>

	<div class="large-4 medium-4 small-4 cell">
		<table>
			<thead>	
				<tr>
					<th>
						<i class="far fa-plus-square bigFont pointer" onclick="createCat(); return false"></i><input type="text" id="addcategory" placeholder="Créer une nouvelle catégorie">
					</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	
</div>

<?php
	require "view/backend/lib/dragAndDrop.php";
	$content = ob_get_clean();
	require "view/backend/template.php";