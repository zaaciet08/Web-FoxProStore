<?php
   include'db/conect.php';
// Kiểm tra xem order_id có được gửi từ Ajax không
if (isset($_POST['order_id'])) {
    $order_id_to_delete = $_POST['order_id'];

    // Kiểm tra kết nối CSDL
    if (!$conn) {
        echo json_encode(array('status' => 'error', 'message' => 'Lỗi kết nối CSDL.'));
        exit();
    }

    // Sử dụng prepared statement để tránh SQL injection
    $query = "DELETE FROM tbl_order WHERE order_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Kiểm tra trạng thái prepared statement
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $order_id_to_delete);
        mysqli_stmt_execute($stmt);

        // Kiểm tra xem việc xóa có thành công hay không
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Gửi phản hồi về Ajax nếu xóa thành công
            echo json_encode(array('status' => 'success', 'message' => 'Đơn hàng đã được hủy thành công.'));
        } else {
            // Lấy thông tin lỗi xóa
            echo json_encode(array('status' => 'error', 'message' => 'Không thể xóa đơn hàng. ' . mysqli_error($conn)));
        }

        mysqli_stmt_close($stmt);
    } else {
        // Gửi phản hồi về Ajax nếu có lỗi trong câu lệnh chuẩn bị
        echo json_encode(array('status' => 'error', 'message' => 'Đã xảy ra lỗi trong câu lệnh chuẩn bị.'));
    }

    // Đóng kết nối đến cơ sở dữ liệu
    mysqli_close($conn);
} else {
    // Gửi phản hồi về Ajax nếu không có thông tin order_id được chuyển đến
    echo json_encode(array('status' => 'error', 'message' => 'Thiếu thông tin order_id.'));
}
?>
