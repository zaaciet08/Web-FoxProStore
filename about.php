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
    <link rel="stylesheet" href="./assets/css/about.css" />
    <link rel="stylesheet" href="./assets/css/about-responsive.css" />
    <link rel="stylesheet" href="./assets/css/brand.css">
    <script src="js/banner.js"></script>
</head>

<body>
    <!--Header-->
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


    <a href="about.php" class="heading-lv2">
        Giới thiệu
    </a>
    <a href="index.php" class="heading-lv2">
        / Trang chủ
    </a>

    <main class="main-content">
        <!-- About -->
        <?php 
$sql = "SELECT * FROM tbl_bannerabout";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
}
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo'<section class="about">';
        echo'<div class="container">';
        echo'    <div class="about__inner">';
        echo'        <figure class="about__wrap-img">';
        echo'            <img src="admin/'.$row['ab_image'].'" alt="" class="about__img" />';
        echo'        </figure>';
        echo'        <section class="about__content">';
        echo'            <h2 class="heading-lv2 about__heading">';
        echo'              '.$row['ab_tieude'].'';
        echo'            </h2>';
        echo'            <p class="about__desc">';
        echo'               '.$row['ab_text'].'';
        echo'            </p>';
        echo'        </section>';
        echo'    </div>';
        echo'</div>';
        echo'</section>';
    }
}
        ?>
        
        <!-- Lecturers -->

        <!-- Feedback -->
        <section class="feedback">
            <div class="container">
                <div class="feedback__inner">
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
                    <div class="feedback__dots-group">
                        <span class="feedback__dot feedback__dot--action"></span>
                        <span class="feedback__dot"></span>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include'./view/footer/footer.php'?>