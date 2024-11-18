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
    <link rel="stylesheet" href="css/repcmt.css">
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
    <h2 class="title"><i class="fa-regular fa-comments"></i> &ensp; Quản lý bình luận </h2>
    <main class="container">
        
        <div class="tab-content" id="tab1">
            <div class="products">
            
            <?php
echo '<table>';
$sql = "SELECT * FROM tbl_comment";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<tr>';
    echo '    <th>Sản phẩm</th>';
    echo '    <th>Tên sản phẩm</th>';
    echo '    <th>Người dùng</th>';
    echo '    <th>Bình luận</th>';
    echo '    <th>Trả lời</th>';
    echo '    <th>Khung chat</th>';
    echo '    <th>Thao tác</th>';
    echo '    </tr>';

    while ($row = $result->fetch_assoc()) {
        $cmt_id =  $row['cmt_id'];
        $pro_id = $row['pro_id'];
        $user_id = $row['user_id'];
        $cmt_cmt = $row['cmt_cmt'];
        
        // Lấy thông tin người dùng
        $user_query = 'SELECT * FROM tbl_user_info WHERE user_id = ?';
        $user_stmt = $conn->prepare($user_query);
        $user_stmt->bind_param('i', $user_id);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result();
        
        // Lấy thông tin sản phẩm
        $pro_query = 'SELECT * FROM tbl_products WHERE pro_id = ?';
        $pro_stmt = $conn->prepare($pro_query);
        $pro_stmt->bind_param('i', $pro_id);
        $pro_stmt->execute();
        $pro_result = $pro_stmt->get_result();

        // Lấy các bình luận trả lời
        $repcmt_query = 'SELECT * FROM tbl_repcmt WHERE cmt_id = ?';
        $repcmt_stmt = $conn->prepare($repcmt_query);
        $repcmt_stmt->bind_param('i', $cmt_id);
        $repcmt_stmt->execute();
        $repcmt_result = $repcmt_stmt->get_result();

        if ($user_result->num_rows > 0 && $pro_result->num_rows > 0) {
            $row_info = $user_result->fetch_assoc();
            $pro_cmt = $pro_result->fetch_assoc();
            echo '<tr>';
            echo '    <td><img src="'.$pro_cmt['pro_image'].'" alt=""></td>';
            echo '    <td>' . $pro_cmt['pro_name'] . '</td>';
            echo '    <td>' . $row_info['user_name'] . '</td>';
            echo '    <td>' . $cmt_cmt . '</td>';
           
            // Hiển thị các bình luận trả lời
            echo '    <td>';
            while ($rep_row = $repcmt_result->fetch_assoc()) {
                echo $rep_row['rep_comment'].'<br>';
            }
            echo '    </td>';
            echo '   <form action="repcmt.php" method="post">';
            echo '    <td><input type="text" name="repcmt" id=""></td>'; 
            echo '    <td>';      
            echo '            <input type="text"  name="cmt_id" value="'.$cmt_id.'" hidden>';
            echo '            <button type="submit" name="btn_add" class="btn_duyet" id="btn_duyet"><i class="fa-solid fa-reply"></i></button>';
            echo '            <button type="submit" name="btn_huy" class="btn_huy" id="btn_huy" data-repcmt-id=""><i class="fa-solid fa-circle-xmark"></i></button>';     
            echo '        </form>';
            echo '    </td>';
            echo '</tr>';
        }
    }
} else {
    echo '<tr><th colspan="7">Không có thông tin sản phẩm!</th></tr>';
}

echo '</table>';
?>
<!-- Modal -->
</div>
</div>
</main>
<?php
if (isset($_POST['btn_add'])) {
    $rep = $_POST['repcmt'];
    $cmt_id = $_POST['cmt_id'];

    // Kiểm tra đầu vào
  if(empty($rep)){
    echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Vui lòng điền câu trả lời vào khung !',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'repcmt.php';
                    });
                </script>";
  }else{
          // Nếu ID danh mục chưa tồn tại, thêm dữ liệu mới
    $insert_query = "INSERT INTO tbl_repcmt (cmt_id, rep_comment) VALUES (?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);

    if ($insert_stmt) {
        mysqli_stmt_bind_param($insert_stmt, "is", $cmt_id, $rep);
        mysqli_stmt_execute($insert_stmt);
        echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã trả lời bình luận thành công!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'repcmt.php';
                    });
                </script>";
    } else {
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Đã xảy ra lỗi!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'repcmt.php';
                    });
                </script>";
    }
  }

   
}
?>
<?php
if (isset($_POST['btn_huy'])) {
    $cmt_id = $_POST['cmt_id'];
    // Kiểm tra đầu vào
     
    // Nếu ID danh mục chưa tồn tại, thêm dữ liệu mới
    $delete_query = "DELETE FROM tbl_repcmt WHERE cmt_id = ?";
    $delete_stmt = mysqli_prepare($conn, $delete_query);

    if ($delete_stmt) {
        mysqli_stmt_bind_param($delete_stmt, "i", $cmt_id);
        mysqli_stmt_execute($delete_stmt);
        echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã xóa trả lời bình luận thành công!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'repcmt.php';
                    });
                </script>";
    } else {
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Đã xảy ra lỗi!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'repcmt.php';
                    });
                </script>";
    }

    mysqli_stmt_close($delete_stmt);
}
?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/repcmt.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>