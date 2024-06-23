const imageCollection = document.querySelectorAll(".image");
const imageViewer = document.querySelector(".image-viewer");
const previewImg = imageViewer.querySelector("img");
const closeBtn = imageViewer.querySelector(".close");
const currentImg = imageViewer.querySelector(".current-img");
const totalImg = imageViewer.querySelector(".total-img");
const overlay = document.querySelector(".overlay");

// Initialize variables for tracking current and clicked image indices
let currentIndex = 0;
let clickedIndex = 0;

// Function to update preview with clicked image details
function preview(index) {
    currentIndex = index;
    currentImg.textContent = index + 1;
    const imageURL = imageCollection[index].querySelector("img").src;
    previewImg.src = imageURL;
    updateNavigationButtons();
}

// Function to update navigation buttons visibility based on the current index
function updateNavigationButtons() {
    const prevBtn = document.querySelector(".prev");
    const nextBtn = document.querySelector(".next");
    prevBtn.style.display = currentIndex === 0 ? "none" : "block";
    nextBtn.style.display = currentIndex === imageCollection.length - 1 ? "none" : "block";
}

// Add click event listener to each image in the collection
imageCollection.forEach((image, index) => {
    totalImg.textContent = imageCollection.length;
    image.onclick = () => {
        clickedIndex = index;
        preview(index);

        // Disable scrolling on the body and show image viewer
        document.body.style.overflow = "hidden";
        imageViewer.classList.add("show");
        overlay.style.display = "block";
    };
});

// Add click event listener for the previous button
document.querySelector(".prev").onclick = () => {
    if (currentIndex > 0) {
        preview(currentIndex - 1);
    }
};

// Add click event listener for the next button
document.querySelector(".next").onclick = () => {
    if (currentIndex < imageCollection.length - 1) {
        preview(currentIndex + 1);
    }
};

// Add click event listener for the close icon
closeBtn.onclick = () => {
    currentIndex = clickedIndex;
    updateNavigationButtons();
    imageViewer.classList.remove("show");
    overlay.style.display = "none";
    document.body.style.overflow = "scroll";
};


