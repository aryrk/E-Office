const visibilityToogle = document.querySelector('.visibility');
const input = document.querySelector('.form-contener');

var password = true;

visibilityToogle.addEventListener('click', function() {
if (password) {
input.setAttribute('type', 'text');
visibilityToogle.innerHTML = 'visibility';
}
else {
input.setAttribute('type', 'password');
visibilityToogle.innerHTML = 'visibility_off';
}
password = !password;
});