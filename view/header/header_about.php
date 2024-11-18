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
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const images = document.querySelectorAll(".brand img");
        const leftArrow = document.querySelector(".arrow-left");
        const rightArrow = document.querySelector(".arrow-right");
        let currentIndex = 0;

        function showImage(index) {
            images.forEach((image, i) => {
                if (i === index) {
                    image.classList.add("active");
                } else {
                    image.classList.remove("active");
                }
            });
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }

        function previousImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        }

        leftArrow.addEventListener("click", previousImage);
        rightArrow.addEventListener("click", nextImage);

        setInterval(nextImage, 3000);
    });
    </script>
    
</head>
<body>
    
<header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="logo">
                    <span class="logo__text">
                        <span class="logo__branch">
                            <img src="assets/img/logo.png" alt="FoxPro"></span>
                    </span>
                </div>
                <nav class="nav">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="./index.php" class="nav__link">Trang chủ</a>
                        </li>
                        <li class="nav__item">
                            <a href="./about.php" class="nav__link">Giới thiệu</a>
                        </li>

                        <li class="nav__item nav__item--action">
                            <nav class="nav__courses">
                                <ul class="nav-courses__list">
                                    <li class="nav-courses__item">
                                        <a href="#wheyprotein" class="nav-courses__link">Whey Protein</a>
                                    </li>
                                    <li class="nav-courses__item">
                                        <a href="#!" class="nav-courses__link">Mass Gainer</a>
                                    </li>
                                    <li class="nav-courses__item">
                                        <a href="#!" class="nav-courses__link">Tăng sức bền</a>
                                    </li>
                                    <li class="nav-courses__item">
                                        <a href="#!" class="nav-courses__link">Pre Workout</a>
                                    </li>

                                </ul>
                            </nav>
                            <a href="./courses.php" class="nav__link nav__link--action">Sản phẩm</a>
                        </li>
                        <li class="nav__item">
                            <a href="./blogs.php" class="nav__link">Blogs</a>
                        </li>
                    </ul>
                </nav>
                
                
                <!-- Sửa lại trang vào tài khoản -->
                <?php
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    // Truy vấn SQL để lấy dữ liệu từ bảng tbl_cart dựa trên user_id
    $query = "SELECT * FROM tbl_accounts WHERE user_id = ?";
    
    // Sử dụng prepared statement để tránh SQL injection
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $user_id);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Hiển thị thông tin tài khoản
                    echo '<div href="#!" class="header__action">';
                    echo '<span class="name">Xin chào , ' . $row['user_name'] . '</span>';
                    echo '<div class="nav__item nav__item--action">';
                    echo '<nav class="nav__courses">';  
                    echo '<ul class="nav-courses__list">';
                    echo '<li class="nav-courses__item">';
                    echo '<a href="#!" class="nav-courses__link">Thông tin tài khoản</a></li>';           
                    echo '<li class="nav-courses__item">';                
                    echo '<a href="./php/logout.php" class="nav-courses__link" style="color: red;">Đăng xuất</a></li>';            
                    echo '</ul>';            
                    echo '</nav>';               
                    echo '<a class="header-action__login"> <i class="fa-regular fa-user"></i></a>';            
                    echo '</div>';      
                    echo '<a href="./cart.php" class="header-action__cart"><i class="fa-solid fa-cart-shopping"></i></a>';
                    echo '</div>';
                }
            } else {
                // Có user_id nhưng không có dữ liệu tài khoản
            }
        } else {
            echo "Lỗi truy vấn: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Lỗi prepare statement: " . mysqli_error($conn);
    }
} else {
    // Người dùng chưa đăng nhập
    echo '<div href="#!" class="header__action">';
    echo '<div class="nav__item nav__item--action">';
    echo '<nav class="nav__courses">';  
    echo '<ul class="nav-courses__list">';
    echo '<li class="nav-courses__item">';
    echo '<a href="#!" class="nav-courses__link">Thông tin tài khoản</a></li>';           
    echo '<li class="nav-courses__item">';                
    echo '<a href="login.php" class="nav-courses__link" style="color: red;">Đăng nhập</a></li>';            
    echo '</ul>';            
    echo '</nav>';               
    echo '<a class="header-action__login"> <i class="fa-regular fa-user"></i></a>';            
    echo '</div>';      
    echo '<a href="./cart.php" class="header-action__cart"><i class="fa-solid fa-cart-shopping"></i></a>';
    echo '</div>';
}
?>

            <div class="header__search">
                <input type="text" class="header-search__input" placeholder="Tìm kiếm..." />
                <button type="button" class="search__btn">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.11111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.11111C15.2222 4.18375 12.0385 1 8.11111 1C4.18375 1 1 4.18375 1 8.11111C1 12.0385 4.18375 15.2222 8.11111 15.2222Z"
                            stroke="#c9d2da" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M17 17L13.1333 13.1333" stroke="#c9d2da" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>

            <a href="./cart.php" class="menu-action__cart hide-on-pc"><i class="fa-solid fa-cart-shopping"></i></a>
            <label for="menu-checkbox" class="toogle-menu">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path fill="currentcolor"
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                </svg>
            </label>
        </div>
        </div>
    </header>

    <!-- Header tablet & mobile -->
    <div class="menu-header">
        <input type="checkbox" name="" id="menu-checkbox" class="menu-checkbox" hidden />
        <label for="menu-checkbox" class="menu-overlay"></label>
        <div class="hide-on-pc menu-drawer">
            <div class="logo">
                <span class="logo__text">
                    <span class="logo__branch">
                        Fox Pro <span style="color: orange">.</span></span>
                </span>
            </div>
            <label for="menu-checkbox" class="menu-close"><i class="fa-solid fa-xmark"></i></label>
            <form class="menu-search-form">
                <input type="text" class="menu-search__input" placeholder="Tìm kiếm..." />
                <!--Sửa nút tìm kiếm-->
                <button class="menu-search__icon"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div class="seperate tablet-seperate"></div>
            <nav class="menu-navbar">
                <ul class="menu-navbar__list">
                    <li class="menu-navbar__item">
                        <a href="./index.php" class="menu-navbar__link">Trang chủ</a>
                    </li>
                    <li class="menu-navbar__item">
                        <a href="./about.php" class="menu-navbar__link">
                            Giới thiệu</a>
                    </li>
                    <li class="menu-navbar__item menu-navbar__item--action">
                        <a href="./courses.php" class="menu-navbar__link menu-navbar__link--action">
                            Sản phẩm</a>
                    </li>
                    <li class="menu-navbar__item">
                        <a href="./blogs.php" class="menu-navbar__link">Blogs</a>
                    </li>

                    <div class="seperate"></div>
                    <li class="menu-navbar__item">
                        <a href="./index.php" class="menu-navbar__link">Tài khoản</a>
                    </li>
                    <?php
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    // Truy vấn SQL để lấy dữ liệu từ bảng tbl_cart dựa trên user_id
    $query = "SELECT * FROM tbl_accounts WHERE user_id = ?";
    
    // Sử dụng prepared statement để tránh SQL injection
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $user_id);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                     // Người dùng chưa đăng nhập
       echo '<li class="menu-navbar__item">';
       echo '<a href="./php/logout.php" class="menu-navbar__link" style="color: red" name="logout">Đăng xuất</a>';
       echo '</li>';
                }
            } else {
                // Có user_id nhưng không có dữ liệu tài khoản
            }
        } else {
            echo "Lỗi truy vấn: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Lỗi prepare statement: " . mysqli_error($conn);
    }
} else {
    // Người dùng chưa đăng nhập
    echo '<li class="menu-navbar__item">';
    echo '<a href="./login.php" class="menu-navbar__link" style="color: red" name="logout">Đăng nhập</a>';
    echo '</li>';
}
?> 
                </ul>
            </nav>
        </div>
    </div>
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

