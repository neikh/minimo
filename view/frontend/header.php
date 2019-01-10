<div class="grid-x grid-padding-x">
	 <div class="large-4 medium-4 small-4 cell">
		<a href="/">
			<img src="assets/images/logo_minimo.png">
		</a>
	 </div>
	  <div class="large-8 medium-8 small-8 cell">
		<div class="grid-x grid-padding-x">
			<?php
				foreach ($category as $cat){
					echo ' <div class="large-3 medium-3 small-3 cell">
								<p class="menuTitre"><a href="category/'.$cat->category_name().'/">'.$cat->category_name().'</a></p>
							</div>';
				}
			?>
		</div>
	 </div>
</div>