<?php
	ob_start();
	$title = "Admin";
	
	require "view/backend/lib/lib.php";
?>

<div class="grid-x grid-padding-x topMargin botMargin">
	<div class="large-6 cell">
		<table>
			<thead>
				<tr>
					<th colspan="3" class="mediumColor eCenter"><?= $load; ?> Derniers Articles ajoutés</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					forEach ($articles as $article){
						
						echo'<tr>
								<td class="mediumColor">
									<a href="admin/posts/'.$article->id().'/">	
										'.$article->post_title().'
									</a>
								</td>
								<td class="eCenter">
									<a href="admin/category/">
										'.ucfirst($article->post_category()).'
									</a>
								</td>
								<td class="eCenter">
									'.dateRewritting($article->post_date()).'
								</td>
							</tr>';		
					}
				?>
			</tbody>
		</table>
		
	</div>

	<div class="large-6 cell">
		<table>
			<thead>
				<tr>
					<th colspan="2" class="mediumColor eCenter"><?= $load; ?> Derniers Commentaires ajoutés</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					forEach ($coms as $com){
						
						echo'<tr>
								<td class="mediumColor eCenter bold">
									<a href="admin/comments/'.$com['id'].'/">	
										'.ucfirst($com['comment_name']).'
									</a>
								</td>
								<td>
									'.ucfirst(mb_strtolower(mb_substr($com['comment_content'], 0, 35,'UTF-8'),'UTF-8')).'...'.'
									<span class="sub mediumColor">'.dateRewritting($com['comment_date']).' | '.$com['post_title'].'</span>
								</td>
							</tr>';		
					}
				?>
			</tbody>
		</table>
		
	</div>
</div>

<div class="grid-x grid-padding-x topMargin botMargin">
	<div class="large-12 cell">
		<table>
			<thead>
				<tr>
					<th colspan="2" class="mediumColor eCenter"><?= $load; ?> Dernières demandes de contact</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					forEach ($contacts as $contact){
						
						echo'<tr>
								<td class="mediumColor eCenter bold">
									<a href="admin/contact/'.$contact->id().'/">	
										'.ucfirst($contact->contact_name()).'
									</a>
								</td>
								<td>
									'.$contact->contact_message().'
									<span class="sub mediumColor">'.dateRewritting($contact->contact_date()).'</span>
								</td>
							</tr>';		
					}
				?>
			</tbody>
		</table>
		
	</div>
</div>
	<?php
		$content = ob_get_clean();
		require "template.php";