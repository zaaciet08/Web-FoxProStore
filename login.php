<?php 
include_once'./db/conect.php';
include'./view/header/header_login.php';
?>

<body>
    <?php
    
    // Bắt đầu phiên

// Lấy dữ liệu từ form đăng nhập
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Truy vấn để kiểm tra email và mật khẩu
    $sql = "SELECT * FROM tbl_accounts WHERE user_email = '$email'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row["user_password"];

        // Kiểm tra mật khẩu được nhập và mật khẩu trong cơ sở dữ liệu
        if (password_verify($password, $hashedPassword)) {
            // Đặt các biến phiên
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["user_email"] = $row["user_email"];
            $_SESSION["user_name"] = $row["user_name"];

            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Đăng nhập thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'index.php';
                });
            </script>";

            exit();
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Mật khẩu không đúng!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'login.php';
            });
        </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Tài khoản không tồn tại!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'login.php';
            });
        </script>";
}
    }    

    ?>
    <div class="login">
        <div class="container">
            <div class="login__inner">
                <figure class="login__wrap-img">
                    <div class="logo form__logo">
                        <span class="logo__text">
                            <a href="./index.php" class="logo__branch">
                                <img src="assets/img/logo.png" alt="FoxPro"></a>
                        </span>
                    </div>
                    <div class="banner">
                        <div class="brand">
                            <img src="./assets/img/logo3.png" alt="Image 2">
                            <img src="./assets/img/logo4.png" alt="Image 2">
                            <img src="./assets/img/logo1.png" alt="Image 2">
                            <img src="./assets/img/logo6.png" alt="Image 2">
                            <img src="./assets/img/logo7.png" alt="Image 2">
                        </div>
                    </div>
                    <p class="login__callout">
                        Bạn chưa có tài khoản ?
                        <a class="login__callout-link" href="./signup.php">Đăng kí ngay</a>
                    </p>
                </figure>

                <form class="login__form" action="login.php" method="POST" autocomplete="on">
                    <a href="./index.php">
                        <div class="back-home">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>
                    </a>
                    <h2 class="login-form__heading">
                        Xin chào,<br />Chào mừng trở lại !
                    </h2>
                    <p class="login-form__desc">Vui lòng đăng nhập để tiếp tục</p>

                    <div class="form__group">
                        <input required type="email" id="email" class="form__input" name="email" placeholder="Email"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" />
                        <label for="email" class="form__label">Email</label>
                        <span class="form__icon">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>

                    <div class="form__group password-wrapper">
                        <input required type="password" id="password" name="password" class="form__input"
                            placeholder="Password" autocomplete="off" />
                        <label for="password" class="form__label">Mật khẩu</label>
                        <span class="form__icon">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                    </div>

                    <div class="form__row">
                        <a href="javascript:void(0);" class="form__forgot" id="openForgotPasswordModal">Quên mật khẩu
                            ?</a>
                    </div>

                    <button type="submit" class="form__btn" name="submit" style="cursor: pointer;">Đăng nhập</button>
                    <p class="mobile-login__callout">
                        Bạn chưa có tài khoản ?
                        <a class="mobile-login__callout-link" href="./signup.php">Đăng kí ngay</a>
                    </p>
                </form>
                <?php 
                    include ('forgotpass.php') ;
                    ?>
                <form action="login.php" method="POST">
                    <!-- Thêm modal quên mật khẩu -->
                    <div id="forgotPasswordModal" class="modal">
                        <div class="modal-content">
                            <span class="close" id="closeForgotPasswordModal">&times;</span>
                            <h2 class="login-form__heading">
                                Khôi phục mật khẩu !
                            </h2>
                            <p class="login-form__desc">Nhập địa chỉ email của bạn để khôi phục mật khẩu.</p>
                            <div class="form__group">
                                <input required type="email" id="forgotPasswordEmail" class="form__input" name="email1"
                                    placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" />
                                <label for="email" class="form__label">Email</label>
                                <span class="form__icon">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                            </div>
                            <button type="submit" class="form__btn" name="submit1" style="cursor: pointer;">Gửi</button>

                </form>

            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
    // Lấy modal và nút đóng
    var forgotPasswordModal = document.getElementById('forgotPasswordModal');
    var openForgotPasswordModalBtn = document.getElementById('openForgotPasswordModal');
    var closeForgotPasswordModalBtn = document.getElementById('closeForgotPasswordModal');


    // Đóng modal khi click vào nút đóng
    closeForgotPasswordModalBtn.onclick = function() {
        forgotPasswordModal.style.display = 'none';
    }

    // Hiển thị modal khi click vào liên kết "Quên mật khẩu?"
    openForgotPasswordModalBtn.onclick = function() {
        forgotPasswordModal.style.display = 'block';
    }


    // Đóng modal nếu click bên ngoài nội dung modal
    window.onclick = function(event) {
        if (event.target == forgotPasswordModal) {
            forgotPasswordModal.style.display = 'none';
        }
    }

    // Hàm xử lý khi người dùng gửi yêu cầu đặt lại mật khẩu
    function submitForgotPassword() {


        // Đóng modal sau khi hoàn thành xử lý
        forgotPasswordModal.style.display = 'none';
    }
    </script>
    <script>
    // Sử dụng GSAP để tạo hiệu ứng chuyển động
    gsap.registerPlugin(ScrollTrigger);

    // Lấy danh sách các ảnh trong banner
    const images = document.querySelectorAll('.banner__img');

    // Thiết lập hiệu ứng ScrollTrigger
    gsap.from(images, {
        scrollTrigger: {
            trigger: '.banner__wrap',
            start: 'top center', // Hiệu ứng bắt đầu khi đối tượng hiện trong viewport
            end: 'bottom center', // Hiệu ứng kết thúc khi đối tượng mất khỏi viewport
            scrub: 1, // Hiệu ứng chuyển động liên tục khi cuộn
        },
        x: 300, // Chuyển động theo trục X
        opacity: 0, // Tăng độ mờ
        stagger: 0.2, // Tạo khoảng trễ giữa các ảnh
    });
    </script>

    <!-- Thêm thư viện GSAP vào trang web của bạn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.2/gsap.min.js"></script>

</body>

</html>