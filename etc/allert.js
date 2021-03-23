function delete_karyawan(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
})

Toast.fire({
  icon: 'success',
  title: 'Delete successfully'
})
};

function update_absen(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
})

Toast.fire({
  icon: 'success',
  title: 'Update successfully'
})
};

function Login(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
})

Toast.fire({
  icon: 'success',
  title: 'Signed in successfully'
})
};

function Pengumuman(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
})

Toast.fire({
  icon: 'success',
  title: 'Upload successfully'
})
};

function cuti(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
})

Toast.fire({
  icon: 'success',
  title: 'Upload successfully'
})
};

function hapusCuti(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
})

Toast.fire({
  icon: 'success',
  title: 'Delete successfully'
})
};

function terimaCuti(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
})

Toast.fire({
  icon: 'success',
  title: 'Cuti telah diterima'
})
};

function tolakCuti(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
})

Toast.fire({
  icon: 'success',
  title: 'Cuti telah ditolak'
})
};

function deltugas(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
})

Toast.fire({
  icon: 'success',
  title: 'Delete successfully'
})
};

function gantipw(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
})

Toast.fire({
  icon: 'success',
  title: 'Update password successfully'
})
};

function Logout(){
	Swal.fire({
    text: "Yakin ingin keluar?",
	showDenyButton: true,
    confirmButtonText: "Ya",
	denyButtonText: "Batal"
	}).then((Answer) =>{
		if (Answer.isConfirmed){
			location.href="../unused.php?value=logoutad";
		}
	})
};
