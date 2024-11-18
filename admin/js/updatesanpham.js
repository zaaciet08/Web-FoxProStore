
//Xóa sản phẩm 
$(document).ready(function () {
    // Khi nút "duyet" được click
    $('.btn_huy').click(function () {
        var orderIdToDelete = $(this).data('pro-id');
        // Hiển thị hộp thoại xác nhận SweetAlert
        Swal.fire({
            title: 'Bạn đang thực hiện xóa sản phẩm này?',
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
                    url: 'php/xoasanpham.php', // Đường dẫn đến file xử lý xóa hóa đơn
                    data: { pro_id: orderIdToDelete }, // Truyền order_id cần xóa
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
changeTab(2);
});

// Đặt biến imageUrl ở đầu tệp JavaScript
var imageUrl;

function previewImage() {
    var fileInput = document.getElementById('pro_image');
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

