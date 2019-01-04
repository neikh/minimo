function articleLoader(offset){
	xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			document.getElementById('articles').innerHTML += xhr.response;
			unfade(document.getElementsByClassName('visible'));
		}
	}
	
	xhr.open("POST",'index.php',true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.send("action=loadMoreArticles&offset="+offset);
}

function fade(element) {
    var op = 1;  // initial opacity
    var timer = setInterval(function () {
        if (op <= 0.1){
			element.style.opacity = 0;
            clearInterval(timer);
        }
        element.style.opacity = op;
		console.log(element.style.opacity);
        op -= op * 0.1;
    }, 10);
}


function unfade(element) {

    var op = 0.1;  // initial opacity
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
			element[0].classList.remove("visible");
        }
		
		if (typeof(element[0]) != 'undefined' && element[0] != null)
		{
			element[0].style.opacity = op;
			op += op * 0.1;
		}
		
    }, 10);
}


function unfadeId(element) {
    var op = 0.1;  // initial opacity
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
			element.style.opacity = 1;
        }
        element.style.opacity = op;
		console.log(element.style.opacity);
        op += op * 0.1;
    }, 10);
}

function subscribeNewsletter(mail){
	xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			document.getElementById('news').innerHTML = xhr.response;
			setTimeout(function(){
				fade(document.getElementById('news'));
			}, 2000);
			
			setTimeout(function(){
				document.getElementById('news').innerHTML = '<div class="large-2 cell"></div><div class="large-8 cell"><p class="eCenter">Inscrivez-vous à notre newsletter !</p><p class="eCenter"><input type="email" id="mail" placeholder="Entrez une adresse e-mail valide"/><i class="fas fa-play float" onclick="subscribeNewsletter(document.getElementById(\'mail\').value); return false"></i></p></div><div class="large-2 cell"></div>';
				unfadeId(document.getElementById('news'));
			}, 3000);	
			
		}
	}
	
	xhr.open("POST",'index.php',true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.send("action=subscribeNewsletter&mail="+mail);
}