document.addEventListener('DOMContentLoaded', function() {
const navbar = document.getElementById("navnav");
window.onscroll = (e) => {
 if (window.scrollY > 250) {
 navbar.classList.add("navbarbackground");
 } else {
 navbar.classList.remove("navbarbackground");
 }};



 window.onload = function() {
    const animatedDiv = document.getElementById('animatedDiv');
    animatedDiv.classList.remove('hidden');
};






});

