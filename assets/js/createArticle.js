//upload data

var progressBar = document.getElementById("progress");
var loadBtn = document.getElementById("startUpload");
var input = document.getElementById("fileToUpload");

function uploadFile(data){
	xhr = new XMLHttpRequest();
	xhr.open("POST",'index.php',true);
	
	
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			document.getElementById('upload').innerHTML = xhr.response;
			setTimeout(function(){
				window.location.href = "admin/posts/";
			}, 2000);
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
			loadBtn.value = 'Upload en cours';
		}
		xhr.upload.onloadend = function (e) {
			progressBar.value = e.loaded;
			loadBtn.disabled = false;
			loadBtn.value = 'Upload terminé';
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
  saveMyWork();
  progressBar.style.visibility = "visible";
  this.disabled = true;
  this.value = "Uploading...";
  uploadFile(buildFormData());
});

input.onchange = function () {
	var res = this.value.split("\\");
	loadBtn.disabled = false;
	loadBtn.style.visibility = "visible";
	document.getElementById("displayFile").innerHTML = res[2];
};

//save function

var save = window.setInterval(saveMyWork, 10000);

function saveMyWork(state = 0, id = 0) {
	var title = document.getElementById('title');
	var cat = document.getElementById('cat-container');
	var pic = document.getElementById('picture');
	
	
	var data = new Object();
    var nicE = new nicEditors.findEditor('newArticle');
    var html = nicE.getContent().replace(/\"/ig,'&quot;');
	
	xhr = new XMLHttpRequest();
		 
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			var rep = parseInt(xhr.response);
			if (typeof rep == 'number' && rep != 0){
				console.log("yes");
				//window.location.href = "admin/posts/"+rep+"/";
			} else {
				console.log(typeof xhr.response);
			}
			
			document.getElementById('reminder').style.display = "block";
			document.getElementById('reminder').style.opacity = 0;
			setTimeout(function(){
				document.getElementById('reminder').innerHTML = 'Votre article a été sauvegardé automatiquement.';
				unfadeId(document.getElementById('reminder'));
			}, 1000);
			
			setTimeout(function(){
				fade(document.getElementById('reminder'));
			}, 3500);
			
			setTimeout(function(){
				document.getElementById('reminder').style.opacity = 0;
				document.getElementById('reminder').style.display = "none";
			}, 4000);
			
			document.getElementById('saver').innerHTML = xhr.response;
		}
	}

	xhr.open("POST",'index.php',true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.send("action=save&title="+title.value+"&newArticle="+html+"&cat="+cat.value+"&pic="+pic.value+"&state="+state+"&id="+id);
	 
}
