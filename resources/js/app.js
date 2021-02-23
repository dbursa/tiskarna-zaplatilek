const hamburger = document.getElementById('hamburger')
const navbar = document.getElementById('mobile-nav')

hamburger.addEventListener('click', hamburgerMenu)
function hamburgerMenu() {
    navbar.classList.toggle('active')    
}

if (document.getElementById('show_more')) {
    const showMore = document.getElementById('show_more');
    const gallery2 = document.getElementById('gallery-2');
    const gallery3 = document.getElementById('gallery-3');
    const gallery4 = document.getElementById('gallery-4');
    const gallery5 = document.getElementById('gallery-5');
    let showingGallery = false;
    
    showMore.addEventListener('click', function () {
        toggleGallery();
    });
    
    function toggleGallery() {
        if (showingGallery){
            gallery2.classList.remove('flex');
            gallery3.classList.remove('flex');
            gallery4.classList.remove('flex');
            gallery5.classList.remove('flex');
    
            gallery2.classList.add('hidden');
            gallery3.classList.add('hidden');
            gallery4.classList.add('hidden');
            gallery5.classList.add('hidden');
            showingGallery = !showingGallery; 
            showMore.innerHTML = 'Zobrazit více';
            return;
        }
        if (!showingGallery){
            gallery2.classList.remove('hidden');
            gallery3.classList.remove('hidden');
            gallery4.classList.remove('hidden');
            gallery5.classList.remove('hidden');
    
            gallery2.classList.add('flex');
            gallery3.classList.add('flex');
            gallery4.classList.add('flex');
            gallery5.classList.add('flex');
            showingGallery = !showingGallery; 
            showMore.innerHTML = 'Zobrazit méně';
            return;
    
        }
    }
}

