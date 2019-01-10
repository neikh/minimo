var progressBar = document.getElementById("progress");
var loadBtn = document.getElementById("startUpload");

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

function uploadFile(data){
	xhr = new XMLHttpRequest();
	xhr.open("POST",'index.php',true);
	
	
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			document.getElementById('upload').innerHTML = xhr.response;
		}
	}
	
	if (xhr.upload) {
		xhr.upload.onprogress = function (e) {
			if (e.lengthComputable) {
				progressBar.max = e.total;
				progressBar.value = e.loaded;
				display.innerText = Math.floor((e.loaded / e.total) * 100) + '%';
			}
			
		}
		xhr.upload.onloadstart = function (e) {
			progressBar.value = 0;
			display.innerText = '0%';
			console.log("start");
		}
		xhr.upload.onloadend = function (e) {
			progressBar.value = e.loaded;
			loadBtn.disabled = false;
			loadBtn.innerHTML = 'Start uploading';
		}
		
		xhr.send(data);
	}
	
}

function buildFormData() {
	
	file = document.getElementById('fileToUpload').files[0];
	if(file)
    {
		var fd = new FormData();
		fd.append('pic', file);
	}

console.log(fd);
  return fd;
}

loadBtn.addEventListener("click", function(e) {
  this.disabled = true;
  this.innerHTML = "Uploading...";
  uploadFile(buildFormData());
});

