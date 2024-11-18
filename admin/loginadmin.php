<?php
  include_once 'db/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Fox Pro</title>
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
        <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">
    </script>

</head>
<body >
   <div class="overlay"></div>
   <div class="login-container">
      <div>
         <div class="logo">
            <i class="fas fa-hat-wizard"></i>
            <span>FOXPRO STORE</span>
         </div>
        
      </div>

      <div class="form-login">
         <form action="loginadmin.php" method="POST" class="form" id="form-2">
            <h3 class="heading">Đăng nhập trang quản trị</h3>      
            <div class="spacer"></div>
      
            <div class="form-group">
              <label for="" class="form-label">Tài khoản</label>
              <input name="username" type="text" placeholder="VD: admin...." class="form-control">
              <span class="form-message"></span>
            </div>
      
            <div class="form-group">
              <label for="password" class="form-label">Mật khẩu</label>
              <input id="password" name="password" type="password" placeholder="Nhập mật khẩu..." class="form-control">
              <span class="form-message"></span>
            </div>

            <div class="sign-up">
               <div>
                  <button type="submit" name="btn_login" class="form-submit">Đăng nhập</button>
                  <i class="fas fa-chevron-right"></i>
               </div>
            </div>
          </form>
      </div>
   </div>
 <?php 
if (isset($_POST['btn_login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  if(empty($username) || empty($password)){
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Vui lòng điền đầy đủ thông tin!',
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        window.location.href = 'loginadmin.php';
    });
</script>";
  }else if($username == 'admin' && $password == '123456'){
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Xin chào admin...!',
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        window.location.href = 'trangchu.php';
    });
</script>";
  }else if($username != 'admin'){
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Tài khoản admin không đúng!',
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        window.location.href = 'loginadmin.php';
    });
</script>";
  }else if($password != '123456'){
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Mật khẩu admin không đúng!',
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        window.location.href = 'loginadmin.php';
    });
</script>";
  }
  else{
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Tài khoản admin không tồn tại!',
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        window.location.href = 'loginadmin.php';
    });
</script>";
  }
}
 ?>

   <script src="validate.js"></script>
   <script>
      // Select all elements with data-toggle="tooltips" in the document
      $('[data-toggle="tooltip"]').tooltip();

      // Select a specified element
      // $('#myTooltip').tooltip();
    

    document.addEventListener('DOMContentLoaded', function () {
      // Mong muốn của chúng ta
      Validator({
        form: '#form-1',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
          Validator.isRequired('#fullname', 'Vui lòng nhập tên đầy đủ của bạn'),
          Validator.isEmail('#email'),
          Validator.minLength('#password', 6),
          Validator.isRequired('#password_confirmation'),
          Validator.isConfirmed('#password_confirmation', function () {
            return document.querySelector('#form-1 #password').value;
          }, 'Mật khẩu nhập lại không chính xác')
        ],
        onSubmit: function (data) {
          // Call API
          console.log(data);
        }
      });


      Validator({
        form: '#form-2',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
          Validator.isEmail('#email'),
          Validator.minLength('#password', 6),
        ],
        onSubmit: function (data) {
          // Call API
          console.log(data);
        }
      });
    });

  </script>
</body>
</html>