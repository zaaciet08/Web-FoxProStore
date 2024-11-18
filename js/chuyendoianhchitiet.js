$(document).ready(function () {
    // Thêm sự kiện click vào tất cả các ảnh chi tiết
    $('.anhchitiet img').on('click', function () {
        // Lấy đường dẫn ảnh từ thuộc tính data-src
        var imgSrc = $(this).data('src');

        // Thay đổi đường dẫn ảnh trung tâm
        $('.img-container img').attr('src', imgSrc);
    });
});
$(document).ready(function () {
        const anhChitiet = $('.anhchitiet');
        const imgWidth = $('.anhchitiet img').width() + 10; // Width ảnh + khoảng cách giữa các ảnh
        let currentIndex = 0;

        $('.next-btn').click(function () {
            if (currentIndex < anhChitiet.children('img').length - 2) {
                currentIndex++;
                updateSlider();
            }
        });

        $('.prev-btn').click(function () {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        function updateSlider() {
            const translateValue = -currentIndex * imgWidth;
            anhChitiet.css('transform', 'translateX(' + translateValue + 'px)');
        }
    });
    