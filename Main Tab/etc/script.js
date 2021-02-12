const menuToggle = document.querySelector('.menu-toggle input');
const nav = document.querySelector('nav ul');

menuToggle.addEventListener('click', function(){
    nav.classList.toggle('slide');
});

function Allert(){
	Swal.fire({
    text: "Yakin ingin keluar?",
	showDenyButton: true,
    confirmButtonText: "Ya",
	denyButtonText: "Batal"
	}).then((Answer) =>{
		if (Answer.isConfirmed){
			location.href="../../index.html";
		}
	})
};

		var myVar;
	function Loading() {
  		myVar = setTimeout(showPage, 1000);
	}

	function showPage() {
  		document.getElementById("loader").style.display = "none";
  		document.getElementById("myDiv").style.display = "block";
	}
	
	function DarkMode() {
		var element = document.body;
   		var wosh = document.getElementById("wosh");
			wosh.volume= 0.5;
			wosh.play(); 
   		element.classList.toggle("darkmode");
	}
	function overview(){
		var element = document.body;
		element.classList.toggle("overview");
	}
	function Hamburger() {
   		var element = document.body;
   		element.classList.toggle("ham");
	}
	function task(){
		var element = document.body;
		element.classList.toggle("tugas");
	}
	function TwoNdTask(){
		var element = document.body;
		element.classList.toggle("TwoNdTugas");
	}
	function ExtendTask(){
		var element = document.body;
		element.classList.toggle("ExtendTugas");
	}
	function MaxTask(){
		var element = document.body;
		element.classList.toggle("MaxTugas");
	}
	function ActivatedTugas(){
		var element = document.body;
		element.classList.toggle("AcTugas");
		
	}
	function avg(){
		window.scrollTo(0,document.body.scrollHeight);
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
  } else {
    navbar.classList.remove("sticky")
	navbar2.classList.remove("navUsed");
  }
}
