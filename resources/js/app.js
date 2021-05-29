const axios = require('axios').default;

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

/**
 * FORM
 */
 const successDiv = document.getElementById('success-div');
 const errorsDiv = document.getElementById('errors-div');
 const errors = document.getElementById('errors');
 const submitBtn = document.getElementById('submit');
 const firstname = document.getElementById('first_name');
 const lastname = document.getElementById('last_name');
 const email = document.getElementById('email');
 const phone = document.getElementById('phone');
 const message = document.getElementById('message');

 submitBtn.addEventListener('click', function() {
	submitBtn.innerHTML = 'Odesíláme';
	errorsDiv.style.display = 'none';
	successDiv.style.display = 'none';
	axios
		.post('/api/mail', {
			form_first_name: firstname.value,
			form_last_name: lastname.value,
			form_email: email.value,
			form_phone: phone.value,
			form_message: message.value,
		})
		.then(function(response) {
			// handle success
			submitBtn.innerHTML = 'Odeslat';
			successDiv.style.display = 'block';
			// reset form
			firstname.value = "";
			lastname.value = "";
			email.value = "";
			phone.value = "";
			message.value = "";
		})
		.catch(function(error) {
			// handle error
			submitBtn.innerHTML = 'Odeslat';
			var arr = error.response.data;
			var err = '';
			for (let el in arr) {
				if (arr.hasOwnProperty(el)) {
					err = err + '<li>' + arr[el] + '</li>';
				}
			}
			errors.innerHTML = err;
			errorsDiv.style.display = 'block';
			//console.log(error.response.data);
			//console.log(error);
		});
});

