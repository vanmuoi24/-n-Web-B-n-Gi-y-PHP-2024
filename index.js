const modal = document.getElementById('modal');
const cart = document.querySelector('.cart');

//
function showModal() {
	modal.classList.remove('hide');
	modal.classList.add('show');
}
function hideModal() {
	modal.classList.remove('show');
	modal.classList.add('hide');
}
function showMyCart() {
	cart.style.right = '0';
	cart.style.animation = 'cartSlideIn .25s linear';
	showModal();
}
function hideMyCart() {
	cart.style.right = '-100%';
	cart.style.animation = 'cartSlideOut .25s linear';
	hideModal();
}
modal.addEventListener('click', (e) => {
	if (e.target === e.currentTarget) {
		hideModal();
		hideMyCart();
	}
});
// *** NAV STICKY
const navbarBottom = document.querySelector('.navbar-bottom');
const backToTop = document.querySelector('.back-to-top');

window.addEventListener('scroll', () => {
	if (window.scrollY > navbarBottom.offsetTop) {
		backToTop.classList.add('active');
		document.querySelector('.navbar-sticky').classList.add('--is-sticky');
	} else {
		backToTop.classList.remove('active');
		document.querySelector('.navbar-sticky').classList.remove('--is-sticky');
	}
});

// *** BACK TO TOP
function handleBackToTop() {
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

// *** ẨN TÌM KIẾM KHI CLICK RA NGOÀI
document.addEventListener('click', function (event) {
	if (event.target.closest('.nb-center__search')) return;
	document.querySelector('.nb-center__search').classList.remove('active');
});
