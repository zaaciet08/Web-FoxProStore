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
    <link rel="stylesheet" href="css/hoadon.css">
    <link rel="stylesheet" href="css/menu.css">
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
    <h2 class="title"><i class="fa-regular fa-rectangle-list"></i>&ensp;Quản lý thông tin đơn hàng</h2>
    <main class="container">
        
    <div class="tabs">
        <div class="tab" onclick="changeTab(1)">Đơn hàng chưa được xác nhận</div>
        <div class="tab" onclick="changeTab(2)">Đơn hàng đã được xác nhận</div>
    </div>

    <div class="tab-content" id="tab1">
    
    <div class="products">
            <?php 

echo '<table>'; 
$chuaduyet = 'Đang xử lý';
// Chuẩn bị truy vấn SQL để lấy thông tin từ bảng tbl_order
$sql = "SELECT * FROM tbl_order WHERE order_status = ?";
// Sử dụng prepared statement với bind_param để tránh SQL injection
$stmt = $conn->prepare($sql);
// Kiểm tra lỗi prepared statement
if ($stmt === false) {
    die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
}
// Thiết lập giá trị cho biến tham số trong prepared statement
$stmt->bind_param("s", $chuaduyet);
$stmt->execute();
// Lấy kết quả
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // In thông tin ra table
    echo '<tr>';
    echo '    <th>Mã đơn</th>';
    echo '    <th>Người nhận</th>';
    echo '    <th>Địa chỉ</th>';
    echo '    <th>Số lượng</th>';
    echo '    <th>Tổng tiền</th>';
    echo '    <th>Thời gian</th>';
    echo '    <th>Trạng thái</th>';
    echo '    <th>Thao tác</th>';
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
            echo'    <td>'.$row['order_status'].'</td>';
            if($row['order_status'] == $kiemduyet){
                ?>
            <form id="deleteForm" action="hoadon.php" method="post">
                <td><a href="chitiethoadon.php?order_id=<?php echo $row['order_id']?>"><i
                            class="fa-solid fa-eye btn_xem"></i></a> <button type="button" name="btn_duyet"
                        class="btn_duyet" id="btn_duyet" data-order-id="<?php echo $row['order_id']; ?>"><i
                            class="fa-solid fa-check"></i></button></td>

                </tr>
            </form>
            <?php
            } else {
                ?>
            <form id="deleteForm" action="quanlyhoadon.php" method="post">
                <td><a href="chitiethoadon.php?order_id=<?php echo $row['order_id']?>"><i
                            class="fa-solid fa-eye btn_xem"></i></a> <button type="button" name="btn_huy"
                        class="btn_huy" id="btn_huy" data-order-id="<?php echo $row['order_id']; ?>"><i
                            class="fa-solid fa-circle-xmark"></i></button></td>
                            
                </tr>
            </form>
            <?php
            }
        }
    }
} else {
    ?>
    <tr>
        <th>Mã đơn</th>
        <th>Người nhận</th>
        <th>Địa chỉ</th>
        <th>Số lượng</th>
        <th>Tổng tiền</th>
        <th>Thời gian</th>
        <th>Trạng thái</th>
        <th>Thao tác</th>
        </tr>
            <tr>
                <th colspan="8">Khách hàng chưa thực hiện thanh toán nào !</th>
            </tr>
            <?php
}
echo '</table>';
?>
        </div>
    </div>
    <div class="tab-content" id="tab2">
    <div class="products">
            <?php 

echo '<table>'; 
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
    // In thông tin ra table
    echo '<tr>';
    echo '    <th>Mã đơn</th>';
    echo '    <th>Người nhận</th>';
    echo '    <th>Địa chỉ</th>';
    echo '    <th>Số lượng</th>';
    echo '    <th>Tổng tiền</th>';
    echo '    <th>Thời gian</th>';
    echo '    <th>Trạng thái</th>';
    echo '    <th>Thao tác</th>';
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
            echo'    <td>'.$row['order_status'].'</td>';
            if($row['order_status'] == $kiemduyet){
                ?>
            <form id="deleteForm" action="hoadon.php" method="post">
                <td><a href="chitiethoadon.php?order_id=<?php echo $row['order_id']?>"><i
                            class="fa-solid fa-eye btn_xem"></i></a> <button type="button" name="btn_duyet"
                        class="btn_duyet" id="btn_duyet" data-order-id="<?php echo $row['order_id']; ?>"><i
                            class="fa-solid fa-check"></i></button></td>

                </tr>
            </form>
            <?php
            } else {
                ?>
            <form id="deleteForm" action="quanlyhoadon.php" method="post">
                <td><a href="chitiethoadon.php?order_id=<?php echo $row['order_id']?>"><i
                            class="fa-solid fa-eye btn_xem"></i></a> <button type="button" name="btn_huy"
                        class="btn_huy" id="btn_huy" data-order-id="<?php echo $row['order_id']; ?>"><i
                            class="fa-solid fa-circle-xmark"></i></button></td>
                </tr>
            </form>
            <?php
            }
        }
    }
} else {
    ?>
    <tr>
        <th>Mã đơn</th>
        <th>Người nhận</th>
        <th>Địa chỉ</th>
        <th>Số lượng</th>
        <th>Tổng tiền</th>
        <th>Thời gian</th>
        <th>Trạng thái</th>
        <th>Thao tác</th>
        </tr>
            <tr>
                <th colspan="8">Khách hàng chưa thực hiện thanh toán nào !</th>
            </tr>
            <?php
}
echo '</table>';
?>
        </div>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/hoadon.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>