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
                                <?php
                                       $sql = "SELECT * FROM tbl_danhmuc";
                                       $result = $conn->query($sql);
                                       if ($result->num_rows > 0) {
                                           while ($row = $result->fetch_assoc()) {
                                            echo'<li class="nav-courses__item">'; 
                                            echo'<a href="courses.php?dm_id='. $row["pro_danhmuc"] .'" class="nav-courses__link">'. $row["dm_name"] .'</a>';
                                            echo' </li>';
                                           }
                                       } else {
                                           echo "Không có dữ liệu trong bảng tbl_danhmuc";
                                       }
                                    ?>
                                </ul>
                            </nav>
                            <div class="nav__link nav__link--action">Danh mục sản phẩm</div>
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
                    echo '<span class="name"><i class="fa-solid fa-bell"></i></span>';
                    echo '<div class="nav__item nav__item--action">';
                    echo '<nav class="nav__courses">';  
                    echo '<ul class="nav-courses__list">';
                    echo '<li class="nav-courses__item">';
                    echo '<a href="info.php" class="nav-courses__link">Thông tin tài khoản</a></li>';           
                    echo '<li class="nav-courses__item">';                
                    echo '<a href="./php/logout.php" class="nav-courses__link" style="color: red;"><i class="fa-solid fa-arrow-right-from-bracket"></i> &ensp;Đăng xuất</a></li>';            
                    echo '</ul>';            
                    echo '</nav>';               
                    echo '<a class="header-action__login"> <i class="fa-regular fa-user"></i></a>';            
                    echo '</div>';      
                    echo '<a href="cart.php" class="header-action__cart"><i class="fa-solid fa-cart-shopping"></i></a>';
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
    echo '<span class="name"><i class="fa-solid fa-bell-slash"></i></span>';
    echo '<div class="nav__item nav__item--action">';
    echo '<nav class="nav__courses">';  
    echo '<ul class="nav-courses__list">';           
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
                    <form action="timkiem.php" method="get">  
                    <input type="text" class="header-search__input" name="search" id="search" placeholder="Tìm kiếm..."/>
                    </form>
                </div>
                <script>
        $(document).ready(function () {
            // Sự kiện khi người dùng nhập vào ô tìm kiếm
            $('#search').on('input', function () {
                var keyword = $(this).val();

                // Gửi yêu cầu AJAX để tìm kiếm sản phẩm
                $.ajax({
                    type: 'GET',
                    url: 'search.php',
                    data: { search: keyword },
                    success: function (response) {
                        $('#search-results').html(response);
                    }
                });
            });
        });
    </script>
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
                        <a href="./info.php" class="menu-navbar__link">Tài khoản</a>
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