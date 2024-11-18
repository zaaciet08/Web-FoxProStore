
function submitForm() {
    // Lấy danh sách các ô checkbox được chọn
    var checkboxes = document.querySelectorAll('input[name="selected_products[]"]:checked');

    // Tạo một form ẩn để chứa danh sách các sản phẩm được chọn
    var form = document.createElement('form');
    form.action = 'dathang.php';
    form.method = 'post';

    // Thêm mỗi ô checkbox vào form
    checkboxes.forEach(function (checkbox) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'selected_products[]';
        input.value = checkbox.dataset.cartid;
        form.appendChild(input);
    });

    // Thêm form vào body và submit
    document.body.appendChild(form);
    form.submit();
}
$(document).ready(function () {
    // Hàm cập nhật tổng giá trị
    function updateTotal() {
        var total = 0;
        $('input[name="selected_products[]"]:checked').each(function () {
            var row = $(this).closest('tr');
            var totalPriceCell = row.find('.total_price');
            var totalPrice = parseFloat(totalPriceCell.text().replace(/[^\d]/g, ''));
            total += totalPrice;
        });
        console.log('Total before sending to server:', total);
        // Gửi dữ liệu lên server để xử lý và nhận kết quả
        $.ajax({
            type: 'POST',
            url: 'update_total.php', // Đặt tên file xử lý ở đây
            data: {
                total: total
            },
            success: function (response) {
                // Cập nhật giá trị trên trang
                $('#totalAmount').text(response);
            }
        });
    }

    // Sự kiện khi ô checkbox thay đổi
    $('input[name="selected_products[]"]').change(function () {
        updateTotal();
    });

    // Kích hoạt một lần khi trang được tải
    updateTotal();
});


    