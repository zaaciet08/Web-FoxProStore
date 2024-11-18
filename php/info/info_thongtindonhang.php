

<?php 

echo '<table>'; 
// Lấy user_id từ phiên đăng nhập
$user_id = $_SESSION["user_id"];
// Chuẩn bị truy vấn SQL để lấy thông tin từ bảng tbl_user_info
$sql = "SELECT * FROM tbl_order WHERE user_id = ?";
// Sử dụng prepared statement
$stmt = $conn->prepare($sql);
// Kiểm tra lỗi prepared statement
if ($stmt === false) {
    die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
}
// Sử dụng bind_param với kiểu dữ liệu phù hợp
$stmt->bind_param("i", $user_id);
// Thực hiện truy vấn
$stmt->execute();
// Lấy kết quả
$result = $stmt->get_result();
$ngayDatHang = date('Y-m-d');
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $order_id = $_GET["delete"];

    $sql = "DELETE FROM tbl_order WHERE order_id='$order_id'";
    
    $conn->query($sql);
   
}
if ($result->num_rows > 0) {
    // In thông tin ra table
    echo '<tr>';
    echo '    <th colspan="6">Ngày: '.$ngayDatHang.'</th>';
    echo '</tr>';
    echo '<tr>';
    echo '    <th>Mã đơn</th>';
    echo '    <th>Người nhận</th>';
    echo '    <th>Địa chỉ</th>';
    echo '    <th>Số lượng</th>';
    echo '    <th>Tổng tiền</th>';
    echo '    <th>Thời gian</th>';
    echo '    </tr>';
    $kiemduyet = 'Đang xử lý';
    // In thông tin ra table
   
    while ($row = $result->fetch_assoc()) {
        // Lấy thông tin từ bảng tbl_invoicedetails
        $order_id = $row['order_id'];
        $total_query = "SELECT SUM(inv_tongtien) AS total_price FROM tbl_invoicedetails WHERE order_id = ?";
        $total_stmt = $conn->prepare($total_query);
        $total_stmt->bind_param("i", $order_id);
        $total_stmt->execute();
        $total_result = $total_stmt->get_result();

        $total_soluong = "SELECT SUM(inv_soluong) AS total_num FROM tbl_invoicedetails WHERE order_id = ?";
        $total_stmtt = $conn->prepare($total_soluong);
        $total_stmtt->bind_param("i", $order_id);
        $total_stmtt->execute();
        $total_resultt = $total_stmtt->get_result();
        if ($total_result->num_rows > 0 && $total_resultt->num_rows > 0) {
            $total_data = $total_result->fetch_assoc();
            $total_price = $total_data['total_price'];
            $total_dataa = $total_resultt->fetch_assoc();
            $total_num = $total_dataa['total_num'];
            echo'    <input type="text" value="'. $row['order_id'].'" name="orderid" hidden>';
            echo'    <tr>';
            echo'    <td>#'.$row['order_code'].'</td>';
            echo'    <td>'.$row['order_name'].'</td>';
            echo'    <td><i class="fa-solid fa-location-dot"></i> &ensp;'.$row['order_address'].', '.$row['order_ward'].', '.$row['order_distric'].', '.$row['order_province'].'</td>';
            echo'    <td>'.$total_num.'</td>';
            echo'    <td>'.number_format($total_price, 0, ',', '.') . 'đ' .'</td>';
            echo'    <td>'.$row['order_date'].'</td>';
            echo'    </tr>';
            echo'    <tr>';
            echo'    <th colspan="3">Thao tác: </th>';
            
            if($row['order_status'] == $kiemduyet){

                ?>
                <form id="deleteForm" action="info.php" method="post">
                <th><a href="chitiethoadon.php?order_id=<?php echo $row['order_id']?>"><i class="fa-solid fa-eye btn_xem"></i></a></th>
                <th><button type="button" name="btn_huy" class="btn_huy" id="btn_huy" data-order-id="<?php echo $row['order_id']; ?>"><i class="fa-solid fa-circle-xmark"></i></button></th>
                <th><?php echo $row['order_status']; ?></th>
                </tr>
                </form>
                <?php
            } else {
                ?>
                <th><a href="chitiethoadon.php?order_id=<?php echo $row['order_id']?>"><i class="fa-solid fa-eye btn_xem"></i></a></th>
                <th></th>
                <th><?php echo $row['order_status']; ?></th>
                </tr>
                <?php
            }
        }
    }
} else {
    ?>
    <tr>
    <th colspan="6">Bạn chưa thực hiện thanh toán nào !</th>
    </tr>
    <?php
}
echo '</table>';
?>

<!--============================ Xóa sản phẩm ==================================-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function () {
        // Khi nút "Hủy" được click
        $('.btn_huy').click(function () {
            var orderIdToDelete = $(this).data('order-id');

            // Hiển thị hộp thoại xác nhận SweetAlert
            Swal.fire({
                title: 'Bạn có muốn hủy đơn hàng này?',
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
                        url: 'xoahoadon.php', // Đường dẫn đến file xử lý xóa hóa đơn
                        data: { order_id: orderIdToDelete }, // Truyền order_id cần xóa
                        contentType: 'application/x-www-form-urlencoded',
                        success: function (response) {
                            // Xử lý phản hồi từ xoa_hoa_don.php
                            var result = JSON.parse(response);

                            if (result.status === 'success') {
                                // Hiển thị thông báo xóa thành công
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Đã hủy đơn',
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
</script>