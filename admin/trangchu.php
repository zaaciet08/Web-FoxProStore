<?php
  include_once 'db/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fox Pro</title>
    <link rel="apple-touch-icon" sizes="57x57" href="../assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="../assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="../assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="../assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="../assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="../assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="../assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/logo.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="../assets/img/logo.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../ssets/img/logo.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/logo.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/logo.png" />
    <link rel="manifest" href="../assets/favicon/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="../assets/img/logo.png" />
    <meta name="theme-color" content="#ffffff" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/reset.css" />
    <link rel="stylesheet" href="../assets/css/home-responsive.css" />
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/trangchu.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
</head>

<body>
    <!-- Header -->
    <?php include 'view/menu.php' ?>
    <!-- Container -->
    
    <?php 
    $daduyet = 'Đã duyệt';
    
    // Chuẩn bị truy vấn SQL để lấy thông tin từ bảng tbl_order
    $sql = "SELECT * FROM tbl_order WHERE order_status = ?";
    
    // Sử dụng prepared statement với bind_param để tránh SQL injection
    $stmt = $conn->prepare($sql);
    
    // Kiểm tra lỗi prepared statement
    if ($stmt === false) {
        die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
    }
    
    // Thiết lập giá trị cho biến tham số trong prepared statement
    $stmt->bind_param("s", $daduyet);
    $stmt->execute();
    
    // Lấy kết quả
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Tạo biến để lưu tổng số tiền và tổng số sản phẩm
        $total_price = 0;
        $total_num = 0;

        // Lặp qua các đơn hàng đã duyệt
        while ($row = $result->fetch_assoc()) {
            $order_id = $row['order_id'];

            // Truy vấn để lấy tổng số tiền từ tbl_invoicedetails
            $total_query = "SELECT SUM(inv_tongtien) AS total_price FROM tbl_invoicedetails WHERE order_id = ?";
            $total_stmt = $conn->prepare($total_query);
            $total_stmt->bind_param("i", $order_id);
            $total_stmt->execute();
            $total_result = $total_stmt->get_result();

            // Truy vấn để lấy tổng số sản phẩm từ tbl_invoicedetails
            $total_soluong_query = "SELECT SUM(inv_soluong) AS total_num FROM tbl_invoicedetails WHERE order_id = ?";
            $total_soluong_stmt = $conn->prepare($total_soluong_query);
            $total_soluong_stmt->bind_param("i", $order_id);
            $total_soluong_stmt->execute();
            $total_soluong_result = $total_soluong_stmt->get_result();

            // Nếu có kết quả, cập nhật tổng số tiền và tổng số sản phẩm
            if ($total_result->num_rows > 0 && $total_soluong_result->num_rows > 0) {
                $total_price += $total_result->fetch_assoc()['total_price'];
                $total_num += $total_soluong_result->fetch_assoc()['total_num'];
            }
        }

        // Hiển thị thông tin
        echo '<main class="container">';
        echo '<div class="coin">';
        echo '    <i class="fa-solid fa-coins"></i>';
        echo '    <div class="doanhthu">Doanh thu</div>';
        echo '    <span class="tien">' . number_format($total_price, 0, ',', '.') . 'đ' . '</span>';
        echo '</div>';
        echo '<div class="sanpham">';
        echo '    <i class="fa-solid fa-tag"></i>';
        echo '    <div class="ten">Sản phẩm bán ra</div>';
        echo '    <div class="soluong">' . $total_num . '</div>';
        echo '</div>';
        echo '</main>';
    } else {
        echo '<main class="container">';
        echo '<div class="coin">';
        echo '    <i class="fa-solid fa-coins"></i>';
        echo '    <div class="doanhthu">Doanh thu</div>';
        echo '    <span class="tien">0 đ</span>';
        echo '</div>';
        echo '<div class="sanpham">';
        echo '    <i class="fa-solid fa-tag"></i>';
        echo '    <div class="ten">Sản phẩm bán ra</div>';
        echo '    <div class="soluong">0</div>';
        echo '</div>';
        echo '</main>';
    }
?>

   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/menu.js"></script>
</body>

</html>