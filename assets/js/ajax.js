function articleLoader(cat){
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
	xhr.send("action=loadMoreArticles&cat="+cat);
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

function addNewComment(com, postId){
	
	var name = document.getElementById("name").value;
 
	if (event.key == "Enter" && !event.shiftKey){
		xhr = new XMLHttpRequest();
		 
		xhr.onreadystatechange = function()
		{
			if (xhr.readyState == 4 && xhr.status == 200)
			{
				document.getElementById('commentsContainer').innerHTML = xhr.response;
			}
		}
		 
		xhr.open("POST",'index.php',true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send("action=addNewComment&com="+com+"&name="+name+"&postId="+postId);
	}
}

function myName(name){
	if (name != ''){
		initiales = name.match(/\b\w/g).join('').toUpperCase();
		document.getElementById('myName').innerHTML = initiales;
	} else {
		document.getElementById('myName').innerHTML = '';
	}
		
}

function sendContact(){
	xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200){
			
			document.getElementById('contact').innerHTML = xhr.response;
			setTimeout(function(){
				fade(document.getElementById('contact'));
			}, 2000);
			
			setTimeout(function(){
				document.getElementById('contact').innerHTML = '<div class="large-12 cell"><h2>Contact</h2><p class="content"><p class="author"><input type="text" id="name" value="" placeholder="Mon nom"></p><p class="mail"><input type="text" id="mail" value="" placeholder="Mon mail"></p><p class="comments"><input type="text" id="com" placeholder="Mon message"></p><p class="eCenter"><input type="button" value="Envoyer mon message" onclick="sendContact(); return false"></p></p></div>';
				unfadeId(document.getElementById('contact'));
			}, 3000);
			
		}
	}
	
	var name = document.getElementById("name").value;
	var mail = document.getElementById("mail").value;
	var com = document.getElementById("com").value;
	
	xhr.open("POST",'index.php',true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.send("action=sendContact&com="+com+"&name="+name+"&mail="+mail);
}

function login(){
	xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200){
			document.getElementById('identification').innerHTML = xhr.response;
			setTimeout(function(){
				fade(document.getElementById('identification'));
			}, 2000);
			
			setTimeout(function(){
				window.location.href = "admin/";
			}, 3000);
		}
	}
	
	var login = document.getElementById("login").value;
	var pass = document.getElementById("pass").value;
	
	xhr.open("POST",'index.php',true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.send("action=login&login="+login+"&pass="+pass);
}

function createCat(){
	xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200){
			document.getElementById('identification').innerHTML = xhr.response;
			window.location.href = "admin/category/";
		}
	}
	
	var newCat = document.getElementById("addCategory").value;
	
	xhr.open("POST",'index.php',true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.send("action=createCat&cat="+newCat);
}

function deleteCat(cat){
	xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200){
			document.getElementById('identification').innerHTML = xhr.response;
			window.location.href = "admin/category/";
		}
	}
	
	xhr.open("POST",'index.php',true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.send("action=deleteCat&cat="+cat);
}

function renameCategory(id, newName){
 
	if (event.key == "Enter"){
		xhr = new XMLHttpRequest();
		 
		xhr.onreadystatechange = function()
		{
			if (xhr.readyState == 4 && xhr.status == 200)
			{
				document.getElementById('identification').innerHTML = xhr.response;
				window.location.href = "admin/category/";
			}
		}
		 
		xhr.open("POST",'index.php',true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send("action=renameCategory&id="+id+"&newName="+newName);
	}
}


