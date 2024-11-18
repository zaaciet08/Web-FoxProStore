<?php

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "foxprostore");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối không thành công: " . mysqli_connect_error());
}
session_start();
?>