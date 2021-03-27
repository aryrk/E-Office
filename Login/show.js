const visibilityToogle = document.querySelector('.visibility');
const input = document.querySelector('.form-contener input');
const input1 = document.querySelector('.fai input');

var password = true;

visibilityToogle.addEventListener('click', function() {
if (password) {
input.setAttribute('type', 'text');
input1.setAttribute('type', 'text');
visibilityToogle.innerHTML = 'visibility';
}
else {
input.setAttribute('type', 'password');
input1.setAttribute('type', 'password');
visibilityToogle.innerHTML = 'visibility_off';
}
password = !password;
});

//repeat 

