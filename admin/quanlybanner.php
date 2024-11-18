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

    <link rel="stylesheet" href="css/banner.css">
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
    <h2 class="title">Quản lý nội dung</h2>
    <main class="container">

        <div class="tab-content" id="tab1">
            <div class="products">
                <?php 
echo '<table>'; 
$sql = "SELECT * FROM tbl_bannerabout";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
}
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    // In thông tin ra table
    echo '<tr>';
    echo '    <th>Tiêu đề</th>';
    echo '    <th>Ảnh</th>';
    echo '    <th>Văn bản</th>';
    echo '    <th>Thao tác</th>';
    echo '    </tr>';
    while ($row = $result->fetch_assoc()) {
            echo'    <tr>';
            echo'    <td>'.$row['ab_tieude'].'</td>';
            echo'    <td><img src="'.$row['ab_image'].'" alt=""></td>';
            echo'    <td>'.$row['ab_text'].'</td>';
                ?>

                <form id="deleteForm" action="quanlybanner.php" method="post">
                    <td>
                        <a class="openModal" href="#" data-pro-id="<?php echo $row['ab_id']; ?>"
                            data-pro-tieude="<?php echo $row['ab_tieude']; ?>"
                            data-pro-image="<?php echo $row['ab_image']; ?>"
                            data-pro-text="<?php echo $row['ab_text']; ?>">
                            <i class="fa-solid fa-pen-to-square btn_xem"></i>
                        </a>

                        <button type="button" name="btn_huy" class="btn_huy" id="btn_huy"
                            data-pro-id="<?php echo $row['ab_id']; ?>">
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
                    <form action="quanlybanner.php" method="post">
                        <!-- Nội dung modal -->
                        <div class="modal-content">
                            <!-- Đóng modal -->
                            <span class="close closeModal">&times;</span>
                            <!-- Nội dung modal -->
                            <h2>Chỉnh sửa nội dung</h2>
                            <div class="update">
                                <div class="form_update">
                                    <label for="abTieudeInput">Tiêu đề:</label>
                                    <input type="text" name="ab_idupdate" id="abTieudeInput">
                                </div>
                                <div class="form_update">
                                    <label for="abTextInput">Văn bản:</label>
                                    <textarea id="abTextInput" name="ab_textupdate" rows="5" cols="30"></textarea>
                                </div>
                                <div class="form_update">
                                    <label for="abImageInput">Ảnh:</label>
                                    <input type="file" name="pro_image" id="pro_image"class="file-input">
                                      <label for="pro_image" class="custom-file-label"><i
                                      class="fa-solid fa-cloud-arrow-up"></i></label>
                                    <div id="abImageDisplay"></div>
                                </div>
                            </div>

                            <button type="submit" name="btn_update" class="btn_update" id="btn_update">
                                <i class="fa-solid fa-arrows-rotate"></i>
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
            <form action="quanlybanner.php" method="post" enctype="multipart/form-data">
                <div class="add_dm">
                    <div class="form_group">
                        <label for="ab_tieude">Tiêu đề: </label>
                        <input type="text" name="ab_tieude" id="ab_tieude">
                    </div>
                    <div class="form_group">
                        <label for="ab_image">Ảnh:</label>
                        <input type="file" name="ab_image" id="ab_image" onchange="previewImage()" class="file-input">
                        <label for="ab_image" class="custom-file-label"><i
                                class="fa-solid fa-cloud-arrow-up"></i></label>
                        <div class="image" id="imagePreview"></div>
                    </div>
                    <div class="form_group">
                        <label for="ab_text">Văn bản: </label>
                        <textarea id="pro_mota" name="ab_text" rows="3" cols="30"></textarea>
                    </div>
                    <button type="submit" name="btn_duyet" class="btn_duyet" id="btn_duyet"><i
                            class="fa-solid fa-check"></i></button>
                </div>
            </form>
        </div>
    </main>
    <?php
if (isset($_POST['btn_duyet'])) {
    $ab_tieude = $_POST['ab_tieude'];
    $ab_text = $_POST['ab_text'];
    // Kiểm tra đầu vào
    if (empty($ab_tieude) || empty($ab_text)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Vui lòng điền đầy đủ thông tin.',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'quanlybanner.php';
            });
        </script>";
        exit; // Dừng thực thi nếu kiểm tra đầu vào không thành công
    } else {
        if (isset($_FILES['ab_image']) && $_FILES['ab_image']['error']  == UPLOAD_ERR_OK) {
            // Lấy thông tin về tệp ảnh
            $pro_image = $_FILES['ab_image']['name'];
            $pro_image_temp = $_FILES['ab_image']['tmp_name'];
    
            // Đường dẫn đầy đủ tới thư mục uploads
            $uploads_directory = "uploads/";
    
            // Đường dẫn đầy đủ tới tệp ảnh trong thư mục uploads
            $pro_image_path = $uploads_directory . $pro_image;
    
            // Di chuyển tệp ảnh vào thư mục uploads
            move_uploaded_file($pro_image_temp, $pro_image_path);
    
            // Câu lệnh SQL để thêm sản phẩm vào bảng
            $sql_products = "INSERT INTO tbl_bannerabout (ab_tieude , ab_image , ab_text) 
                    VALUES ('$ab_tieude','$pro_image_path','$ab_text')";
             
            // Thực hiện câu lệnh SQL
            if ($conn->query($sql_products) === TRUE) {
                // Thêm sản phẩm và thành phần thành công
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Thêm nội dung thành công!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'quanlybanner.php';
                    });
                </script>";
            } else {
                echo "Lỗi: " . $sql_products . "<br>" . $conn->error;
            }
        } else {
            // Hiển thị thông báo hoặc thực hiện các xử lý phù hợp khi không có file được chọn
            echo "Lỗi: Không có tệp ảnh được chọn.";
        }
    }
}
?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/banner.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>