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
    <link rel="stylesheet" href="css/nguoidung.css">
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
    <h2 class="title">Quản lý thông tin khách hàng</h2>
    <main class="container">
    
    <div class="tab-content" id="tab1">
    <div class="products">
            <?php 
echo '<table>'; 
$chuaduyet = 'Đang xử lý';
// Chuẩn bị truy vấn SQL để lấy thông tin từ bảng tbl_order
$sql = "SELECT * FROM tbl_user_info";
// Sử dụng prepared statement với bind_param để tránh SQL injection
$stmt = $conn->prepare($sql);
// Kiểm tra lỗi prepared statement
if ($stmt === false) {
    die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
}
// Thiết lập giá trị cho biến tham số trong prepared statement
$stmt->execute();
// Lấy kết quả
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // In thông tin ra table
    echo '<tr>';
    echo '    <th>Họ tên</th>';
    echo '    <th>Địa chỉ</th>';
    echo '    <th>Giới tính</th>';
    echo '    <th>Ngày sinh</th>';
    echo '    <th>Email</th>';
    echo '    <th>Số điện thoại</th>';
    echo '    <th>Thao tác</th>';
    echo '    </tr>';
    while ($row = $result->fetch_assoc()) {
            echo'    <tr>';
            echo'    <td>'.$row['user_name'].'</td>';
            echo'    <td><i class="fa-solid fa-location-dot"></i> &ensp;'.$row['user_address'].', '.$row['user_ward'].', '.$row['user_distric'].', '.$row['user_province'].'</td>';
            echo'    <td>'.$row['user_sex'].'</td>';
            echo'    <td>'.$row['user_date'].'</td>';
            echo'    <td>'.$row['user_email'].'</td>';
            echo'    <td>'.$row['user_phone'].'</td>';
        ?>
          <form id="deleteForm" action="quanlynguoidung.php" method="post">
                <td><button type="button" name="btn_huy"
                        class="btn_huy" id="btn_huy" data-user-id="<?php echo $row['user_id']; ?>"><i
                            class="fa-solid fa-circle-xmark"></i></button></td>    
                </tr>
            </form>
        <?php 
        }
    }

echo '</table>';
?>
        </div>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/menu.js"></script>
    <script src="js/nguoidung.js"></script>
</body>

</html>