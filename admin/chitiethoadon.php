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
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/logo.png" />
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
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/home-responsive.css" />
  
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .container_main {
        width: 100%;
        margin: 20px auto;
        background-color: #fff;
       padding-left: 5%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-wrap: wrap; /* Ensure items wrap to the next line if the container is too narrow */
        
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
        vertical-align: middle;
    }

    th {
        background-color: #f2f2f2;
        font-size: 20px;
        font-weight: bold;
    }
    table td:first-child {
    font-weight: 600;
    text-align: right;
    vertical-align: middle;
    font-size: 18px;
}
    .image img {
        max-width: 50px;
        max-height: 50px;
    }

    .info  {
        width: 35%; /* Adjust the width based on your preference */
    }
    
    .info {
        margin-bottom: 20px; /* Add some spacing between sections */
    }
    .products{
      width:  60%;
    }
    h2 {
        font-size: 24px;
      
        text-align: center;
        margin-top: 3%;
        font-weight: bold;
    }
    .btn_huy{
    text-align: center;
    border-radius: 5px;
    font-size: 1em;
    padding: 7px;
    transition-duration: .2s;
    cursor: pointer;
    min-width: 70px;
    border: none;
}
    .btn_huy:hover{
    background-color: #ccc;
    color: #444;
}
.fa-location-dot{
    color: #da3a27;
}
</style>


</head>

<body>
    <!-- Header -->
    
    <!-- Container -->
    <h2 style="font-size: 24px; color:darkgray;">Phiếu mua hàng</h2>
    <div class="container_main">
        <!--======================== Thông tin khách hàng ======================-->
        <div class="info">
            <?php
if(isset($_GET["order_id"])){
    $order_id = $_GET['order_id'];
    $query = "SELECT * FROM tbl_order WHERE order_id = ?" ;
// Sử dụng prepared statement để tránh SQL injection
   $stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    echo '<table>';
    echo '<tr>';
    echo '    <th colspan="2">Thông tin khách hàng</th>';
    echo '</tr>';
    echo '<tr>';
    echo '    <td>Mã đơn</td>';
    echo '    <td>#'.$row['order_code'].'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '    <td>Người nhận</td>';
    echo '    <td>'.$row['order_name'].'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '    <td>Số điện thoại</td>';
    echo '    <td>'.$row['order_phone'].'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '    <td>Địa chỉ</td>';
    echo '    <td><i class="fa-solid fa-location-dot"></i></a> &ensp;'.$row['order_address'].', '.$row['order_ward'].', '.$row['order_distric'].', '.$row['order_province'].'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '    <td>Ngày mua</td>';
    echo '    <td>'.$row['order_date'].'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '   <td>Trạng thái</td>';
    echo '   <td>'.$row['order_status'].'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '   <td></td>';
    echo '   <td><a href="quanlyhoadon.php"><i class="fa-solid fa-right-from-bracket btn_huy"></i></a></td>';
    echo '</tr>';
    }
  }else {
    echo'    <tr>';
    echo'    <th colspan="6">Bạn chưa thực hiện thanh toán nào !</th>';
    echo'    </tr>';
}
 }
 }
?>
            </table>
        </div>
        <!-- ====================== Thông tin đơn hàng ================================ -->
  
        <div class="products">
            <?php
if (isset($_GET["order_id"])) {
    $order_id = $_GET['order_id'];
    $query = "SELECT * FROM tbl_invoicedetails WHERE order_id = ?";
    // Sử dụng prepared statement để tránh SQL injection
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $order_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr>';
            echo '    <th colspan="6">Thông tin sản phẩm</th>';
            echo '</tr>';
            echo '<tr>';
            echo '    <th>Ảnh</th>';
            echo '    <th>Tên</th>';
            echo '    <th>Giá</th>';
            echo '    <th>Số lượng</th>';
            echo '    <th>Thành tiền</th>';
            echo '    <th>Hương vị</th>';
            echo '    </tr>';
            while ($row = $result->fetch_assoc()) {
                $pro_id = $row['pro_id'];
                $total_query = "SELECT * FROM tbl_products WHERE pro_id = ?";
                $total_stmt = $conn->prepare($total_query);
                $total_stmt->bind_param("i", $pro_id);
                $total_stmt->execute();
                $total_result = $total_stmt->get_result();
                
                if ($total_result->num_rows > 0) {
                    
                    $product_info = $total_result->fetch_assoc();
                    $sale = $product_info['pro_gia'] - (($product_info['pro_gia'] * $product_info['pro_giamgia']) / 100);
                    echo '    <tr>';
                    echo '    <td class="image"><a href="chitietsanpham.php?pro_id='.$product_info['pro_id'].'"><img src="' . $product_info['pro_image'] . '" alt=""></a></td>';
                    echo '    <td>' . $product_info['pro_name'] . '</td>';
                    echo '    <td>'.number_format($sale, 0, ',', '.') . 'đ' .'</td>';
                    echo '    <td>' . $row['inv_soluong'] . '</td>';
                    echo '    <td>'.number_format($row['inv_tongtien'], 0, ',', '.') . 'đ' .'</td>';
                    echo '    <td>' . $row['inv_huongvi'] . '</td>';
                    echo '    </tr>';
                }
            }
        }
    }
}
?>
 </table>
        </div>

    </div>