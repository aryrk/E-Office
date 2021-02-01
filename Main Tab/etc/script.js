const menuToggle = document.querySelector('.menu-toggle input');
const nav = document.querySelector('nav ul');

menuToggle.addEventListener('click', function(){
    nav.classList.toggle('slide');
});

function Allert(){
	Swal.fire({
	icon: "warning",
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
