function fade(element) {
    var op = 1;  // initial opacity
    var timer = setInterval(function () {
        if (op <= 0.1){
			element.style.opacity = 0;
            clearInterval(timer);
        }
        element.style.opacity = op;

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
        op += op * 0.1;
    }, 10);
}