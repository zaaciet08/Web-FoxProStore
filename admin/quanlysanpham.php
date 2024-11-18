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
    <link rel="stylesheet" href="css/sanpham.css">
    <link rel="stylesheet" href="css/menu.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <!-- Thêm thư viện Slick Carousel -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">
    </script>

</head>

<body>
    <!-- Header -->
    <?php include 'view/menu.php' ?>
    <!-- Container -->
    <h2 class="title">Quản lý thông tin sản phẩm</h2>
    <main class="container">

        <div class="tabs">
            <div class="tab" onclick="changeTab(1)">Danh sách sản phẩm</div>
            <div class="tab" onclick="changeTab(2)">Thêm sản phẩm mới </div>
        </div>

        <div class="tab-content" id="tab1">

            <div class="products">
                <?php 
echo '<table>'; 
$sql = "SELECT * FROM tbl_products";
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
    echo '    <th>Ảnh</th>';
    echo '    <th>Tên sản phẩm</th>';
    echo '    <th>Giá</th>';
    echo '    <th>Số lượng</th>';
    echo '    <th>Giảm giá (%)</th>';
    echo '    <th>Thương hiệu</th>';
    echo '    <th>Danh mục</th>';
    echo '    <th>Thao tác</th>';
    echo '    </tr>';
    while ($row = $result->fetch_assoc()) {
        $pro_danhmuc = $row['pro_danhmuc'];
        $total_query = "SELECT * FROM tbl_danhmuc WHERE pro_danhmuc = ?";
        $total_stmt = $conn->prepare($total_query);
        $total_stmt->bind_param("i", $pro_danhmuc);
        $total_stmt->execute();
        $total_result = $total_stmt->get_result();
        if ($total_result->num_rows > 0) {
            echo'    <tr>';
            echo'    <td>'.$row['pro_id'].'</td>';
            echo'    <td class="img"><img src="'.$row['pro_image'].'" alt=""></td>';
            echo'    <td><a href="chitietsp.php?pro_id='.$row['pro_id'].'">'.$row['pro_name'].'</a></td>';
            echo'    <td>'.number_format($row['pro_gia'], 0, ',', '.') . 'đ' .'</td>';
            echo'    <td>'.$row['pro_soluong'].'</td>'; 
            echo'    <td>'.$row['pro_giamgia'].'</td>';
            echo'    <td>'.$row['pro_thuonghieu'].'</td>';
            echo'    <td>'.$row['pro_danhmuc'].'</td>';
                ?>

                <form id="deleteForm" action="quanlysanpham.php" method="post">
                    <td><a href="updatesanpham.php?pro_id=<?php echo $row['pro_id']?>"><i
                                class="fa-solid fa-pen-to-square btn_xem"></i></a> <button type="button" name="btn_huy"
                            class="btn_huy" id="btn_huy" data-pro-id="<?php echo $row['pro_id']; ?>"><i
                                class="fa-solid fa-circle-xmark"></i></button></td>
                    </tr>
                </form>
                <?php
        }
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
            </div>
        </div>
        <div class="tab-content" id="tab2">
            <form action="quanlysanpham.php" method="post" enctype="multipart/form-data">
                <div class="products products2">
                    <div class="form_group">
                        <label for="pro_id">Mã sản phẩm:</label>
                        <input type="text" name="pro_id" id="pro_id">
                    </div>
                    <div class="form_group">
                        <label for="pro_name">Tên sản phẩm:</label>
                        <input type="text" name="pro_name" id="pro_name">
                    </div>
                    <div class="form_group">
                        <label for="pro_gia">Giá:</label>
                        <input type="text" name="pro_gia" id="pro_gia">
                    </div>
                    <div class="form_group">
                        <label for="pro_soluong">Số lượng:</label>
                        <input type="number" min="1" name="pro_soluong" id="pro_soluong">
                    </div>
                    <div class="form_group">
                        <label for="pro_giamgia">Khuyến mãi (%):</label>
                        <input type="number" min="0" max="99" name="pro_giamgia" id="pro_giamgia">
                    </div>
                    <div class="form_group">
                        <label for="pro_thuonghieu">Thương hiệu:</label>
                        <input type="text" name="pro_thuonghieu" id="pro_thuonghieu">
                    </div>
                    <div class="form_group">
                        <label for="pro_mota">Mô tả:</label>
                        <textarea id="pro_mota" name="pro_mota" rows="2" cols="30"></textarea>
                    </div>
                    <div class="form_group">
                        <label for="pro_huongvi">Hương vị:</label>
                        <textarea id="pro_huongvi" name="pro_huongvi" rows="2" cols="30"></textarea>
                    </div>

                    <div class="form_group">
                        <label for="pro_danhmuc">Danh mục:</label>
                        <select name="pro_danhmuc" id="pro_danhmuc">
                            <option value="">-- Chưa chọn --</option>
                            <?php 
                          $sql = "SELECT * FROM tbl_danhmuc";
                          $stmt = $conn->prepare($sql);
                          if ($stmt === false) {
                              die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
                          }
                          $stmt->execute();
                          $result = $stmt->get_result();
                          if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                               echo '<option value="'.$row['pro_danhmuc'].'">'.$row['pro_danhmuc'].' - '.$row['dm_name'].'</option>';
                            }
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form_group">
                        <label for="pro_image">Ảnh:</label>
                        <input type="file" name="pro_image" id="pro_image" onchange="previewImage()" class="file-input">
                        <label for="pro_image" class="custom-file-label"><i
                                class="fa-solid fa-cloud-arrow-up"></i></label>
                        <div class="image" id="imagePreview"></div>
                    </div>
                    <div class="form_group anhchitiet">
                        <label for="pro_anhchitiet">Ảnh chi tiết:</label>
                        <input type="file" name="pro_anhchitiet[]" id="pro_anhchitiet" class="file-input" multiple>
                        <label for="pro_anhchitiet" class="custom-file-label"><i
                                class="fa-solid fa-cloud-arrow-up"></i></label>
                        <div class="imageChitiet" id="imageChitiet"></div>
                    </div>
                </div>
                <div class="table_thanhphan">
                    <h2>THÀNH PHẦN DINH DƯỠNG</h2>
                    <table>
                        <tr>
                            <th colspan="3">Supplement Facts: <input type="text" name="ing_sfacts" id=""></th>
                        </tr>
                        <tr>
                            <th colspan="3">Serving Size: <input type="text" name="ing_ssize" id=""></th>
                        </tr>
                        <tr>
                            <th colspan="3">Servings Per Container: ~ <input type="number" name="ing_percontainer"
                                    id="">Serving
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Amount Per Serving</th>
                            <th>% Daily Value</th>
                        </tr>
                        <tr>
                            <td class="head">Calories</td>
                            <td><input type="number" min="1" name="ing_caloamount" id=""> g</td>
                            <td><input type="number" min="1" max="100" name="ing_calopercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td class="head">Total Fat</td>
                            <td><input type="number" min="1" name="ing_totalamount" id=""> g</td>
                            <td><input type="number" min="1" max="100" name="ing_totalpercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp">Saturated Fat</span></td>
                            <td><input type="number" min="1" name="ing_sfatamount" id=""> g</td>
                            <td><input type="number" min="1" max="100" name="ing_sfatpercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp"> Trans Fat</span></td>
                            <td><input type="number" min="1" name="ing_tfatamount" id=""> g</td>
                            <td><input type="number" min="1" max="100" name="ing_tfatpercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td class="head">Cholesterol</td>
                            <td><input type="number" name="ing_choleamount" id=""> mg</td>
                            <td><input type="number" min="1" max="100" name="ing_cholepercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td class="head">Sodium</td>
                            <td><input type="number" name="ing_sodiamount" id=""> mg</td>
                            <td><input type="number" min="1" max="100" name="ing_sodipercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td class="head">Protein</td>
                            <td><input type="number" name="ing_proamount" id=""> mg</td>
                            <td><input type="number" min="1" max="100" name="ing_propercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp">Potassium</span></td>
                            <td><input type="number" name="ing_potaamount" id=""> mg</td>
                            <td><input type="number" min="1" max="100" name="ing_potapercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp">Iron</span></td>
                            <td><input type="number" name="ing_ironamount" id=""> mg</td>
                            <td><input type="number" min="1" max="100" name="ing_ironpercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp">Calcium</span></td>
                            <td><input type="number" name="ing_calciamount" id=""> mg</td>
                            <td><input type="number" min="1" max="100" name="ing_calcipercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp">Vitamin D</span></td>
                            <td><input type="number" name="ing_vitaminamount" id=""> mg</td>
                            <td><input type="number" min="1" max="100" name="ing_vitaminpercent" id=""> %</td>
                        </tr>
                    </table>

                </div>
                <button type="submit" class="btn_add" name="btn_add"><i class="fa-solid fa-circle-plus"></i></button>
            </form>

        </div>
        <?php
if (isset($_POST['btn_add'])) {
    // Lấy giá trị từ form
    $pro_id = $_POST['pro_id'];
    $pro_name = $_POST['pro_name'];
    $pro_gia = $_POST['pro_gia'];
    $pro_soluong = $_POST['pro_soluong'];
    $pro_giamgia = $_POST['pro_giamgia'];
    $pro_thuonghieu = $_POST['pro_thuonghieu'];
    $pro_mota = $_POST['pro_mota'];
    $pro_huongvi = $_POST['pro_huongvi'];
    $pro_danhmuc = $_POST['pro_danhmuc'];

    // Kiểm tra xem có tệp ảnh được chọn hay không
    if (isset($_FILES['pro_image']) && $_FILES['pro_image']['error']  == UPLOAD_ERR_OK && isset($_FILES['pro_anhchitiet']) && $_FILES['pro_anhchitiet']['error'][0] == UPLOAD_ERR_OK) {
        // Lấy thông tin về tệp ảnh
        $pro_image = $_FILES['pro_image']['name'];
        $pro_image_temp = $_FILES['pro_image']['tmp_name'];

        // Đường dẫn đầy đủ tới thư mục uploads
        $uploads_directory = "uploads/";

        // Đường dẫn đầy đủ tới tệp ảnh trong thư mục uploads
        $pro_image_path = $uploads_directory . $pro_image;

        // Di chuyển tệp ảnh vào thư mục uploads
        move_uploaded_file($pro_image_temp, $pro_image_path);

        // Câu lệnh SQL để thêm sản phẩm vào bảng
        $sql_products = "INSERT INTO tbl_products (pro_id, pro_name, pro_image, pro_gia, pro_mota, pro_soluong, pro_giamgia, pro_huongvi, pro_thuonghieu, pro_danhmuc) 
                VALUES ('$pro_id','$pro_name','$pro_image_path','$pro_gia','$pro_mota','$pro_soluong','$pro_giamgia','$pro_huongvi','$pro_thuonghieu','$pro_danhmuc')";
         
        // Thực hiện câu lệnh SQL
        if ($conn->query($sql_products) === TRUE) {
            // Lấy pro_id mới được tạo
            $last_pro_id = mysqli_insert_id($conn);
            $ing_sfacts = $_POST['ing_sfacts'];
            $ing_ssize = $_POST['ing_ssize'];
            $ing_percontainer = $_POST['ing_percontainer'];
            $ing_caloamount = $_POST['ing_caloamount'];
            $ing_calopercent = $_POST['ing_calopercent'];
            $ing_totalamount = $_POST['ing_totalamount'];
            $ing_totalpercent = $_POST['ing_totalpercent'];
            $ing_sfatamount = $_POST['ing_sfatamount'];
            $ing_sfatpercent = $_POST['ing_sfatpercent'];
            $ing_tfatamount = $_POST['ing_tfatamount'];
            $ing_tfatpercent = $_POST['ing_tfatpercent'];
            $ing_choleamount = $_POST['ing_choleamount'];
            $ing_cholepercent = $_POST['ing_cholepercent'];
            $ing_sodiamount = $_POST['ing_sodiamount'];
            $ing_sodipercent = $_POST['ing_sodipercent'];
            $ing_proamount = $_POST['ing_proamount'];
            $ing_propercent = $_POST['ing_propercent'];
            $ing_potaamount = $_POST['ing_potaamount'];
            $ing_potapercent = $_POST['ing_potapercent'];
            $ing_ironamount = $_POST['ing_ironamount'];
            $ing_ironpercent = $_POST['ing_ironpercent'];
            $ing_calciamount = $_POST['ing_calciamount'];
            $ing_calcipercent = $_POST['ing_calcipercent'];
            $ing_vitaminamount = $_POST['ing_vitaminamount'];
            $ing_vitaminpercent = $_POST['ing_vitaminpercent'];
            // Lấy dữ liệu từ form cho bảng tbl_ingredient
            // ... (lấy các giá trị khác)

            // Câu lệnh SQL để thêm dữ liệu vào bảng tbl_ingredient
            $sql_ingredient = "INSERT INTO tbl_ingredient (pro_id, ing_sfacts, ing_ssize, ing_percontainer, ing_caloamount, ing_calopercent, ing_totalamount, ing_totalpercent, ing_sfatamount, ing_sfatpercent, ing_tfatamount, ing_tfatpercent, ing_choleamount, ing_cholepercent, ing_sodiamount, ing_sodipercent, ing_proamount, ing_propercent, ing_potaamount, ing_potapercent, ing_ironamount, ing_ironpercent, ing_calciamount, ing_calcipercent, ing_vitaminamount, ing_vitaminpercent)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt_ingredient = $conn->prepare($sql_ingredient);
            if (!$stmt_ingredient) {
                die("Lỗi chuẩn bị câu lệnh: " . $conn->error);
            }

            // Ràng buộc tham số
            $stmt_ingredient->bind_param("isssssssssssssssssssssssss", $last_pro_id, $ing_sfacts, $ing_ssize, $ing_percontainer, $ing_caloamount, $ing_calopercent, $ing_totalamount, $ing_totalpercent, $ing_sfatamount, $ing_sfatpercent, $ing_tfatamount, $ing_tfatpercent, $ing_choleamount, $ing_cholepercent, $ing_sodiamount, $ing_sodipercent, $ing_proamount, $ing_propercent, $ing_potaamount, $ing_potapercent, $ing_ironamount, $ing_ironpercent, $ing_calciamount, $ing_calcipercent, $ing_vitaminamount, $ing_vitaminpercent);

            if (!$stmt_ingredient->execute()) {
                die("Lỗi thêm vào tbl_ingredient: " . $stmt_ingredient->error);
            }
              $image_detail_paths = []; 
            foreach ($_FILES["pro_anhchitiet"]["tmp_name"] as $key => $tmp_name) {
                $tenHinhAnh = basename($_FILES["pro_anhchitiet"]["name"][$key]);
                $thuMucDich = "uploads/";
                $duongDanTapTin = $thuMucDich . $tenHinhAnh;
                $coTheTaiLen = 1;
                $loaiTepAnh = strtolower(pathinfo($tenHinhAnh, PATHINFO_EXTENSION));
        
                if ($coTheTaiLen) {
                    if (move_uploaded_file($tmp_name, $duongDanTapTin)) {
                        $image_detail_paths[] = $duongDanTapTin; 
                    } else {
                        echo "<script>alert('Có lỗi xảy ra khi tải lên tệp.')</script>";
                    }
                }
            }
           
            foreach ($image_detail_paths as $duongDanTapTin) {
                $sql = "INSERT INTO tbl_image (pro_id, img_image) VALUES (?, ?)";
                $stmt2 = $conn->prepare($sql);
                $stmt2->bind_param("is",  $last_pro_id , $duongDanTapTin);
        
                if ($stmt2->execute()) {
                   
                } else {
                    echo "<script>alert('Lỗi khi thêm chi tiết hình ảnh.')</script>";
                }
              }
           

            // Đóng kết nối
            $conn->close();

            // Thêm sản phẩm và thành phần thành công
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thêm sản phẩm và thành phần thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'quanlysanpham.php';
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
?>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/sanpham.js"></script>
    <script src="js/menu.js"></script>
    <script>
    // Sự kiện khi thay đổi input file
    $("#pro_anhchitiet").change(function() {
        var imageChitiet = $("#imageChitiet");

        // Kiểm tra xem slider đã được khởi tạo chưa
        if (imageChitiet.hasClass('slick-initialized')) {
            // Nếu đã khởi tạo, hủy bỏ slick
            imageChitiet.slick('unslick');
        }

        // Xóa nội dung của slick slider
        imageChitiet.empty();

        // Lặp qua từng tệp hình ảnh đã chọn
        for (var i = 0; i < this.files.length; i++) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Thêm hình ảnh và nút đóng vào slick slider
                var imageItem = $('<div class="imageItem"><img src="' + e.target.result +
                    '"><button class="closeButton" onclick="removeImage(this)">Close</button></div>');
                imageChitiet.append(imageItem);
            };

            // Đọc dữ liệu của tệp hình ảnh
            reader.readAsDataURL(this.files[i]);
        }

        // Khởi tạo lại Slick Carousel
        imageChitiet.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
        });
    });

    // Hàm xóa ảnh khi nhấn nút đóng
    function removeImage(button) {
        var imageItem = $(button).parent();

        // Xóa ảnh khỏi slick slider
        imageItem.remove();

        // Nếu không còn ảnh nào, hủy bỏ slick
        if ($("#imageChitiet .imageItem").length === 0) {
            $("#imageChitiet").slick('unslick');
        }
    }
    </script>

    </script>

</body>

</html>