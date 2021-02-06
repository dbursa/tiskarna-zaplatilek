const hamburger = document.getElementById('hamburger')
const navbar = document.getElementById('mobile-nav')
hamburger.addEventListener('click', hamburgerMenu)
function hamburgerMenu() {
    navbar.classList.toggle('active')    
}
