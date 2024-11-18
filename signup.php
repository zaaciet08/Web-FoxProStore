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
    <link rel="stylesheet" href="./assets/css/signup.css" />
    <link rel="stylesheet" href="./assets/css/signup-responsive.css" />
 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="./js/showpass.js"></script>
    <script src="./js/validateform.js"></script>
    <script src="js/banner_login.js"></script>

</head>

<body>
    <?php
    include_once ('./db/conect.php');
    require "./PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
    require "./PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
    require './PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
// Kết nối đến cơ sở dữ liệu

if(isset($_POST["submit"])){
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_1 = $_POST["repeat-password"];
// Tạo băm password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


// Kiểm tra email có tồn tại trong cơ sở dữ liệu hay không
$check_email_query = "SELECT * FROM tbl_accounts WHERE user_email = ?";
$check_stmt = mysqli_prepare($conn, $check_email_query);
mysqli_stmt_bind_param($check_stmt, "s", $email);
mysqli_stmt_execute($check_stmt);
mysqli_stmt_store_result($check_stmt);
 if (mysqli_stmt_num_rows($check_stmt) > 0) {
    // Email đã tồn tại trong cơ sở dữ liệu, hiển thị thông báo lỗi
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Email đã tồn tại!',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = 'signup.php';
        });
    </script>";
}
else if($password_1!=$password){
     echo "<script>
Swal.fire({
    icon: 'error',
    title: 'Mật khẩu không trùng khớp!',
    showConfirmButton: false,
    timer: 1500
}).then(function() {
    window.location.href = 'signup.php';
});
</script>";
}
 else  if (password_verify($password_1, $hashedPassword)) {
    $sql = "INSERT INTO tbl_accounts (user_name, user_email, user_password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Đăng ký thành công!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'login.php';
            });
        </script>";
         } try {
    
     $mail->isSMTP();  
     $mail->CharSet  = "utf-8";
     $mail->Host = 'smtp.gmail.com';  //SMTP servers
     $mail->SMTPAuth = true; // Enable authentication
$nguoigui = 'foxprocompany2023@gmail.com';
$matkhau = 'gkfh irvl yzvw boni';// 
$tennguoigui = '[FOXPRO STORE]';
     $mail->Username = $nguoigui; // SMTP username
     $mail->Password = $matkhau;   // SMTP password
     $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
     $mail->Port = 465;  // port to connect to                
     $mail->setFrom($nguoigui, $tennguoigui ); 
     $to = $email;
     $to_name = $name;
     
     $mail->addAddress($to, $to_name); //mail và tên người nhận
    
     $mail->isHTML(true);  // Set email format to HTML
     $mail->Subject = '[TB] CHÚC MỪNG BẠN ĐÃ ĐĂNG KÍ TÀI KHOẢN THÀNH CÔNG !';      
     $noidungthu = "<b>DỊCH VỤ CHĂM SÓC KHÁCH HÀNG CỦA FOXPRO STORE!</b><br>Cảm ơn bạn đã đăng kí tài khoản tại Foxpro Store  <br> Nhanh tay mua sắm để hưởng nhiều chính sách ưu đãi tại cửa hàng !" ;
     $mail->Body = $noidungthu;
     
     $mail->smtpConnect( array(
         "ssl" => array(
             "verify_peer" => false,
             "verify_peer_name" => false,
             "allow_self_signed" => true
         )
     ));
     $mail->send();
     
 } catch (Exception $e) {
     echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
 }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
} 
?>
    <div class="sign-up">
        <div class="container">
            <div class="sign-up__inner">

                <form class="sign-up__form" id="form-1" action="signup.php" method="POST">
                    <a href="./index.php">
                        <div class="back-home"><i class="fa-solid fa-circle-xmark"></i></div>
                    </a>
                    <h2 class="sign-up__heading">Đăng kí tài khoản</h2>
                    <p class="sign-up__desc">
                        Vui lòng điền đầy đủ thông tin phía dưới để tạo tài khoản !
                    </p>

                    <div class="form__group">
                        <input class="form__input" type="text" id="name" name="name" placeholder="Họ và tên" />
                        <label class="form__label" for="name">Họ và tên</label>
                        <span class="form__icon"><i class="fa-solid fa-user" style="color: #000000;"></i>
                        </span>
                    </div>
                    <div id="infoError" style="color: red;"></div>

                    <div class="form__group">
                        <input class="form__input" type="email" id="email" name="email" placeholder="Email"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" />
                        <label class="form__label" for="email">Email</label>
                        <span class="form__icon"><i class="fa-solid fa-envelope" style="color: #000000;"></i></span>

                    </div>
                    <div class="form__group password-wrapper">
                        <input class="form__input" type="password" id="password" name="password"
                            placeholder="Password" />
                        <label class="form__label" for="password">Mật khẩu</label>
                        <span class="form__icon">
                            <div id="eyes">
                                <span id="open-eye" class="material-symbols-outlined">
                                    <i class="fa-solid fa-eye" style="color: #000000;"></i>
                                </span>
                                <span id="closed-eye" class="material-symbols-outlined">
                                    <i class="fa-solid fa-eye-slash" style="color: #000000;"></i>
                                </span>
                            </div>
                        </span>
                    </div>
                    <div id="passError" style="color: red;"></div>

                    <div class="form__group password-wrapper2">
                        <input required class="form__input" type="password" id="repeat-password" name="repeat-password"
                            placeholder="Repeat Password" />
                        <label class="form__label" for="repeat-password">Nhập lại mật khẩu</label>
                        <span class="form__icon">
                            <div id="eyes2">
                                <span id="open-eye" class="material-symbols-outlined">
                                    <i class="fa-solid fa-eye" style="color: #000000;"></i>
                                </span>
                                <span id="closed-eye" class="material-symbols-outlined">
                                    <i class="fa-solid fa-eye-slash" style="color: #000000;"></i>
                                </span>
                            </div>
                        </span>
                    </div>
                    <div id="pass1Error" style="color: red;"></div>

                    <input type="submit" onclick="submitForm()" class="sign-form__btn" value="Đăng kí" name="submit">
                    <p class="mobile-sign-up__callout">
                        Bạn đã có tài khoản ?
                        <a href="./login.php" class="mobile-sign-up__callout-link">Đăng nhập ngay</a>
                    </p>

                </form>
                <figure class="sign-up__wrap-img">
                    <div class="logo form__logo">
                        <a href="#" class="logo__branch">Fox PRO
                            <span style="color: orange">.</span></a>
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
                    <p class="sign-up__callout">
                        Đã có tài khoản?
                        <a href="./login.php" class="sign-up__callout-link">Đăng nhập ngay</a>
                    </p>
                </figure>
            </div>
        </div>
    </div>

</body>

</html>