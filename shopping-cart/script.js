document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll(".slide-item");
    const totalSlides = slides.length;
    let currentIndex = 0;

    // Function to show a slide
    function showSlide(index) {
        slides.forEach(slide => {
            slide.style.display = "none";
        });
        slides[index].style.display = "block";
    }

    // Function to show next slide
    function showNextSlide() {
        currentIndex++;
        if (currentIndex >= totalSlides) {
            currentIndex = 0;
        }
        showSlide(currentIndex);
    }

    // Auto slide
    setInterval(showNextSlide, 3000); // Change slide every 3 seconds

    // Optional: Add navigation buttons
    
});
