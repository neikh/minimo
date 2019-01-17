<script>
var my_autoComplete = new autoComplete({
    selector: '#cat-container',
    minChars: 1,
    source: function(term, suggest){
        term = term.toLowerCase();
			<?php
				$trimmer = '';
				echo 'var choices = [';
				foreach ($category as $cat){
					$trimmer .= "'".$cat->category_name()."',";
				}
				echo rtrim($trimmer, ",");
				echo "];";
			?>
		var matches = [];
        for (i=0; i<choices.length; i++){
            if (~choices[i].toLowerCase().indexOf(term)){
				matches.push(choices[i]);
			}
		}
		
		suggest(matches);
	}
});

bkLib.onDomLoaded(function(){

	  new nicEditor({fullPanel : true}).panelInstance('newArticle');

});
</script>