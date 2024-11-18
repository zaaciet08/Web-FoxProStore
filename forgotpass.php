<?php
include_once('./db/conect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit1"])) {
        $email = $_POST["email1"];
        
        $stmtSelect = $conn->prepare("SELECT * FROM tbl_accounts WHERE user_email = ?");
        $stmtSelect->bind_param("s", $email); 
        $stmtSelect->execute();
        
        
        $result = $stmtSelect->get_result(); 
        if ($result->num_rows > 0) {
            // Email tồn tại trong cơ sở dữ liệu
            $row = $result->fetch_assoc();
            $newPassword = substr( md5(rand (0,999999)), 0, 8);
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $sql = "UPDATE tbl_accounts SET user_password=? WHERE user_email=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$hashedPassword, $email]);            
        
            $kq=GuiMatKhauMoi($email, $newPassword);  
            if ($kq == true) {
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Mật khẩu mới đã được gửi về email của bạn',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'login.php';
                });
            </script>";
            } else {
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Không thể gửi yêu cầu lấy lại mật khẩu!',
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
                icon: 'warning',
                title: 'Email người dùng không tồn tại',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'login.php';
            });
        </script>";
        }
    }
}

function GuiMatKhauMoi($email, $newPassword) {
    require "./PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
    require "./PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
    require './PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
    $mail = new PHPMailer(true);
    
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;                
        $mail->Username = 'foxprocompany2023@gmail.com';   
        $mail->Password = 'gkfh irvl yzvw boni';      
        $mail->SMTPSecure = 'ssl'; 
        $mail->Port = 465;                  
        $mail->setFrom('foxprocompany2023@gmail.com', 'FOXPRO STORE');
$mail->addAddress($email);  
        $mail->isHTML(true);  
        $mail->Subject = '[YÊU CẦU CUNG CẤP LẠI MẬT KHẨU]';  
        $noidungthu = "<b>DỊCH VỤ CHĂM SÓC KHÁCH HÀNG CỦA FOXPRO STORE</b><br>
        <p>Bạn nhận được thư này, do bạn hoặc ai đó yêu cầu cung cấp mật khẩu mới từ Website FoxPro Store</p>
             Mật khẩu mới của bạn là: {$newPassword}
        ";
        $mail->Body = $noidungthu;
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
?>