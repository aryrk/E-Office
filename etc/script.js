function Load(){
	window.scrollTo(0, 0);
}
// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("navigation");
var navbar2 = document.getElementById("navigation1");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
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
var card1 = document.getElementById("card1");
document.getElementById("card1").onmouseover = function() {mouseOvercard1()};
document.getElementById("card1").onmouseout = function() {mouseOutcard1()};

var card2 = document.getElementById("card2");
document.getElementById("card2").onmouseover = function() {mouseOvercard2()};
document.getElementById("card2").onmouseout = function() {mouseOutcard2()};
	
var card3 = document.getElementById("card3");
document.getElementById("card3").onmouseover = function() {mouseOvercard3()};
document.getElementById("card3").onmouseout = function() {mouseOutcard3()};
	
var card4 = document.getElementById("card4");
document.getElementById("card4").onmouseover = function() {mouseOvercard4()};
document.getElementById("card4").onmouseout = function() {mouseOutcard4()};
	
var button1 = document.getElementById("button1");
var button2 = document.getElementById("button2");
var button3 = document.getElementById("button3");
var button4 = document.getElementById("button4");
	
function mouseOvercard1() {
	card1.classList.add("columnUsed")
	card2.classList.add("columnUnUsed")
	card3.classList.add("columnUnUsed")
	card4.classList.add("columnUnUsed")
	
	button2.classList.add("buttonUsed")
	button3.classList.add("buttonUsed")
	button4.classList.add("buttonUsed");
}

function mouseOutcard1() {
	card1.classList.remove("columnUsed")
	card2.classList.remove("columnUnUsed")
	card3.classList.remove("columnUnUsed")
	card4.classList.remove("columnUnUsed")
	
	button2.classList.remove("buttonUsed")
	button3.classList.remove("buttonUsed")
	button4.classList.remove("buttonUsed");
}
	
function mouseOvercard2() {
	card1.classList.add("columnUnUsed")
	card2.classList.add("columnUsed")
	card3.classList.add("columnUnUsed")
	card4.classList.add("columnUnUsed")
	
	button1.classList.add("buttonUsed")
	button3.classList.add("buttonUsed")
	button4.classList.add("buttonUsed");
}

function mouseOutcard2() {
	card1.classList.remove("columnUnUsed")
	card2.classList.remove("columnUsed")
	card3.classList.remove("columnUnUsed")
	card4.classList.remove("columnUnUsed")
	
	button1.classList.remove("buttonUsed")
	button3.classList.remove("buttonUsed")
	button4.classList.remove("buttonUsed");
}
	
function mouseOvercard3() {
	card1.classList.add("columnUnUsed")
	card2.classList.add("columnUnUsed")
	card3.classList.add("columnUsed")
	card4.classList.add("columnUnUsed")
	
	button1.classList.add("buttonUsed")
	button2.classList.add("buttonUsed")
	button4.classList.add("buttonUsed");
}

function mouseOutcard3() {
	card1.classList.remove("columnUnUsed")
	card2.classList.remove("columnUnUsed")
	card3.classList.remove("columnUsed")
	card4.classList.remove("columnUnUsed")
	
	button1.classList.remove("buttonUsed")
	button2.classList.remove("buttonUsed")
	button4.classList.remove("buttonUsed");
}
	
function mouseOvercard4() {
	card1.classList.add("columnUnUsed")
	card2.classList.add("columnUnUsed")
	card3.classList.add("columnUnUsed")
	card4.classList.add("columnUsed")
	
	button1.classList.add("buttonUsed")
	button2.classList.add("buttonUsed")
	button3.classList.add("buttonUsed");
}

function mouseOutcard4() {
	card1.classList.remove("columnUnUsed")
	card2.classList.remove("columnUnUsed")
	card3.classList.remove("columnUnUsed")
	card4.classList.remove("columnUsed")
	
	button1.classList.remove("buttonUsed")
	button2.classList.remove("buttonUsed")
	button3.classList.remove("buttonUsed");
}

var ico1 = document.getElementById("ico1");
document.getElementById("fea1").onmouseover = function() {mouseOverIco1()};
document.getElementById("fea1").onmouseout = function() {mouseOutIco1()};

var ico2 = document.getElementById("ico2");
document.getElementById("fea2").onmouseover = function() {mouseOverIco2()};
document.getElementById("fea2").onmouseout = function() {mouseOutIco2()};
	
var ico3 = document.getElementById("ico3");
document.getElementById("fea3").onmouseover = function() {mouseOverIco3()};
document.getElementById("fea3").onmouseout = function() {mouseOutIco3()};
	
var ico4 = document.getElementById("ico4");
document.getElementById("fea4").onmouseover = function() {mouseOverIco4()};
document.getElementById("fea4").onmouseout = function() {mouseOutIco4()};

function mouseOverIco1(){
	ico1.classList.add("FIconHover");
}

function mouseOutIco1(){
	ico1.classList.remove("FIconHover");
}
	
function mouseOverIco2(){
	ico2.classList.add("FIconHover");
}

function mouseOutIco2(){
	ico2.classList.remove("FIconHover");
}
	
function mouseOverIco3(){
	ico3.classList.add("FIconHover");
}

function mouseOutIco3(){
	ico3.classList.remove("FIconHover");
}
	
function mouseOverIco4(){
	ico4.classList.add("FIconHover");
}

function mouseOutIco4(){
	ico4.classList.remove("FIconHover");
}
