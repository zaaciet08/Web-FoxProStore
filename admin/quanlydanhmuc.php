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
    <link rel="stylesheet" href="css/danhmuc.css">
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
    <h2 class="title">Quản lý danh mục sản phẩm</h2>
    <main class="container">

        <div class="tab-content" id="tab1">
            <div class="products">
                <?php 
echo '<table>'; 
$sql = "SELECT * FROM tbl_danhmuc";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
}
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    // In thông tin ra table
    echo '<tr>';
    echo '    <th>ID</th>';
    echo '    <th>Danh mục</th>';
    echo '    <th>Thao tác</th>';
    echo '    </tr>';
    while ($row = $result->fetch_assoc()) {
            echo'    <tr>';
            echo'    <td>'.$row['pro_danhmuc'].'</td>';
            echo'    <td>'.$row['dm_name'].'</td>';
                ?>

                <form id="deleteForm" action="quanlydanhmuc.php" method="post">
                    <td>
                        <a class="openModal" href="#" data-pro-danhmuc="<?php echo $row['pro_danhmuc']; ?> "
                            data-pro-name="<?php echo $row['dm_name']; ?> "><i
                                class="fa-solid fa-pen-to-square btn_xem"></i></a>
                        <button type="button" name="btn_huy" class="btn_huy" id="btn_huy"
                            data-pro-id="<?php echo $row['pro_danhmuc']; ?>">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </td>
                </form>
                <?php
        }
        }
 else {
    ?>
                <tr>
                    <th colspan="8">Không có thông tin sản phẩm!</th>
                </tr>
                <?php
}
echo '</table>';
?>
                <!-- Modal -->

                <div class="modal" id="myModal">
                    <form action="quanlydanhmuc.php" method="post">
                        <!-- Nội dung modal -->
                        <div class="modal-content">
                            <!-- Đóng modal -->
                            <span class="close closeModal">&times;</span>
                            <!-- Nội dung modal -->
                            <h2>Chỉnh sửa danh mục</h2>
                            <div class="update">
                            <div class="form_update">
                                <label for="proDanhmucInput">ID:</label>
                                <input type="text" name="dm_idupdate" id="proDanhmucInput" readonly>
                            </div>
                            <div class="form_update">
                                <label for="dmNameValue">Tên danh mục:</label>
                                <input type="text" name="dm_nameupdate" id="dmNameValue">
                            </div>
                            
                            </div>
                           
                            <button type="submit" name="btn_update" class="btn_update" id="btn_update">
                                <i class="fa-solid fa-arrows-rotate"></i></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            if (isset($_POST['btn_update'])) {
                $id_dm = $_POST['dm_idupdate'];
                $name_dm = $_POST['dm_nameupdate'];
                if (empty($id_dm) || empty($name_dm)) {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Vui lòng điền đầy đủ thông tin.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = 'quanlydanhmuc.php';
                        });
                    </script>";
                    exit; // Dừng thực thi nếu kiểm tra đầu vào không thành công
                }else{
                     // Nếu ID danh mục chưa tồn tại, thêm dữ liệu mới
            $insert_query = "UPDATE tbl_danhmuc SET dm_name = ? WHERE pro_danhmuc = ?";
            $insert_stmt = mysqli_prepare($conn, $insert_query);

            if ($insert_stmt) {
                mysqli_stmt_bind_param($insert_stmt, "si", $name_dm,$id_dm);
                mysqli_stmt_execute($insert_stmt);

                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Cập nhật danh mục thành công!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'quanlydanhmuc.php';
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
                        window.location.href = 'quanlydanhmuc.php';
                    });
                </script>";
            }
                }
            }
            ?>
            <form action="quanlydanhmuc.php" method="post">
                <div class="add_dm">

                    <div class="form_group">
                        <label for="pro_danhmuc">ID danh mục: </label>
                        <input type="text" name="pro_danhmuc" id="pro_danhmuc">
                    </div>
                    <div class="form_group">
                        <label for="dm_name">Tên danh mục: </label>
                        <input type="text" name="dm_name" id="name_dm">
                    </div>
                    <button type="submit" name="btn_duyet" class="btn_duyet" id="btn_duyet"><i
                            class="fa-solid fa-check"></i></button>
                </div>
            </form>
        </div>
    </main>
    <?php
if (isset($_POST['btn_duyet'])) {
    $id_dm = $_POST['pro_danhmuc'];
    $name_dm = $_POST['dm_name'];

    // Kiểm tra đầu vào
    if (empty($id_dm) || empty($name_dm)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Vui lòng điền đầy đủ thông tin.',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'quanlydanhmuc.php';
            });
        </script>";
        exit; // Dừng thực thi nếu kiểm tra đầu vào không thành công
    } else {
        // Kiểm tra xem pro_danhmuc đã tồn tại chưa
        $check_query = "SELECT COUNT(*) FROM tbl_danhmuc WHERE pro_danhmuc = ?";
        $check_stmt = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($check_stmt, "s", $id_dm);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_bind_result($check_stmt, $count);
        mysqli_stmt_fetch($check_stmt);
        mysqli_stmt_close($check_stmt);

        if ($count > 0) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Danh mục đã tồn tại!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'quanlydanhmuc.php';
                });
            </script>";
        } else {
            // Nếu ID danh mục chưa tồn tại, thêm dữ liệu mới
            $insert_query = "INSERT INTO tbl_danhmuc (pro_danhmuc, dm_name) VALUES (?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_query);

            if ($insert_stmt) {
                mysqli_stmt_bind_param($insert_stmt, "is", $id_dm, $name_dm);
                mysqli_stmt_execute($insert_stmt);

                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Thêm danh mục thành công!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'quanlydanhmuc.php';
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
                        window.location.href = 'quanlydanhmuc.php';
                    });
                </script>";
            }

            mysqli_stmt_close($insert_stmt);
        }
    }
}
?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/danhmuc.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>