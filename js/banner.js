document.addEventListener("DOMContentLoaded", function() {
    const images = document.querySelectorAll(".brand img");
    const leftArrow = document.querySelector(".arrow-left");
    const rightArrow = document.querySelector(".arrow-right");
    let currentIndex = 0;

    function showImage(index) {
        images.forEach((image, i) => {
            if (i === index) {
                image.classList.add("active");
            } else {
                image.classList.remove("active");
            }
        });
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        showImage(currentIndex);
    }

    function previousImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showImage(currentIndex);
    }

    leftArrow.addEventListener("click", previousImage);
    rightArrow.addEventListener("click", nextImage);

    setInterval(nextImage, 3000);
});