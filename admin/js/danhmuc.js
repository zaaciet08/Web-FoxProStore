
//Xóa sản phẩm 
$(document).ready(function () {
    // Khi nút "duyet" được click
    $('.btn_huy').click(function () {
        var dmIdToDelete = $(this).data('pro-id');
        // Hiển thị hộp thoại xác nhận SweetAlert
        Swal.fire({
            title: 'Bạn đang thực hiện xóa danh mục sản phẩm này?',
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
                    url: 'php/xoadanhmucsanpham.php', // Đường dẫn đến file xử lý xóa hóa đơn
                    data: { dm_id: dmIdToDelete }, // Truyền order_id cần xóa
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





// Lấy tất cả các thẻ a có class "openModal"
var openModalBtns = document.querySelectorAll(".openModal");

// Lặp qua mỗi thẻ a và gán sự kiện onclick
openModalBtns.forEach(function(openModalBtn) {
    openModalBtn.onclick = function() {
        // Lấy giá trị pro_danhmuc từ thuộc tính data-pro-danhmuc
        var proDanhmucValue = this.getAttribute("data-pro-danhmuc");
        var  proInputValue = this.getAttribute("data-pro-name");
        // Lấy modal tương ứng với giá trị pro_danhmuc
        var modal = document.getElementById("myModal");

        // Lấy thẻ input:text trong modal để cập nhật giá trị
        var proDanhmucInput = modal.querySelector("#proDanhmucInput");
        var dmNameInput = modal.querySelector("#dmNameValue");
        // Cập nhật giá trị trong input:text
        if (proDanhmucInput) {
            proDanhmucInput.value = proDanhmucValue;
            dmNameInput.value = proInputValue;
        }

        // Hiển thị modal
        if (modal) {
            modal.style.display = "block";
        }
    };
});

// Lấy tất cả các nút đóng modal có class "closeModal"
var closeModalBtns = document.querySelectorAll(".closeModal");

// Gán sự kiện onclick cho mỗi nút đóng modal
closeModalBtns.forEach(function(closeModalBtn) {
    closeModalBtn.onclick = function() {
        console.log("Đã nhấn");
        // Nếu modal tồn tại, đóng nó
        var modal = document.getElementById("myModal");
            modal.style.display = "none";
    
    };
});

// Khi người dùng nhấn vào bất kỳ đâu ngoài modal, modal sẽ đóng
window.onclick = function(event) {
    if (event.target.classList.contains("modal")) {
        event.target.style.display = "none";
    }
};
