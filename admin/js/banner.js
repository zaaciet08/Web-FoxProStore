
//Xóa sản phẩm 
$(document).ready(function () {
    // Khi nút "duyet" được click
    $('.btn_huy').click(function () {
        var abIdToDelete = $(this).data('pro-id');
        // Hiển thị hộp thoại xác nhận SweetAlert
        Swal.fire({
            title: 'Bạn đang thực hiện xóa nội dung này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.isConfirmed) {
                // Gửi dữ liệu bằng Ajax
                $.ajax({
                    type: 'POST',
                    url: 'php/xoanoidung.php', // Đường dẫn đến file xử lý xóa hóa đơn
                    data: { ab_id:  abIdToDelete}, // Truyền order_id cần xóa
                    contentType: 'application/x-www-form-urlencoded',
                    success: function (response) {
                        // Xử lý phản hồi từ duyethoadon.php
                        var result = JSON.parse(response);
                        if (result.status === 'success') {              
                            Swal.fire({
                                icon: 'success',
                                title: 'Đã xóa thành công !',
                                text: result.message,
                            }).then(() => {
                                // Tải lại trang sau khi đóng hộp thoại SweetAlert2
                                location.reload();
                            });
                            
                        } else {
                            // Hiển thị thông báo lỗi nếu xóa không thành công
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: result.message,
                            });
                        }
                    },
                    error: function () {
                        // Hiển thị thông báo lỗi nếu xóa không thành công
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: 'Đã xảy ra lỗi. Vui lòng thử lại.',
                        });
                    }
                });
                
            }
        });
    });
});
// Hàm để chuyển đổi giữa các tab
function changeTab(tabNumber) {
// Ẩn tất cả nội dung tab
var tabContents = document.querySelectorAll('.tab-content');
tabContents.forEach(function (tabContent) {
    tabContent.classList.remove('active');
});

// Hiển thị nội dung của tab được chọn
var selectedTab = document.getElementById('tab' + tabNumber);
selectedTab.classList.add('active');
}

// Đặt lớp active cho tab thứ nhất khi trang được load lại
document.addEventListener('DOMContentLoaded', function () {
changeTab(1);
});
var openModalBtns = document.querySelectorAll(".openModal");

openModalBtns.forEach(function(openModalBtn) {
    openModalBtn.onclick = function() {
        var abIdValue = this.getAttribute("data-pro-id");
        var abTieudeValue = this.getAttribute("data-pro-tieude");
        var abImageValue = this.getAttribute("data-pro-image");
        var abTextValue = this.getAttribute("data-pro-text");

        var modal = document.getElementById("myModal");

        var abIdInput = modal.querySelector("#abTieudeInput");
        var abTextInput = modal.querySelector("#abTextInput");
        var abImageDisplay = modal.querySelector("#abImageDisplay");

        if (abIdInput) {
            abIdInput.value = abTieudeValue;
            abTextInput.value = abTextValue;
            abImageDisplay.textContent = abImageValue;
        }

        if (modal) {
            modal.style.display = "block";
        }
    };
});

// HTML
// <div class="form_update">
//     <label for="abImageInput">Ảnh:</label>
//     <span id="abImageDisplay"></span>
// </div>



var closeModalBtns = document.querySelectorAll(".closeModal");

closeModalBtns.forEach(function(closeModalBtn) {
    closeModalBtn.onclick = function() {
        var modal = document.getElementById("myModal");
        if (modal) {
            modal.style.display = "none";
        }
    };
});

window.onclick = function(event) {
    if (event.target.classList.contains("modal")) {
        var modal = document.getElementById("myModal");
        if (modal) {
            modal.style.display = "none";
        }
    }
};

// Đặt biến imageUrl ở đầu tệp JavaScript
var imageUrl;

function previewImage() {
    var fileInput = document.getElementById('ab_image');
    var imagePreview = document.getElementById('imagePreview');

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            imageUrl = URL.createObjectURL(fileInput.files[0]);
            imagePreview.innerHTML = '<img src="' + imageUrl + '" alt="Ảnh được chọn">';
        };

        reader.readAsDataURL(fileInput.files[0]);
    } else {
        imagePreview.innerHTML = '';
    }
}