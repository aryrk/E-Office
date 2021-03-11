const menuToggle = document.querySelector('.menu-toggle input');
const nav = document.querySelector('nav ul');

menuToggle.addEventListener('click', function(){
    nav.classList.toggle('slide');
});


function Allert(){
	Swal.fire({
        title: 'Informasi',
        icon: 'info',
        text: 'Pastikan Meminta Izin Cuti Sebelum Hari H',
        confirmButtonText: "Ya"
	}).then((Answer) => {
        if ( Answer.isConfirmed ){
        }
    })
};
