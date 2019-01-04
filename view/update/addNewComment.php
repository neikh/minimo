<?php
	require "view/frontend/lib/lib.php";
?>
<h2><?= $nbCom;  echo ($nbCom == 1) ? " Commentaire" : " Commentaires"; ?></h2>
			
			<?php
				forEach($coms as $com){
					echo '<div class="grid-x grid-padding-x topMargin botMargin">
								<div class="large-2 small-2 cell eCenter">
									<div class="rounded">
										<div class="vCentered">'.strtoupper(initiales($com->comment_name())).'</div>
									</div>
								</div>
								<div class="large-10 small-10 cell">
									<p class="content bold">'.$com->comment_name().'</p>
									<p class="content">'.$com->comment_content().'</p>
									<h2>Répondre</h2>
								</div>
							</div>';
				}
		
				echo '<div class="grid-x grid-padding-x topMargin botMargin">
						<div class="large-12 small-12 cell">
							<p class="eCenter bold">'.$addComment.'</p>
						</div>
						
						<div class="large-2 small-2 cell eCenter">
							<div class="rounded">
								<div id="myName" class="vCentered"></div>
							</div>
						</div>
						<div class="large-10 small-10 cell">
							<p class="author">
								<input type="text" id="name" value="" placeholder="Mon nom" onkeyup="myName(this.value); return false">
							</p>
							<p class="comments">
								<input type="text" placeholder="Participez vous aussi à cette fantastique discussion !" onkeyup="addNewComment(this.value, '.$postId.'); return false">
							</p>
						</div>
					</div>';