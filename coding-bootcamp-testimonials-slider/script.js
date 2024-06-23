const next = document.querySelector('.next');
const back = document.querySelector('.back');
const slides = document.querySelectorAll('.slide');

// index=0 to keep strack of current slide
let index = 0;
display(index); 

//function to display the slide based on the index
function display (index) {
	slides.forEach((slide) => {
		slide.style.display = 'none'; //hides all slides
	});

	slides[index].style.display = 'flex'; //displays the slide of current index
}

//function to move onto the next slide
function nextSlide () {
	index++;
	// if index is on last slide then go back to first index index=0)
	if (index > slides.length - 1) {
		index = 0;
	}
	display(index);
}

//function to move to the previous slide
function backSlide () {
	index--;

	// if index is 0 go to last slide
	if (index < 0) {
		index = slides.length - 1;
	}
	display(index);
}

//event listeners to next and back buttons
next.addEventListener('click', nextSlide);
back.addEventListener('click', backSlide);