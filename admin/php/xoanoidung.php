<?php
include '../db/connect.php';

if (isset($_POST['ab_id'])) {
    $ab_id_to_delete = $_POST['ab_id'];

    // Kiểm tra kết nối CSDL
    if (!$conn) {
        echo json_encode(array('status' => 'error', 'message' => 'Lỗi kết nối CSDL.'));
        exit();
    }

    // Sử dụng prepared statement để tránh SQL injection
    $query = "DELETE FROM tbl_bannerabout WHERE ab_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Kiểm tra trạng thái prepared statement
    if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $ab_id_to_delete);
    mysqli_stmt_execute($stmt);

    // Kiểm tra số dòng bị ảnh hưởng bởi câu lệnh UPDATE
    $affected_rows = mysqli_stmt_affected_rows($stmt);

    if ($affected_rows > 0) {
        // Gửi phản hồi về Ajax nếu câu lệnh UPDATE thành công
        echo json_encode(array('status' => 'success', 'message' => 'Nội dung đã được xóa khỏi danh sách.'));
    } else {
        // Không có dòng nào bị ảnh hưởng, có thể do không có thay đổi hoặc order_id không hợp lệ
        echo json_encode(array('status' => 'error', 'message' => 'Danh mục sản phẩm không được xóa.'));
    }

    mysqli_stmt_close($stmt);
} else {
    // Gửi phản hồi về Ajax nếu có lỗi trong câu lệnh chuẩn bị
    echo json_encode(array('status' => 'error', 'message' => 'Đã xảy ra lỗi trong câu lệnh chuẩn bị.'));
}

  
} else {
    // Gửi phản hồi về Ajax nếu không có thông tin order_id được chuyển đến
    echo json_encode(array('status' => 'error', 'message' => 'Thiếu thông tin order_id.'));
}
?>
