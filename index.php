<?php
  include_once './db/conect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fox Pro</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/logo.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/logo.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="assets/img/logo.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/logo.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/logo.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/logo.png" />
    <link rel="manifest" href="./assets/favicon/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="assets/img/logo.png" />
    <meta name="theme-color" content="#ffffff" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/reset.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/home-responsive.css" />
    <link rel="stylesheet" href="./assets/css/brand.css">
    <link rel="stylesheet" href="./assets/css/products.css">


    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="./Fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="js/banner.js"></script>
    <script src="js/chuyendoianhchitiet.js"></script>
</head>

<body>
    <!-- Header -->
    <?php include'php/menu.php' ?>
    <!-- Hero -->
    <div class="banner">
        <div class="brand">
            <img src="./assets/img/slider_2.webp" alt="Image 1">
            <img src="./assets/img/slider_5.webp" alt="Image 2">
            <img src="./assets/img/right_banner_3.webp" alt="Image 3">
            <div class="arrow-left"><i class="fa-solid fa-arrow-left"></i></div>
            <div class="arrow-right"><i class="fa-solid fa-arrow-right"></i></div>
        </div>
    </div>
    <main class="main-content">
        <!-- Features -->
        <section class="features">
            <div class="container">
                <p class="feature__label">Đ Ặ C T R Ư N G</p>
                <div class="features__inner">
                    <section class="features__content">
                        <h2 class="features__heading heading-lv2">
                            Đồng hành cùng sức khỏe của bạn
                        </h2>
                        <p class="features__desc">
                            Đọc tính năng tuyệt vời của chúng tôi hoàn toàn phù hợp
                            cho bạn. Khám phá tính năng và biết điều tốt nhất.
                        </p>
                    </section>
                    <div class="features__list" data-aos="fade-up" data-aos-duration="1000">
                        <div class="features__item">
                            <div class="features-item__icon">
                                <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M26 13.9961V15.1656C26 19.8436 24.8875 21 20.45 21H6.55C2.1125 21 1 19.8305 1 15.1656V6.83443C1 2.16951 2.1125 1 6.55 1H8.5"
                                        stroke="currentcolor" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M13.5 21.5V25.5" stroke="currentcolor" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M1 14.75H26" stroke="currentcolor" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7.875 26H19.125" stroke="currentcolor" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M20.825 10.2127H14.875C13.15 10.2127 12.575 9.0627 12.575 7.9127V3.5127C12.575 2.1377 13.7 1.0127 15.075 1.0127H20.825C22.1 1.0127 23.125 2.0377 23.125 3.31269V7.9127C23.125 9.1877 22.1 10.2127 20.825 10.2127Z"
                                        stroke="currentcolor" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M24.6375 8.39985L23.125 7.33735V3.88735L24.6375 2.82485C25.3875 2.31235 26 2.62485 26 3.53735V7.69985C26 8.61235 25.3875 8.92485 24.6375 8.39985Z"
                                        stroke="currentcolor" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <h3 class="features-item__heading">
                                Công nghệ tiên tiến
                            </h3>
                            <p class="features-item__desc">
                                Sử dụng công nghệ tiên tiến từ Châu Âu trong tất cả quá trình sản xuất đạt 100% về chất
                                lượng.

                            </p>
                        </div>
                        <div class="features__item">
                            <div class="features-item__icon">
                                <svg width="28" height="27" viewBox="0 0 28 27" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.4 19.746H6.47299C2.092 19.746 1 18.654 1 14.273V6.47299C1 2.092 2.092 1 6.47299 1H20.162C24.543 1 25.635 2.092 25.635 6.47299"
                                        stroke="currentcolor" stroke-width="1.7" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M11.3999 25.6218V19.7458" stroke="currentcolor" stroke-width="1.7"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M1 14.5459H11.4" stroke="currentcolor" stroke-width="1.7"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7.16211 25.6218H11.4001" stroke="currentcolor" stroke-width="1.7"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M26.9999 14.3509V21.7739C26.9999 24.8549 26.2329 25.6219 23.152 25.6219H18.537C15.456 25.6219 14.689 24.8549 14.689 21.7739V14.3509C14.689 11.2699 15.456 10.5029 18.537 10.5029H23.152C26.2329 10.5029 26.9999 11.2699 26.9999 14.3509Z"
                                        stroke="currentcolor" stroke-width="1.7" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M20.8179 21.4359H20.8296" stroke="currentcolor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <h3 class="features-item__heading">
                                Đa dạng sản phẩm
                            </h3>
                            <p class="features-item__desc">
                                Đa dạng sản phẩm hổ trợ giúp bạn bổ sung nhanh những khoáng chất cần thiết cho cơ thể.
                            </p>
                        </div>
                        <div class="features__item">
                            <div class="features-item__icon">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.6185 23.8234H7.24516C3.5585 23.8234 2.3335 21.3734 2.3335 18.9118V9.08842C2.3335 5.40176 3.5585 4.17676 7.24516 4.17676H14.6185C18.3052 4.17676 19.5302 5.40176 19.5302 9.08842V18.9118C19.5302 22.5984 18.2935 23.8234 14.6185 23.8234Z"
                                        stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M22.7736 19.9502L19.5303 17.6752V10.3135L22.7736 8.03849C24.3603 6.93015 25.6669 7.60682 25.6669 9.55515V18.4452C25.6669 20.3935 24.3603 21.0702 22.7736 19.9502Z"
                                        stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M13.4165 12.8345C14.383 12.8345 15.1665 12.051 15.1665 11.0845C15.1665 10.118 14.383 9.33447 13.4165 9.33447C12.45 9.33447 11.6665 10.118 11.6665 11.0845C11.6665 12.051 12.45 12.8345 13.4165 12.8345Z"
                                        stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <h3 class="features-item__heading">
                                Liên tục cập nhật
                            </h3>
                            <p class="features-item__desc">
                                Với đội ngũ chuyên gia nghiên cứu về sức khỏe , luôn luôn cập nhập các tình trạng của
                                sức khỏe.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Courses Noi dung-->
        <section class="courses">
            <div class="container">
                <div class="courses__innner">
                    <p id="sanpham" class="courses__title">S Ả N P H Ẩ M</p>
                    <!-- Wheyprotein -->
                    <section class="courses__content">
                        <div class="courses__text">
                            <h2 id="wheyprotein" class="courses__heading heading-lv2">
                                Whey Protein
                            </h2>
                        </div>
                    </section>
                    <hr>
                    <div class="container_pro" style="display: flex;">
                        <div class="banner_whey ">
                            <img src="./assets/img/section_hot.png" alt="" class="blogs-item__img">
                        </div>

                        <?php
                       
    $danhmuc = '1';
    $limit = 8; // Số sản phẩm hiển thị ban đầu
    $start = 0;
    $query = "SELECT * FROM tbl_products WHERE pro_danhmuc = '$danhmuc' LIMIT $start, $limit";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row_sanpham = $result->fetch_assoc()) {
        $sale = $row_sanpham['pro_gia'] - (($row_sanpham['pro_gia'] * $row_sanpham['pro_giamgia']) / 100);
            
        // Lấy ảnh từ tbl_image dựa trên pro_id
        $query_images = 'SELECT * FROM tbl_image WHERE pro_id = ?';
        $stmt_images = $conn->prepare($query_images);
        $stmt_images->bind_param('i', $row_sanpham['pro_id']);
        $stmt_images->execute();
        $result_images = $stmt_images->get_result();
?>
                        <section class="deal">
                            <?php 
                            $soluong = $row_sanpham['pro_soluong'];
                            if($soluong == 0){
                                    echo'<span class="tinhtrang_hethang">Hết hàng</span>';
                            }else if($soluong >= 1 && $soluong <= 4){
                                echo ' <span class="tinhtrang_saphethang">Sắp hết hàng</span>';
                            }else{
                                 echo' <span class="tinhtrang_conhang">Còn hàng</span>';
                            }
                            ?>
                            <img src="admin/<?php echo $row_sanpham['pro_image']; ?>" alt="">
                            <a href="chitietsanpham.php?pro_id=<?php echo $row_sanpham['pro_id']; ?>"
                                class="deal__heading"><?php echo $row_sanpham['pro_name']; ?></a>
                            <?php 
                               if($row_sanpham['pro_giamgia'] == 0){
                                       echo ' <span class="deal__price">'.number_format(floatval($row_sanpham['pro_gia']), 0, ',', '.') . 'đ'.'</span>';
                               }else{
                                echo' <span class="deal__price">'.number_format(floatval($sale), 0, ',', '.') . 'đ'.'</span>';
                                echo' <span class="deal__sale_price"><del>'.number_format(floatval($row_sanpham['pro_gia']), 0, ',', '.') . 'đ'.'</del></span>';
                                echo' <span class="deal__percent">-'.$row_sanpham['pro_giamgia'].'%</span>';
                               }
                               ?>
                            <p class="deal__footer"><i class="fa-solid fa-tag"></i>&ensp;Giá tốt nhất thị trường
                                <br><br><i class="fa-solid fa-caret-down"></i>&ensp;Giảm giá trực tiếp
                            </p>

                        </section>

                        <?php
    }
    
} else {
    echo 'Không có sản phẩm nào.';
}
?>
                        <a class="xemthem" href="courses.php?dm_id=1">Xem thêm</a>
                    </div>


                    <!-- Mass gainer-->
                    <section class="courses__content">
                        <div class="courses__text">
                            <h2 id="massgainer" class="courses__heading heading-lv2">
                                Mass Gainer
                            </h2>
                        </div>
                    </section>
                    <hr>
                    <div class="container_pro " style="display: flex;">
                        <div class="banner_whey mass ">
                            <img src="./assets/img/massgainer.png" alt="">
                        </div>
                        <?php
                        
    $danhmuc = '2';
    $limit = 8; // Số sản phẩm hiển thị ban đầu
    $start = 0;
    $query = "SELECT * FROM tbl_products WHERE pro_danhmuc = '$danhmuc' LIMIT $start, $limit";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row_sanpham = $result->fetch_assoc()) {
        $sale = $row_sanpham['pro_gia'] - (($row_sanpham['pro_gia'] * $row_sanpham['pro_giamgia']) / 100);
            
        // Lấy ảnh từ tbl_image dựa trên pro_id
        $query_images = 'SELECT * FROM tbl_image WHERE pro_id = ?';
        $stmt_images = $conn->prepare($query_images);
        $stmt_images->bind_param('i', $row_sanpham['pro_id']);
        $stmt_images->execute();
        $result_images = $stmt_images->get_result();
?>
                        <section class="deal">
                            <?php 
                            $soluong = $row_sanpham['pro_soluong'];
                            if($soluong == 0){
                                    echo'<span class="tinhtrang_hethang">Hết hàng</span>';
                            }else if($soluong >= 1 && $soluong <= 4){
                                echo ' <span class="tinhtrang_saphethang">Sắp hết hàng</span>';
                            }else{
                                 echo' <span class="tinhtrang_conhang">Còn hàng</span>';
                            }
                            ?>
                            <img src="admin/<?php echo $row_sanpham['pro_image']; ?>" alt="">
                            <a href="chitietsanpham.php?pro_id=<?php echo $row_sanpham['pro_id']; ?>"
                                class="deal__heading"><?php echo $row_sanpham['pro_name']; ?></a>
                            <?php 
                               if($row_sanpham['pro_giamgia'] == 0){
                                       echo ' <span class="deal__price">'.number_format(floatval($row_sanpham['pro_gia']), 0, ',', '.') . 'đ'.'</span>';
                               }else{
                                echo' <span class="deal__price">'.number_format(floatval($sale), 0, ',', '.') . 'đ'.'</span>';
                                echo' <span class="deal__sale_price"><del>'.number_format(floatval($row_sanpham['pro_gia']), 0, ',', '.') . 'đ'.'</del></span>';
                                echo' <span class="deal__percent">-'.$row_sanpham['pro_giamgia'].'%</span>';
                               }
                               ?>
                            <p class="deal__footer"><i class="fa-solid fa-tag"></i>&ensp;Giá tốt nhất thị trường
                                <br><br><i class="fa-solid fa-caret-down"></i>&ensp;Giảm giá trực tiếp
                            </p>

                        </section>

                        <?php
    }
} else {
    echo 'Không có sản phẩm nào.';
}
?>
                        <a class="xemthem" href="courses.php?dm_id=2">Xem thêm</a>
                    </div>
                    <!--Tăng sức bền-->
                    <section class="courses__content">
                        <div class="courses__text">
                            <h2 id="tangsucben" class="courses__heading heading-lv2">
                                Tăng sức bền
                            </h2>

                        </div>
                    </section>
                    <hr>
                    <div class="container_pro " style="display: flex;">
                        <div class="banner_whey">
                            <img src="./assets/img/tangsucben.png" alt="">
                        </div>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "foxprostore");

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }
    $danhmuc = '3';
    $limit = 8; // Số sản phẩm hiển thị ban đầu
    $start = 0;
    $query = "SELECT * FROM tbl_products WHERE pro_danhmuc = '$danhmuc' LIMIT $start, $limit";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row_sanpham = $result->fetch_assoc()) {
        $sale = $row_sanpham['pro_gia'] - (($row_sanpham['pro_gia'] * $row_sanpham['pro_giamgia']) / 100);
            
        // Lấy ảnh từ tbl_image dựa trên pro_id
        $query_images = 'SELECT * FROM tbl_image WHERE pro_id = ?';
        $stmt_images = $conn->prepare($query_images);
        $stmt_images->bind_param('i', $row_sanpham['pro_id']);
        $stmt_images->execute();
        $result_images = $stmt_images->get_result();
?>
                        <section class="deal">
                            <?php 
                            $soluong = $row_sanpham['pro_soluong'];
                            if($soluong == 0){
                                    echo'<span class="tinhtrang_hethang">Hết hàng</span>';
                            }else if($soluong >= 1 && $soluong <= 4){
                                echo ' <span class="tinhtrang_saphethang">Sắp hết hàng</span>';
                            }else{
                                 echo' <span class="tinhtrang_conhang">Còn hàng</span>';
                            }
                            ?>
                            <img src="admin/<?php echo $row_sanpham['pro_image']; ?>" alt="">
                            <a href="chitietsanpham.php?pro_id=<?php echo $row_sanpham['pro_id']; ?>"
                                class="deal__heading"><?php echo $row_sanpham['pro_name']; ?></a>
                            <?php 
                               if($row_sanpham['pro_giamgia'] == 0){
                                       echo ' <span class="deal__price">'.number_format(floatval($row_sanpham['pro_gia']), 0, ',', '.') . 'đ'.'</span>';
                               }else{
                                echo' <span class="deal__price">'.number_format(floatval($sale), 0, ',', '.') . 'đ'.'</span>';
                                echo' <span class="deal__sale_price"><del>'.number_format(floatval($row_sanpham['pro_gia']), 0, ',', '.') . 'đ'.'</del></span>';
                                echo' <span class="deal__percent">-'.$row_sanpham['pro_giamgia'].'%</span>';
                               }
                               ?>
                            <p class="deal__footer"><i class="fa-solid fa-tag"></i>&ensp;Giá tốt nhất thị trường
                                <br><br><i class="fa-solid fa-caret-down"></i>&ensp;Giảm giá trực tiếp
                            </p>
                            <form action="index.php" method="post" id="form_<?php echo $row_sanpham['pro_id']; ?>">
                                <input type="hidden" name="idsp" value="<?php echo $row_sanpham['pro_id']; ?>">

                            </form>
                        </section>

                        <?php
    }
} else {
    echo 'Không có sản phẩm nào.';
}
?>
                        <a class="xemthem" href="courses.php?dm_id=3">Xem thêm</a>
                    </div>

                    <!--Pre Workout-->
                    <section class="courses__content">
                        <div class="courses__text">
                            <h2 id="preworkout" class="courses__heading heading-lv2">
                                Pre Workout
                            </h2>
                        </div>
                    </section>
                    <hr>
                    <div class="container_pro " style="display: flex;">
                        <div class="banner_whey mass ">
                            <img src="./assets/img/preworkout.png" alt="">
                        </div>
                        <?php
                        
    $danhmuc = '4';
    $limit = 8; // Số sản phẩm hiển thị ban đầu
    $start = 0;
    $query = "SELECT * FROM tbl_products WHERE pro_danhmuc = '$danhmuc' LIMIT $start, $limit";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row_sanpham = $result->fetch_assoc()) {
        $sale = $row_sanpham['pro_gia'] - (($row_sanpham['pro_gia'] * $row_sanpham['pro_giamgia']) / 100);
            
        // Lấy ảnh từ tbl_image dựa trên pro_id
        $query_images = 'SELECT * FROM tbl_image WHERE pro_id = ?';
        $stmt_images = $conn->prepare($query_images);
        $stmt_images->bind_param('i', $row_sanpham['pro_id']);
        $stmt_images->execute();
        $result_images = $stmt_images->get_result();
?>
                        <section class="deal">
                            <?php 
                            $soluong = $row_sanpham['pro_soluong'];
                            if($soluong == 0){
                                    echo'<span class="tinhtrang_hethang">Hết hàng</span>';
                            }else if($soluong >= 1 && $soluong <= 4){
                                echo ' <span class="tinhtrang_saphethang">Sắp hết hàng</span>';
                            }else{
                                 echo' <span class="tinhtrang_conhang">Còn hàng</span>';
                            }
                            ?>
                            <img src="admin/<?php echo $row_sanpham['pro_image']; ?>" alt="">
                            <a href="chitietsanpham.php?pro_id=<?php echo $row_sanpham['pro_id']; ?>"
                                class="deal__heading"><?php echo $row_sanpham['pro_name']; ?></a>
                            <?php 
                               if($row_sanpham['pro_giamgia'] == 0){
                                       echo ' <span class="deal__price">'.number_format(floatval($row_sanpham['pro_gia']), 0, ',', '.') . 'đ'.'</span>';
                               }else{
                                echo' <span class="deal__price">'.number_format(floatval($sale), 0, ',', '.') . 'đ'.'</span>';
                                echo' <span class="deal__sale_price"><del>'.number_format(floatval($row_sanpham['pro_gia']), 0, ',', '.') . 'đ'.'</del></span>';
                                echo' <span class="deal__percent">-'.$row_sanpham['pro_giamgia'].'%</span>';
                               }
                               ?>
                            <p class="deal__footer"><i class="fa-solid fa-tag"></i>&ensp;Giá tốt nhất thị trường
                                <br><br><i class="fa-solid fa-caret-down"></i>&ensp;Giảm giá trực tiếp
                            </p>

                        </section>

                        <?php
    }
} else {
    echo 'Không có sản phẩm nào.';
}
?>
                        <a class="xemthem" href="courses.php?dm_id=4">Xem thêm</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats -->

        <!-- Features-02 -->
        <section class="features-02">
            <div class="container">
                <div class="features-02__inner" data-aos="fade-up" data-aos-duration="1000">
                    <figure class="features-02__img-block">
                        <div class="features-02__img-block--small">
                            <img src="./assets/img/brand_9.png" alt=""
                                class="features-02__img features-02__img--small" />
                            <img src="./assets/img/brand_12.png" alt=""
                                class="features-02__img features-02__img--small" />
                        </div>
                        <img src="./assets/img/brand_11.png" alt="" class="features-02__img features-02__img--big" />
                    </figure>
                    <div class="features-02__content">
                        <h2 class="feature-02__heading heading-lv2">
                            Luôn là người đồng hành cùng sức khỏe của bạn
                        </h2>
                        <p class="feature-02__desc">
                            87% người dùng sản phẩm bên Foxpro đều có những trải nghiệm tích cực. Với FoxPro, trải
                            nghiệm của tôi đã trở nên đơn giản và mạnh mẽ hơn bao giờ hết. Sự linh hoạt và hiệu suất
                            vượt trội của nó đã nâng cao khả năng làm việc của tôi, giúp tối ưu hóa quy trình công việc
                            và mang lại trải nghiệm người dùng tuyệt vời.
                        </p>

                    </div>
                </div>
            </div>
        </section>
        <!-- Blog -->
        <section class="blogs">
            <div class="container">
                <div class="blogs__inner">
                    <div class="blogs__content">
                        <p class="blogs__title">T H Ư Ơ N G &ensp; H I Ệ U &ensp; N Ổ I &ensp; B Ậ T</p>
                        <h2 class="blogs__heading heading-lv2">
                            Thương Hiệu Uy Tín Hàng Đầu
                        </h2>
                    </div>
                    <div class="blogs__list" data-aos="fade-up" data-aos-duration="1000">
                        <article class="blogs__item">
                            <a href="#!">
                                <figure class="blogs-item__wrap-img">
                                    <img src="./assets/img/brand_1.png" alt="" class="blogs-item__img" />
                                </figure>
                            </a>
                        </article>
                        <article class="blogs__item">
                            <a href="#!">
                                <figure class="blogs-item__wrap-img">
                                    <img src="./assets/img/brand_2.png" alt="" class="blogs-item__img" />
                                </figure>
                            </a>
                        </article>
                        <article class="blogs__item">
                            <a href="#!">
                                <figure class="blogs-item__wrap-img">
                                    <img src="./assets/img/brand_3.png" alt="" class="blogs-item__img" />
                                </figure>
                            </a>
                        </article>
                        <article class="blogs__item">
                            <a href="#!">
                                <figure class="blogs-item__wrap-img">
                                    <img src="./assets/img/brand_4.png" alt="" class="blogs-item__img" />
                                </figure>
                            </a>
                        </article>
                        <article class="blogs__item">
                            <a href="#!">
                                <figure class="blogs-item__wrap-img">
                                    <img src="./assets/img/brand_5.png" alt="" class="blogs-item__img" />
                                </figure>
                            </a>
                        </article>
                        <article class="blogs__item">
                            <a href="#!">
                                <figure class="blogs-item__wrap-img">
                                    <img src="./assets/img/brand_6.png" alt="" class="blogs-item__img" />
                                </figure>

                            </a>
                        </article>
                        <article class="blogs__item">
                            <a href="#!">
                                <figure class="blogs-item__wrap-img">
                                    <img src="./assets/img/brand_7.png" alt="" class="blogs-item__img" />
                                </figure>
                            </a>
                        </article>
                        <article class="blogs__item">
                            <a href="#!">
                                <figure class="blogs-item__wrap-img">
                                    <img src="./assets/img/brand_8.png" alt="" class="blogs-item__img" />
                                </figure>
                            </a>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>

    <!-- Footer -->
    <?php include './view/footer/footer.php' ?>