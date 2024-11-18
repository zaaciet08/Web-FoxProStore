<?php
include '../db/connect.php';

if (isset($_POST['user_id'])) {
    $user_id_to_delete = $_POST['user_id'];

    // Kiểm tra kết nối CSDL
    if (!$conn) {
        echo json_encode(array('status' => 'error', 'message' => 'Lỗi kết nối CSDL.'));
        exit();
    }

    // Bắt đầu giao dịch
    mysqli_begin_transaction($conn);

    try {
        // Sử dụng prepared statement để tránh SQL injection
        $query_accounts = "DELETE FROM tbl_accounts WHERE user_id = ?";
        $stmt_accounts = mysqli_prepare($conn, $query_accounts);

        // Kiểm tra trạng thái prepared statement
        if ($stmt_accounts) {
            // Bind parameter và thực hiện DELETE cho tbl_accounts
            mysqli_stmt_bind_param($stmt_accounts, "i", $user_id_to_delete);
            mysqli_stmt_execute($stmt_accounts);

            // Kiểm tra số dòng bị ảnh hưởng bởi câu lệnh DELETE
            $affected_rows_accounts = mysqli_stmt_affected_rows($stmt_accounts);

            // Nếu câu lệnh DELETE thành công, commit giao dịch
            if ($affected_rows_accounts > 0) {
                mysqli_commit($conn);
                echo json_encode(array('status' => 'success', 'message' => 'Đã xóa thành công.'));
            } else {
                // Nếu không có dòng nào bị ảnh hưởng, rollback giao dịch
                mysqli_rollback($conn);
                echo json_encode(array('status' => 'error', 'message' => 'Người dùng không được xóa.'));
            }

            mysqli_stmt_close($stmt_accounts);
        } else {
            // Nếu có lỗi trong câu lệnh chuẩn bị, rollback giao dịch
            mysqli_rollback($conn);
            echo json_encode(array('status' => 'error', 'message' => 'Đã xảy ra lỗi trong câu lệnh chuẩn bị.'));
        }
    } catch (Exception $e) {
        // Nếu có lỗi ngoại lệ, rollback giao dịch
        mysqli_rollback($conn);
        echo json_encode(array('status' => 'error', 'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()));
    }
} else {
    // Gửi phản hồi về Ajax nếu không có thông tin user_id được chuyển đến
    echo json_encode(array('status' => 'error', 'message' => 'Thiếu thông tin user_id.'));
}
?>
