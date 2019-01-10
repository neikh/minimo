<?php
	require "view/backend/lib/lib.php";
	
	$cats = [];
	
	foreach($articles as $article){
		$cats[$article->post_category()][$article->id()] = $article->post_title();
	}
	
	foreach($category as $cat){
		echo '<div class="large-4 medium-4 small-4 cell"><table id="'.str_replace(" ", "_", $cat->category_name()).'"><thead><tr><th><input type="text" id="rn'.str_replace(" ", "_", $cat->category_name()).'" class="renameCategory" value="'.ucfirst($cat->category_name()).'" onkeyup="renameCategory('.$cat->id_category().', this.value); return false" DISABLED><span class="right"><i class="fas fa-pencil-alt pointer" onclick="enable(\'rn'.str_replace(" ", "_", $cat->category_name()).'\'); return false"></i>';
		
		if (!isset($cats[$cat->category_name()])){
			echo '&nbsp;&nbsp;&nbsp;<i class="fas fa-trash-alt pointer" onclick="deleteCat(\''.$cat->id_category().'\', \''.$cat->category_name().'\'); return false"></i>';
		}
		
		echo '</span></th></tr></thead><tbody id="'.str_replace(" ", "_", $cat->category_name()).'Element">';
		
		if (isset($cats[$cat->category_name()])){
			foreach ($cats[$cat->category_name()] as $key => $c){
				echo '<tr draggable="true" id="'.$key.'"><td>'.$c.'</td></tr>';
			}
		} else {
			echo '<tr><td class="eCenter">Vide</td></tr>';
		}
		
		echo'</tbody></table></div>';
	}
	
?>

<div class="large-4 medium-4 small-4 cell">
	<table>
		<thead>	
			<tr>
				<th>
					<i class="far fa-plus-square bigFont pointer" onclick="createCat(); return false"></i><input type="text" id="addCategory" placeholder="Créer une nouvelle catégorie">
				</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>