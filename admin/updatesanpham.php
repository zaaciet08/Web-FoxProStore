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
    <link rel="stylesheet" href="css/updatesanpham.css">
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
    <h2 class="title">Cập nhật thông tin sản phẩm</h2>
    <main class="container">
        <div class="tab-content" id="tab2">
            <form action="updatesanpham.php" method="post" enctype="multipart/form-data">
                <?php 
                $conn = mysqli_connect("localhost", "root", "", "foxprostore");

                // Kiểm tra kết nối
                if (!$conn) {
                    die("Kết nối không thành công: " . mysqli_connect_error());
                }
                if(isset($_GET["pro_id"])){
                    $pro_id = $_GET['pro_id'];
                 $query = 'SELECT * FROM tbl_products WHERE pro_id = ?';
                 $stmt = $conn->prepare($query);
                 $stmt->bind_param('i', $pro_id);
                 $stmt->execute();
                 $result = $stmt->get_result();
                 if ($result->num_rows > 0) {
                    while ($row_sanpham = $result->fetch_assoc()) {
                        $sale = $row_sanpham['pro_gia'] - (($row_sanpham['pro_gia'] * $row_sanpham['pro_giamgia']) / 100);
                        $tietkiem = $row_sanpham['pro_gia'] -  $sale;
                        $query_images = 'SELECT * FROM tbl_image WHERE pro_id = ?';
                        $stmt_images = $conn->prepare($query_images);
                        $stmt_images->bind_param('i', $pro_id);
                        $stmt_images->execute();
                        $result_images = $stmt_images->get_result();
                        ?>
                <div class="products products2">
                    <input type="hidden" name="pro_id" value="<?php echo''.$pro_id.''?>" id="">
                    <div class="form_group">
                        <label for="pro_id">Mã sản phẩm:</label>
                        <input type="text" value="<?php echo''.$pro_id.''?>" name="pro_id" id="pro_id" readonly>
                    </div>
                    <div class="form_group">
                        <label for="pro_name">Tên sản phẩm:</label>
                        <input type="text" value="<?php echo''.$row_sanpham['pro_name'].'' ?>" name="pro_name"
                            id="pro_name">
                    </div>
                    <div class="form_group">
                        <label for="pro_gia">Giá:</label>
                        <input type="text" value="<?php echo''.$row_sanpham['pro_gia'].''?>" name="pro_gia"
                            id="pro_gia">
                    </div>
                    <div class="form_group">
                        <label for="pro_soluong">Số lượng:</label>
                        <input type="number" value="<?php echo''.$row_sanpham['pro_soluong'].'' ?>" min="1"
                            name="pro_soluong" id="pro_soluong">
                    </div>
                    <div class="form_group">
                        <label for="pro_giamgia">Khuyến mãi (%):</label>
                        <input type="number" value="<?php echo''.$row_sanpham['pro_giamgia'].'' ?>" min="0" max="99"
                            name="pro_giamgia" id="pro_giamgia">
                    </div>
                    <div class="form_group">
                        <label for="pro_thuonghieu">Thương hiệu:</label>
                        <input type="text" value="<?php echo''.$row_sanpham['pro_thuonghieu'].'' ?>"
                            name="pro_thuonghieu" id="pro_thuonghieu">
                    </div>
                    <div class="form_group">
                        <label for="pro_mota">Mô tả:</label>
                        <textarea id="pro_mota" name="pro_mota" rows="4"
                            cols="30"> <?php echo''.$row_sanpham['pro_mota'].'' ?></textarea>
                    </div>
                    <div class="form_group">
                        <label for="pro_huongvi">Hương vị:</label>
                        <textarea id="pro_huongvi" name="pro_huongvi" rows="4"
                            cols="30"><?php echo''.$row_sanpham['pro_huongvi'].'' ?></textarea>
                    </div>
                    <div class="form_group">
                        <label for="pro_danhmuc">Danh mục:</label>
                        <select name="pro_danhmuc" id="pro_danhmuc">
                            <?php 
    // Display all categories
    $sql_all_categories = "SELECT * FROM tbl_danhmuc";
    $stmt_all_categories = $conn->prepare($sql_all_categories);

    if ($stmt_all_categories === false) {
        die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
    }

    $stmt_all_categories->execute();
    $result_all_categories = $stmt_all_categories->get_result();

    if ($result_all_categories->num_rows > 0) {
        while ($row_category = $result_all_categories->fetch_assoc()) {
            $selected = ($row_category['pro_danhmuc'] == $selected_category) ? 'selected' : '';
            echo '<option value="'.$row_category['pro_danhmuc'].'" '.$selected.'>'.$row_category['pro_danhmuc'].' - '.$row_category['dm_name'].'</option>';
        }
    }

    // Display selected category based on pro_id
    if (isset($_GET["pro_id"])) {
        $pro_id = $_GET['pro_id'];

        $sql_selected_category = "SELECT pro_danhmuc FROM tbl_products WHERE pro_id = ?";
        $stmt_selected_category = $conn->prepare($sql_selected_category);
        $stmt_selected_category->bind_param('i', $pro_id);

        if ($stmt_selected_category === false) {
            die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
        }

        $stmt_selected_category->execute();
        $result_selected_category = $stmt_selected_category->get_result();

        if ($result_selected_category->num_rows > 0) {
            $row_selected_category = $result_selected_category->fetch_assoc();
            $selected_category = $row_selected_category['pro_danhmuc'];

            // Now, retrieve dm_name based on pro_danhmuc
            $sql_dm_name = "SELECT dm_name FROM tbl_danhmuc WHERE pro_danhmuc = ?";
            $stmt_dm_name = $conn->prepare($sql_dm_name);
            $stmt_dm_name->bind_param('s', $selected_category);

            if ($stmt_dm_name === false) {
                die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
            }
            $stmt_dm_name->execute();
            $result_dm_name = $stmt_dm_name->get_result();

            if ($result_dm_name->num_rows > 0) {
                $row_dm_name = $result_dm_name->fetch_assoc();
                $dm_name = $row_dm_name['dm_name'];
                echo '<option value="'.$selected_category.'" selected>'.$selected_category.' - '.$dm_name.'</option>';
            }
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
                        <div class="image" id="imagePreview"><img src="<?php echo''.$row_sanpham['pro_image'].'' ?>"
                                alt=""></div>
                    </div>
                    <!-- Đoạn thêm vào  -->
                    <div class="form_group anhchitiet">
                        <label for="pro_anhchitiet">Ảnh chi tiết:</label>
                        <input type="file" name="pro_anhchitiet[]" id="pro_anhchitiet" class="file-input" multiple>
                        <label for="pro_anhchitiet" class="custom-file-label"><i
                                class="fa-solid fa-cloud-arrow-up"></i></label>
                        <div class="imageChitiet" id="imageChitiet">
                            <?php
// Retrieve detailed images from tbl_image for the specific pro_id
$query_images = 'SELECT * FROM tbl_image WHERE pro_id = ?';
$stmt_images = $conn->prepare($query_images);
$stmt_images->bind_param('i', $pro_id);
$stmt_images->execute();
$result_images = $stmt_images->get_result();

if ($result_images->num_rows > 0) {
    
    while ($row_image = $result_images->fetch_assoc()) {
        echo '<img src="' . $row_image['img_image'] . '" alt="">';
        echo '<button type="submit" class="delete_img" data-imgid="' . $row_image['img_id'] . '"><i class="fa-solid fa-circle-xmark"></i></button>';
    }
}
?>
                        </div>
                    </div>


                </div>
                <div class="table_thanhphan">
                    <h2>THÀNH PHẦN DINH DƯỠNG</h2>
                    <?php
                    $query_tp = 'SELECT * FROM tbl_ingredient WHERE pro_id = ?';
                    $stmt_tp = $conn->prepare($query_tp);
                    $stmt_tp->bind_param('i', $pro_id);
                    $stmt_tp->execute();
                    $result_tp = $stmt_tp->get_result();
                    if ($result_tp->num_rows > 0) {
                       
                       while ($row_tp = $result_tp->fetch_assoc()) {
                           ?>
                    <table>
                        <tr>
                            <th colspan="3">Supplement Facts: <input type="text"
                                    value="<?php echo''.$row_tp['ing_sfacts'].'' ?>" name="ing_sfacts" id=""></th>
                        </tr>
                        <tr>
                            <th colspan="3">Serving Size: <input type="text"
                                    value="<?php echo''.$row_tp['ing_ssize'].'' ?>" name="ing_ssize" id=""></th>
                        </tr>
                        <tr>
                            <th colspan="3">Servings Per Container: ~ <input type="number"
                                    value="<?php echo''.$row_tp['ing_percontainer'].'' ?>" name="ing_percontainer"
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
                            <td><input type="number" value="<?php echo''.$row_tp['ing_caloamount'].'' ?>" min="1"
                                    name="ing_caloamount" id=""> g</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_calopercent'].'' ?>" min="1"
                                    max="100" name="ing_calopercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td class="head">Total Fat</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_totalamount'].'' ?>" min="1"
                                    name="ing_totalamount" id=""> g</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_totalpercent'].'' ?>" min="1"
                                    max="100" name="ing_totalpercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp">Saturated Fat</span></td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_sfatamount'].'' ?>" min="1"
                                    name="ing_sfatamount" id=""> g</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_sfatpercent'].'' ?>" min="1"
                                    max="100" name="ing_sfatpercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp"> Trans Fat</span></td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_tfatamount'].'' ?>" min="1"
                                    name="ing_tfatamount" id=""> g</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_tfatpercent'].'' ?>" min="1"
                                    max="100" name="ing_tfatpercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td class="head">Cholesterol</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_choleamount'].'' ?>" min="1"
                                    name="ing_choleamount" id=""> mg</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_cholepercent'].'' ?>" min="1"
                                    max="100" name="ing_cholepercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td class="head">Sodium</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_sodiamount'].'' ?>" min="1"
                                    name="ing_sodiamount" id=""> mg</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_sodipercent'].'' ?>" min="1"
                                    max="100" name="ing_sodipercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td class="head">Protein</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_proamount'].'' ?>" min="1"
                                    name="ing_proamount" id=""> mg</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_propercent'].'' ?>" min="1"
                                    max="100" name="ing_propercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp">Potassium</span></td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_potaamount'].'' ?>" min="1"
                                    name="ing_potaamount" id=""> mg</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_potapercent'].'' ?>" min="1"
                                    max="100" name="ing_potapercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp">Iron</span></td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_ironamount'].'' ?>" min="1"
                                    name="ing_ironamount" id=""> mg</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_ironpercent'].'' ?>" min="1"
                                    max="100" name="ing_ironpercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp">Calcium</span></td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_calciamount'].'' ?>" min="1"
                                    name="ing_calciamount" id=""> mg</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_calcipercent'].'' ?>" min="1"
                                    max="100" name="ing_calcipercent" id=""> %</td>
                        </tr>
                        <tr>
                            <td><span class="tp">Vitamin D</span></td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_vitaminamount'].'' ?>" min="1"
                                    name="ing_vitaminamount" id=""> mg</td>
                            <td><input type="number" value="<?php echo''.$row_tp['ing_vitaminpercent'].'' ?>" min="1"
                                    max="100" name="ing_vitaminpercent" id=""> %</td>
                        </tr>
                    </table>
                    <?php
               }
             }
            ?>
                </div>

                <!-- -->
                <a class="return" href="quanlysanpham.php">Quay lại >></a>
                <button type="submit" class="btn_add" name="btn_add"><i class="fa-solid fa-arrows-rotate"></i></button>
            </form>
            <?php
        }
    }
}
?>
        </div>
        <?php
if (isset($_POST['btn_add']) ) {
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
        $sql_update_product = "UPDATE tbl_products 
                      SET pro_name = '$pro_name', 
                          pro_image = '$pro_image_path', 
                          pro_gia = '$pro_gia', 
                          pro_mota = '$pro_mota', 
                          pro_soluong = '$pro_soluong', 
                          pro_giamgia = '$pro_giamgia', 
                          pro_huongvi = '$pro_huongvi', 
                          pro_thuonghieu = '$pro_thuonghieu', 
                          pro_danhmuc = '$pro_danhmuc'
                      WHERE pro_id = '$pro_id'";
        // Thực hiện câu lệnh SQL
        if ($conn->query($sql_update_product) === TRUE) {
            // Lấy pro_id mới được tạo  Đoạn mới
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
            $sql_update_ingredient = "UPDATE tbl_ingredient 
                          SET ing_sfacts = ?, 
                              ing_ssize = ?, 
                              ing_percontainer = ?, 
                              ing_caloamount = ?, 
                              ing_calopercent = ?, 
                              ing_totalamount = ?, 
                              ing_totalpercent = ?, 
                              ing_sfatamount = ?, 
                              ing_sfatpercent = ?, 
                              ing_tfatamount = ?, 
                              ing_tfatpercent = ?, 
                              ing_choleamount = ?, 
                              ing_cholepercent = ?, 
                              ing_sodiamount = ?, 
                              ing_sodipercent = ?, 
                              ing_proamount = ?, 
                              ing_propercent = ?, 
                              ing_potaamount = ?, 
                              ing_potapercent = ?, 
                              ing_ironamount = ?, 
                              ing_ironpercent = ?, 
                              ing_calciamount = ?, 
                              ing_calcipercent = ?, 
                              ing_vitaminamount = ?, 
                              ing_vitaminpercent = ? 
                          WHERE pro_id = ?";


            $stmt_ingredient = $conn->prepare($sql_update_ingredient);
            if (!$stmt_ingredient) {
                die("Lỗi chuẩn bị câu lệnh: " . $conn->error);
            }

            // Ràng buộc tham số
            $stmt_ingredient->bind_param("sssssssssssssssssssssssssi", $ing_sfacts, $ing_ssize, $ing_percontainer, $ing_caloamount, $ing_calopercent, $ing_totalamount, $ing_totalpercent, $ing_sfatamount, $ing_sfatpercent, $ing_tfatamount, $ing_tfatpercent, $ing_choleamount, $ing_cholepercent, $ing_sodiamount, $ing_sodipercent, $ing_proamount, $ing_propercent, $ing_potaamount, $ing_potapercent, $ing_ironamount, $ing_ironpercent, $ing_calciamount, $ing_calcipercent, $ing_vitaminamount, $ing_vitaminpercent, $pro_id);

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
                $stmt2->bind_param("is",  $pro_id , $duongDanTapTin);
        
                if ($stmt2->execute()) {
                   
                } else {
                    echo "<script>alert('Lỗi khi thêm chi tiết hình ảnh.')</script>";
                }
              }
           

            // Đóng kết nối
            $conn->close();


            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Cập nhật sản phẩm thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'updatesanpham.php?pro_id=". $pro_id."';
                });
            </script>";
        } else {
            echo "Lỗi: " . $sql_products . "<br>" . $conn->error;
        }
    } else {
        // Hiển thị thông báo hoặc thực hiện các xử lý phù hợp khi không có file được chọn
        echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Chưa chọn tệp ảnh!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'updatesanpham.php?pro_id=". $pro_id."';
                });
            </script>";
    }
}
?>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/updatesanpham.js"></script>
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

    <!-- Add this script to handle AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.delete_img').on('click', function() {
            var img_id = $(this).data('imgid');

            $.ajax({
                type: 'POST',
                url: 'deleteimage.php',
                data: {
                    img_id: img_id
                },
                success: function(response) {
                    if (response === 'success') {
                        // Reload the page or update the image display
                        location.reload();
                    } else {
                        alert('Error deleting image.');
                    }
                },
                error: function() {
                    alert('Error communicating with the server.');
                }
            });
        });
    });
    </script>

</body>

</html>