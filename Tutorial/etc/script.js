function Load(){
	window.scrollTo(0, 0);
}

window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navigation");
var navbar2 = document.getElementById("navigation1");

var sticky = navbar.offsetTop;


var count = 0;
function myFunction() {
	if (window.pageYOffset > sticky) {
		navbar.classList.add("sticky")
		navbar2.classList.add("navUsed")
	}
	else {
		navbar.classList.remove("sticky")
		navbar2.classList.remove("navUsed");
	}
}