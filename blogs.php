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
    <link rel="stylesheet" href="./assets/css/blogs.css" />
    <link rel="stylesheet" href="assets/css/blogs-responsive.css" />
</head>

<body>
    <!-- Header -->
    <?php include'php/menu.php' ?>
    <!-- BreadCrumb -->
    <div class="page-title-area">
        <div class="text">
            <h2 class="heading-lv2">Our Blog</h2>
            <nav>
                <ul class="breadcrumb">
                    <li class="breadcrumb__item">
                        <a href="./index.php" class="breadcrumb__link">Home</a>
                    </li>
                    <li class="breadcrumb__item">
                        <a href="./blogs.php" class="breadcrumb__link">Blog</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- Blogs -->
    <div class="blogs-area">
        <div class="container">
            <div class="blogs__inner">
                <main class="blogs__list">
                    <article class="blogs__item">
                        <a href="#!">
                            <figure class="blogs-item__wrap-img">
                                <img src="./assets/img/pre-workout-nao-tot-gymstore-thumbnail.png" alt=""
                                    class="blogs-item__img" />
                            </figure>
                            <div class="blogs__infor">
                                <div class="blogs-item__row">
                                    <div class="blogs-item__date">
                                        <i class="fa-regular fa-calendar-days"></i>
                                        <span>Thứ 3 , 21-11-2023</span>
                                    </div>
                                </div>
                                <h2 class="blogs-item__heading">

                                    Top 10 Pre Workout chắc chắn sẽ không làm bạn thất vọng

                                </h2>
                                <p class="blogs-item__desc">
                                    Pre Workout là thực phẩm bổ sung được nhiều người ưa chuộng bởi khả năng thúc đẩy
                                    sức mạnh, sức bền của cơ bắp, giúp...
                                </p>
                                <a href="#!" class="btn blogs-item__btn">Xem thêm</a>
                            </div>
                        </a>
                    </article>
                    <article class="blogs__item">
                        <a href="#!">
                            <figure class="blogs-item__wrap-img">
                                <img src="./assets/img/uong-may-vien-omega-3-moi-ngay.webp" alt=""
                                    class="blogs-item__img" />
                            </figure>
                            <div class="blogs__infor">
                                <div class="blogs-item__row">
                                    <div class="blogs-item__date">
                                        <i class="fa-regular fa-calendar-days"></i>
                                        <span>Chủ nhật , 03-09-2023</span>
                                    </div>
                                </div>
                                <h2 class="blogs-item__heading">
                                    Uống mấy viên Omega 3 mỗi ngày là đủ?
                                </h2>
                                <p class="blogs-item__desc">
                                    Omega 3 là axit béo có nhiều lợi ích tốt cho sức khỏe nên thường được lựa chọn để bổ
                                    sung hàng ngày. Vậy uống...
                                </p>
                                <a href="#!" class="btn blogs-item__btn">Xem thêm</a>
                            </div>
                        </a>
                    </article>
                    <article class="blogs__item">
                        <a href="#!">
                            <figure class="blogs-item__wrap-img">
                                <img src="./assets/img/omega-3-va-omega-3-6-9-loai-nao-tot-hon.webp" alt=""
                                    class="blogs-item__img" />
                            </figure>
                            <div class="blogs__infor">
                                <div class="blogs-item__row">
                                    <div class="blogs-item__date">
                                        <i class="fa-regular fa-calendar-days"></i>
                                        <span>Chủ nhật , 03-09-2023</span>
                                    </div>
                                </div>
                                <h2 class="blogs-item__heading">
                                    Omega 3 và Omega 3-6-9 loại nào tốt hơn? Giải đáp chi tiết
                                </h2>
                                <p class="blogs-item__desc">
                                    Omega 3, Omega 6 và Omega 9 đều là những axit béo có nhiều lợi ích cho sức khỏe.
                                    Chúng xuất hiện trong thực phẩm...
                                </p>
                                <a href="#!" class="btn blogs-item__btn">Xem thêm</a>
                            </div>
                        </a>
                    </article>
                    <article class="blogs__item">
                        <a href="#!">
                            <figure class="blogs-item__wrap-img">
                                <img src="./assets/img/2023-09-28-10-10-18-rpd3pbknlb.webp" alt=""
                                    class="blogs-item__img" />
                            </figure>
                            <div class="blogs__infor">
                                <div class="blogs-item__row">
                                    <div class="blogs-item__date">
                                        <i class="fa-regular fa-calendar-days"></i>
                                        <span>Thứ 5 , 28-09-2023</span>
                                    </div>
                                </div>
                                <h2 class="blogs-item__heading">
                                    CÙNG FOXPRO VUI TẾT TRUNG THU - RINH NGÀN ƯU ĐÃI
                                </h2>
                                <p class="blogs-item__desc">
                                    Đón mừng một mùa Trung Thu nữa lại về, để mùa Trăng Rằm Tháng 8 năm nay của mọi
                                    người thêm phần trọn vẹn, FoxPro...
                                </p>
                                <a href="#!" class="btn blogs-item__btn">Xem thêm</a>
                            </div>
                        </a>
                    </article>
                </main>
                <!-- Mobile Blogs -->
                <div class="mobile-blogs">
                    <div class="mobile-blogs__list">
                        <article class="mobile-blogs__item">
                            <a href="#!">
                                <figure class="mobile-blogs-item__wrap-img">
                                    <img src="./assets/img/pre-workout-nao-tot-gymstore-thumbnail.png" alt=""
                                        class="mobile-blogs-item__img" />
                                </figure>
                                <section class="mobile-blogs-item__infor">
                                    <h3 class="mobile-blogs-item__heading">
                                        Top 10 Pre Workout chắc chắn sẽ không làm bạn thất vọng
                                    </h3>
                                    <div class="mobile-blogs-item__row">
                                        <div class="date">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            <span>Thứ 3 , 21-11-2023</span>
                                        </div>
                                    </div>
                                </section>
                            </a>
                        </article>
                        <article class="mobile-blogs__item">
                            <a href="#!">
                                <figure class="mobile-blogs-item__wrap-img">
                                    <img src="./assets/img/uong-may-vien-omega-3-moi-ngay.webp" alt=""
                                        class="mobile-blogs-item__img" />
                                </figure>
                                <section class="mobile-blogs-item__infor">

                                    <h3 class="mobile-blogs-item__heading">
                                        Uống mấy viên Omega 3 mỗi ngày là đủ?
                                    </h3>
                                    <div class="mobile-blogs-item__row">
                                        <div class="date">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            <span>Chủ nhật , 03-09-2023</span>
                                        </div>

                                    </div>
                                </section>
                            </a>
                        </article>
                        <article class="mobile-blogs__item">
                            <a href="#!">
                                <figure class="mobile-blogs-item__wrap-img">
                                    <img src="./assets/img/omega-3-va-omega-3-6-9-loai-nao-tot-hon.webp" alt=""
                                        class="mobile-blogs-item__img" />
                                </figure>
                                <section class="mobile-blogs-item__infor">

                                    <h3 class="mobile-blogs-item__heading">
                                        Omega 3 và Omega 3-6-9 loại nào tốt hơn? Giải đáp chi tiết
                                    </h3>
                                    <div class="mobile-blogs-item__row">
                                        <div class="date">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            <span>Chủ nhật , 03-09-2023</span>
                                        </div>

                                    </div>
                                </section>
                            </a>
                        </article>
                        <article class="mobile-blogs__item">
                            <a href="#!">
                                <figure class="mobile-blogs-item__wrap-img">
                                    <img src="./assets/img/2023-09-28-10-10-18-rpd3pbknlb.webp" alt=""
                                        class="mobile-blogs-item__img" />
                                </figure>
                                <section class="mobile-blogs-item__infor">

                                    <h3 class="mobile-blogs-item__heading">
                                        CÙNG FOXPRO VUI TẾT TRUNG THU - RINH NGÀN ƯU ĐÃI
                                    </h3>
                                    <div class="mobile-blogs-item__row">
                                        <div class="date">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            <span>Thứ 5 , 28-09-2023</span>
                                        </div>

                                    </div>
                                </section>
                            </a>
                        </article>
                    </div>
                </div>
                <aside class="sidebar">
                    <div class="recent-posts">
                        <h3 class="blogs-sidebar__heading">Dinh dưỡng</h3>
                        <div class="blogs-sidebar__seperate"></div>
                        <div class="recent-posts__list">
                            <a href="#!">
                                <article class="recent-post__item">
                                    <figure class="recent-post-item__thumb">
                                        <img src="./assets/img/blog-1.webp" alt="" class="recent-post-item__img" />
                                    </figure>
                                    <div class="recent-post-item__infor">
                                        <span class="recent-post-item__date">Thứ Ba, 11-07-2023</span>
                                        <h4 class="recent-post-item__heading">

                                            Ăn gì bổ não? Gợi ý 17 thực phẩm tốt nhất cho não bộ

                                        </h4>
                                    </div>
                                </article>
                            </a>
                            <a href="#!">
                                <article class="recent-post__item">
                                    <figure class="recent-post-item__thumb">
                                        <img src="./assets/img/blog-2.webp" alt="" class="recent-post-item__img" />
                                    </figure>
                                    <div class="recent-post-item__infor">
                                        <span class="recent-post-item__date">Thứ Sáu, 23/06/2023</span>
                                        <h4 class="recent-post-item__heading">
                                        Tinh bột chậm là gì? Có gì khác với tinh bột nhanh?
                                        </h4>
                                    </div>
                                </article>
                            </a>
                            <a href="#!">
                                <article class="recent-post__item">
                                    <figure class="recent-post-item__thumb">
                                        <img src="./assets/img/blog-3.webp" alt="" class="recent-post-item__img" />
                                    </figure>
                                    <div class="recent-post-item__infor">
                                        <span class="recent-post-item__date">Thứ Sáu, 23/06/2023</span>
                                        <h4 class="recent-post-item__heading">
                                        Dầu oliu có tác dụng gì? 11 lợi ích tuyệt vời của dầu oliu với sức khỏe
                                        </h4>
                                    </div>
                                </article>
                            </a>
                            <a href="#!">
                                <article class="recent-post__item">
                                    <figure class="recent-post-item__thumb">
                                        <img src="./assets/img/blog-4.webp" alt="" class="recent-post-item__img" />
                                    </figure>
                                    <div class="recent-post-item__infor">
                                        <span class="recent-post-item__date">Thứ Sáu, 23/06/2023</span>
                                        <h4 class="recent-post-item__heading">
                                        Top 9 thực phẩm nên ăn khi nhịn ăn gián đoạn
                                        </h4>
                                    </div>
                                </article>
                            </a>
                        </div>
                    </div>
                    
                    
                </aside>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include'./view/footer/footer.php'?>