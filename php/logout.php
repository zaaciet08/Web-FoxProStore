<?php
session_start(); // Đảm bảo rằng session đã được khởi động

// Hủy bỏ tất cả các biến session
$_SESSION = array();

// Hủy bỏ phiên session
session_destroy();

// Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính
header("Location: ../index.php");
exit();
?>
