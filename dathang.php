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
    <link rel="stylesheet" href="./assets/css/dathang.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="./Fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

</head>

<body>
    <!-- Header -->
    <?php include'php/menu.php' ?>
    <?php
         if (isset($_POST['btn_update'])) {
            $cart_idupdate = $_POST['cart_id'];
            $cart_soluongupdate = $_POST['quantity'];
            $cart_huongvi = $_POST['cart_huongvi'];
            $pro_id = $_POST['pro_id'];
            
            $query = 'SELECT * FROM tbl_products WHERE pro_id = ?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $pro_id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                while ($row_sanpham = $result->fetch_assoc()) {
                    $soluong = $row_sanpham['pro_soluong'];
                    if ($cart_soluongupdate >  $soluong) {
                        echo "<script>
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Bạn không thể chọn số lượng nhiều hơn số lượng của sản phẩm!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    window.location.href = 'cart.php';
                                });
                            </script>";
                    } else if ($cart_soluongupdate == 0) {
                        $query_delete = "DELETE FROM tbl_cart WHERE pro_id = ? AND cart_huongvi = ?";
                        $stmt_delete = $conn->prepare($query_delete);
                        $stmt_delete->bind_param('is', $pro_id, $cart_huongvi);
                        $stmt_delete->execute();
        
                        if ($stmt_delete->affected_rows > 0) {
                            echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Xóa sản phẩm khỏi giỏ hàng thành công!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = 'cart.php';
                            });
                        </script>";
                        } else {
                            echo 'Lỗi xóa sản phẩm: ' . $stmt_delete->error;
                        }
        
                        $stmt_delete->free_result();
                        $stmt_delete->close();
                    } else {
                        $updateQuery = "UPDATE tbl_cart SET cart_soluong = ? WHERE cart_id = ?";
                        $stmt_update = $conn->prepare($updateQuery);
                        $stmt_update->bind_param('ii', $cart_soluongupdate, $cart_idupdate);
                        $stmt_update->execute();
        
                        if ($stmt_update->affected_rows > 0) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Cập nhật thành công!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        window.location.href = 'cart.php';
                                    });
                                </script>";
                        } else {
                            echo "<script>
                            Swal.fire({
                                icon: 'warning',
                                title: 'Không có thay đổi!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = 'cart.php';
                            });
                        </script>";
                        }
                        $stmt_update->free_result();
                        $stmt_update->close();
                    }
                }
            }
            $stmt->free_result();
            $stmt->close();
        }
        

        if (isset($_POST['btn_delete'])) {
            $cart_idupdate = $_POST['cart_id'];
            
            
             // Thực hiện truy vấn xóa sản phẩm từ tbl_cart
    $query_delete = "DELETE FROM tbl_cart WHERE cart_id = '$cart_idupdate'";
    $result_delete = mysqli_query($conn, $query_delete);

    if ($result_delete) {
        echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Xóa sản phẩm thành công!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        window.location.href = 'cart.php';
                                    });
                                </script>";
    } else {
        echo 'Lỗi xóa sản phẩm: ' . mysqli_error($conn);
    }
        }
        
     ?>
    <!--================================ Xử lí load user_accounts ==============================================-->
    <div class="py-5 text-center">
        <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
        <h2>Thanh toán</h2>
        <p class="lead">Vui lòng kiểm tra thông tin Khách hàng, thông tin Giỏ hàng trước khi Đặt hàng.</p>
    </div>

    <form action="dathang.php" method="post">
        <div class="container_main">
            <?php
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
$query = "SELECT user_email, user_name FROM tbl_accounts WHERE user_id = ?" ;
// Sử dụng prepared statement để tránh SQL injection
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
if ($result->num_rows > 0) {
    // Lặp qua từng dòng dữ liệu
    while ($row = $result->fetch_assoc()) {
        // Truyền dữ liệu vào biểu mẫu tương ứng
        $email = $row['user_email'];
        $name = $row['user_name'];
    ?>
            <?php 
   
    
    echo'        <div class="info">';
    echo'            <table>';
    echo'                <tr>';
    echo'                    <th colspan="3"><i class="fa-solid fa-id-card"></i>&ensp;THÔNG TIN MUA HÀNG</th>';
    echo'                </tr>';              
    echo'                <tr>';
    echo'                    <td>Họ và tên: </td>';
    echo'                    <td> <input type="text" value="'.$name.'" name="hoTen"></td>';
    echo'                    <td><span style="font-size: 10px; color: #e40606;"><i class="fa-solid fa-star-of-life"></i></span></td>';
    echo'               </tr>';
    }
}
}
}
?>
            <!--================================ Xử lí load user_info ==============================================-->
            <?php


// Lấy user_id từ phiên đăng nhập
/* The above code is assigning the value of the "user_id" session variable to the variable "". */

// Chuẩn bị truy vấn SQL để lấy thông tin từ bảng tbl_user_info
$sql = "SELECT * FROM tbl_user_info WHERE user_id = ?";

// Sử dụng prepared statement
$stmt = $conn->prepare($sql);

// Kiểm tra lỗi prepared statement
if ($stmt === false) {
    die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
}

// Sử dụng bind_param với kiểu dữ liệu phù hợp
$stmt->bind_param("i", $user_id);

// Thực hiện truy vấn
$stmt->execute();

// Lấy kết quả
$result = $stmt->get_result();

// Kiểm tra xem có dữ liệu hay không
if ($result->num_rows > 0) {
    // In thông tin ra table
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>Điện thoại: </td>';
        echo '<td> <input type="text" value="' . $row['user_phone'] . '" name="soDienThoai"></td>';
        echo '<td><span style="font-size: 10px; color: #e40606;"><i class="fa-solid fa-star-of-life"></i></span></td>';
        echo '</tr>';  
        echo '<tr>';
        echo '<td>Tỉnh/T.phố: </td>';
        echo '<td> <input type="text" value="'.$row['user_province'].'" name="tinh" ></td>';
        echo '<td><span style="font-size: 10px; color: #e40606;"><i class="fa-solid fa-star-of-life"></i></span></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Quận/Huyện: </td>';
        echo '<td> <input type="text" value="'.$row['user_distric'].'" name="huyen"></td>';
        echo '<td><span style="font-size: 10px; color: #e40606;"><i class="fa-solid fa-star-of-life"></i></span></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Phường/Xã: </td>';
        echo '<td> <input type="text" value="'.$row['user_ward'].'" name="xa"></td>';
        echo '<td><span style="font-size: 10px; color: #e40606;"><i class="fa-solid fa-star-of-life"></i></span></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Địa chỉ: </td>';
        echo '<td> <input type="text" value="' . $row['user_address'] . '" name="diaChi"></td>';
        echo '<td><span style="font-size: 10px; color: #e40606;"><i class="fa-solid fa-star-of-life"></i></span> </td>';
        echo '</tr>';
    }
} else {
    echo '<tr>';
    echo '<td>Điện thoại: </td>';
    echo '<td> <input type="text" value="" name="soDienThoai" ></td>';
    echo '<td><span style="font-size: 10px; color: #e40606;"><i class="fa-solid fa-star-of-life"></i></span></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Tỉnh/TP: </td>';
    echo '<td> <select name="tinh" id="province">
    <option value="">-- Chọn tỉnh --</option>
    <option value="" selected></option>
   </select></td>';
    echo '<td><span style="font-size: 10px; color: #e40606;"><i class="fa-solid fa-star-of-life"></i></span></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Quận/Huyện: </td>';
    echo '<td><select name="huyen" id="district">
    <option value="">-- Chọn Quận/Huyện --</option>
    <option value="" selected></option>
    </select></td>';
    echo '<td><span style="font-size: 10px; color: #e40606;"><i class="fa-solid fa-star-of-life"></i></span></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Xã/Phường: </td>';
    echo '<td><select name="xa" id="ward">
    <option value="">-- Chọn Xã/Phường --</option>
    <option value="" selected></option>
   </select></td>';
    echo '<td><span style="font-size: 10px; color: #e40606;"><i class="fa-solid fa-star-of-life"></i></span></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Địa chỉ: </td>';
    echo '<td> <input type="text" value="" name="diaChi"></td>';
    echo '<td><span style="font-size: 10px; color: #e40606;"><i class="fa-solid fa-star-of-life"></i></span></td>';
    echo '</tr>';
}

?>
            <tr>
                <td colspan="3" style="padding:5px; border-top: 2px solid #ccc;"></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;"><button type="submit" class="submit_buy"
                        name="submit_buy"><i class="fa-regular fa-money-bill-1"></i>&ensp;Đặt hàng</button></td>
                </table>
        </div>
        <div class="products">
            <h2><i class="fa-solid fa-cart-shopping"></i> &ensp;GIỎ HÀNG</h2>
            <table>
                <tr>
                    <th colspan="3">Đơn hàng ngày: <?php echo date('Y-m-d'); ?></th>
                </tr>
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Hương vị</th>
                    <th>Thành tiền</th>
                </tr>

                <?php
        if (isset($_POST['selected_products'])) {
            $total = 0; 

            $selected_products = $_POST['selected_products'];
            // Duyệt qua danh sách các sản phẩm được chọn
            foreach ($selected_products as $cart_id) {
                // Thực hiện truy vấn SQL trong vòng lặp
                $query = "SELECT * FROM tbl_cart WHERE cart_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $cart_id);
                $stmt->execute();
                $product_info = $stmt->get_result()->fetch_assoc();

                if ($product_info) {
                    echo '<tr>';
                    echo '<td>'.$product_info['cart_name'].'';
                    echo '<br> 
                    <span style="font-size: 14px; color: #575f66;">'.$product_info['cart_price'].' x '. $product_info['cart_soluong'] .'</span></td>';
                    echo '<td>' .$product_info['cart_huongvi'].'</td>';
                    echo '<td>' . number_format(floatval(($product_info['cart_price'] * $product_info['cart_soluong'])), 0, ',', '.') . 'đ' . '</td>';
                    echo '</tr>';

                    // Cập nhật tổng giá trị
                    $total += $product_info['cart_price'] * $product_info['cart_soluong'];
                    echo '<input type="text" value="'. $product_info['pro_id'].'" name="proid[]" hidden>';
                    echo '<input type="text" value="'. $product_info['cart_soluong'] .'" name="soluong[]" hidden>';
                    echo '<input type="text" value="'.$product_info['cart_price'].'" name="giasp[]" hidden>';
                    echo '<input type="text" value="' .$product_info['cart_huongvi'].'" name="huongvi[]" hidden>';
                }
            }

            // Hiển thị tổng giá trị ngoài vòng lặp
            echo '<tr>';
            echo '<th colspan="2">Tổng: </th>';
            echo '<th>'.number_format($total, 0, ',', '.') . 'đ' .'</th>';
            echo '</tr>';
            
           
           
            
        } else {
            echo '<tr>';
            echo '<td class="error" colspan="3">Không có sản phẩm được chọn.</td>';
            echo '</tr>';
        }
        ?>
            </table>
        </div>
        </div>
    </form>
    <?php
require "./PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
require "./PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
require './PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
$mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
if (isset($_POST['submit_buy'])) {
    function generateRandomString($length = 10) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    // Sử dụng hàm để tạo chuỗi ngẫu nhiên
    $randomString = generateRandomString();
    $user_id = $_SESSION["user_id"];
    $hoTen = $_POST['hoTen'];
    $soDienThoai = $_POST['soDienThoai'];
    $tinh = $_POST['tinh'];
    $huyen = $_POST['huyen'];
    $xa = $_POST['xa'];
    $diaChi = $_POST['diaChi'];
   
    $status = "Đang xử lý"; // Lấy ngày hiện tại

    // Thêm dữ liệu vào bảng tbl_order
    $queryHoadon = "INSERT INTO tbl_order (order_code, user_id, order_name, order_phone, order_province, order_distric, order_ward, order_address, order_status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmtHoadon = mysqli_prepare($conn, $queryHoadon);
    mysqli_stmt_bind_param($stmtHoadon, "sisssssss", $randomString, $user_id, $hoTen, $soDienThoai, $tinh, $huyen, $xa, $diaChi, $status);

    if (mysqli_stmt_execute($stmtHoadon)) {
        // Lấy ID của hóa đơn vừa thêm vào
        $idHoadon = mysqli_insert_id($conn);
    
        // Duyệt qua mảng sản phẩm để thêm dữ liệu vào tbl_invoicedetails
        foreach ($_POST['proid'] as $i => $proId) {
            $soluong = $_POST['soluong'][$i];
            $giasp = $_POST['giasp'][$i];
            $huongvi = $_POST['huongvi'][$i];
    
            // Thêm dữ liệu vào bảng tbl_invoicedetails
            $insert_query = "INSERT INTO tbl_invoicedetails (order_id, pro_id, inv_soluong, inv_tongtien, inv_huongvi) 
                             VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
    
            if (!$insert_stmt) {
                // Xử lý lỗi chuẩn bị
                die("Lỗi chuẩn bị câu lệnh: " . $conn->error);
            }
    
            $total = $giasp * $soluong;
            // Ràng buộc tham số
            $insert_stmt->bind_param("iiids", $idHoadon, $proId, $soluong, $total, $huongvi);
    
            if (!$insert_stmt->execute()) {
                // Xử lý lỗi thêm dữ liệu
                die("Lỗi thêm vào tbl_invoicedetails: " . $insert_stmt->error);
            }
    
            // Đóng câu lệnh chuẩn bị
            $insert_stmt->close();
    
            // Xóa sản phẩm khỏi giỏ hàng sau khi thêm vào đơn hàng
            $delete_query = "DELETE FROM tbl_cart WHERE pro_id = ? AND cart_huongvi = ?";
            $delete_stmt = $conn->prepare($delete_query);
    
            if (!$delete_stmt) {
                // Xử lý lỗi chuẩn bị
                die("Lỗi chuẩn bị câu lệnh xóa: " . $conn->error);
            }
    
            // Ràng buộc tham số
            $delete_stmt->bind_param("is", $proId, $huongvi);
    
            if (!$delete_stmt->execute()) {
                // Xử lý lỗi xóa dữ liệu
                die("Lỗi xóa khỏi giỏ hàng: " . $delete_stmt->error);
            }
    
            // Đóng câu lệnh chuẩn bị
            $delete_stmt->close();



       
            
// Đóng câu lệnh chuẩn bị 
        }
        foreach ($_POST['proid'] as $i => $proId) {
            $soluong = $_POST['soluong'][$i];
        
            // Cập nhật lại số lượng sản phẩm sau khi thêm vào đơn hàng
            $update_query = "UPDATE tbl_products SET pro_soluong = pro_soluong - ? WHERE pro_id = ?";
            $update_stmt = $conn->prepare($update_query);
        
            if (!$update_stmt) {
                // Xử lý lỗi chuẩn bị
                die("Lỗi chuẩn bị câu lệnh update: " . $conn->error);
            }
        
            // Ràng buộc tham số
            $update_stmt->bind_param("ii", $soluong, $proId);
        
            if (!$update_stmt->execute()) {
                // Xử lý lỗi update dữ liệu
                die("Lỗi cập nhật số lượng sản phẩm: " . $update_stmt->error);
            }
        
            // Đóng câu lệnh chuẩn bị
            $update_stmt->close();
        }
        
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Đặt hàng thành công !',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'cart.php';
                });
            </script>";
           // Them doan gui mail
           try {
    
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
            $mail->Subject = '[THÔNG BÁO] ĐƠN HÀNG [#'.$randomString.'] ĐÃ ĐƯỢC ĐẶT THÀNH CÔNG!';      
            $noidungthu = "<b>Đơn hàng với mã đơn [#$randomString] đã được đặt thành công!</b><br>Cảm ơn bạn đã mua hàng tại cửa hàng FoxPro Store<br>";
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
        // Xử lý lỗi thêm dữ liệu vào tbl_order
        die("Lỗi thêm vào tbl_order: " . mysqli_error($conn));
    }
    
    // Đóng câu lệnh chuẩn bị
    mysqli_stmt_close($stmtHoadon);
    
}    
?>



    <script src="js/info.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    const host = "https://provinces.open-api.vn/api/";
    var callAPI = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data, "province");
            });
    }
    callAPI('https://provinces.open-api.vn/api/?depth=1');
    var callApiDistrict = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.districts, "district");
            });
    }
    var callApiWard = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.wards, "ward");
            });
    }

    var renderData = (array, select) => {
        let row = ' <option disable value="">Chọn</option>';
        array.forEach(element => {
            row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
        });
        document.querySelector("#" + select).innerHTML = row
    }

    $("#province").change(() => {
        callApiDistrict(host + "p/" + $("#province").find(':selected').data('id') + "?depth=2");
        printResult();
    });
    $("#district").change(() => {
        callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
        printResult();
    });
    $("#ward").change(() => {
        printResult();
    })

    var printResult = () => {
        if ($("#district").find(':selected').data('id') != "" && $("#province").find(':selected').data('id') !=
            "" &&
            $("#ward").find(':selected').data('id') != "") {
            let result = $("#province option:selected").text() +
                " | " + $("#district option:selected").text() + " | " +
                $("#ward option:selected").text();
            $("#result").text(result)
            console.log($("#province").val());
        }

    }
    </script>
    <?php include './view/footer/footer.php'?>