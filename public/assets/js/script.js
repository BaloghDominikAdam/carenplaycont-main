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


// let scroll = window.scrollY;
//     const updateScroll = () => {
//         scroll = window.scrollY / 1.5;
//         document.getElementById("tranc").style.transform = "translateX(-"+scroll+"px)";
//         document.getElementById("tranb").style.transform = "translateX(+"+scroll+"px)";
//         document.getElementById("trana").style.transform = "translateX(-"+scroll+"px)";
//     }
//     setInterval(updateScroll, 1);





});

