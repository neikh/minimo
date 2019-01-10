function enable(id){
	if (document.getElementById(id).disabled == true){
		var inputs = document.getElementsByTagName("INPUT");
		for (var i = 0; i < inputs.length; i++) {

			if (inputs[i].id != 'addCategory'){
				inputs[i].disabled = true;
			}
		}
		document.getElementById(id).disabled = false;
	} else {
	}
}

bkLib.onDomLoaded(function(){

	  new nicEditor({fullPanel : true}).panelInstance('newArticle');

});

