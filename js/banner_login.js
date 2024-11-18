document.addEventListener("DOMContentLoaded", function() {
    const images = document.querySelectorAll(".brand img");
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

    function autoChangeImage() {
        setInterval(nextImage, 3000);
    }

    autoChangeImage(); // Start automatic image change

    // Optional: Uncomment the following lines if you want to pause the automatic change on hover
    // document.querySelector(".brand").addEventListener("mouseenter", function() {
    //     clearInterval(autoChangeImage);
    // });

    // document.querySelector(".brand").addEventListener("mouseleave", function() {
    //     autoChangeImage();
    // });
});
