window.onload = function() { jam(); }

 function jam() {
  var e = document.getElementById('jam'),
  d = new Date(), h, m, s;
  h = d.getHours();
  m = set(d.getMinutes());
  s = set(d.getSeconds());

  e.innerHTML = h +':'+ m +':'+ s;

  setTimeout('jam()', 1000);
 }

 function set(e) {
  e = e < 10 ? '0'+ e : e;
  return e;
 }

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
	    showDenyButton: true,
        confirmButtonText: "Ya"
	}).then((Answer) => {
        if ( Answer.isConfirmed ){
            location.href="Cuti.html";
        }
    })
};