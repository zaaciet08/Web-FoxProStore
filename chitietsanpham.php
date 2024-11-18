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
    <link rel="stylesheet" href="assets/css/chitietsanpham.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="Fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/chuyendoianhchitiet.js"></script>

</head>

<body>
    <!-- Header -->
    <?php include'php/menu.php' ?>
    <?php
                        $conn = mysqli_connect("localhost", "root", "", "foxprostore");

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }
    if(isset($_GET["pro_id"])){
        $pro_id = $_GET['pro_id'];
    $query = 'SELECT * FROM tbl_products WHERE pro_id = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $pro_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row_sanpham = $result->fetch_assoc()) {
        $sale = $row_sanpham['pro_gia'] - (($row_sanpham['pro_gia'] * $row_sanpham['pro_giamgia']) / 100);
        $tietkiem = $row_sanpham['pro_gia'] -  $sale;
        // Câu truy vấn để lấy ảnh từ tbl_image dựa trên pro_id
        $query_images = 'SELECT * FROM tbl_image WHERE pro_id = ?';
        $stmt_images = $conn->prepare($query_images);
        $stmt_images->bind_param('i', $pro_id);
        $stmt_images->execute();
        $result_images = $stmt_images->get_result();
?>
    <main>
        <div class="container_chitiet">
            <div class="container_image">
                <div class="img-container"><img src="admin/<?php echo $row_sanpham['pro_image']; ?>" alt="">
                </div>
                <div class="anhchitiet">
                    <?php
    // Hiển thị tất cả ảnh từ tbl_image
                    while ($row_image = $result_images->fetch_assoc()) {
                    echo '<img data-src="admin/' . $row_image['img_image'] . '" src="admin/' . $row_image['img_image'] . '" alt="">';
    }
    ?>
                </div>
                <div class="nav-btn-chitiet prev-btn"><i class="fa-solid fa-circle-chevron-left"></i></div>
                <div class="nav-btn-chitiet next-btn"><i class="fa-solid fa-circle-chevron-right"></i></div>

            </div>
            <div class="main-container">
                <form action="chitietsanpham.php" method="post">
                    <h2 class="head"><?php echo $row_sanpham['pro_name']?></h2>
                    <div class="status">Thương hiệu: <span
                            class="thuonghieu"><?php echo $row_sanpham['pro_thuonghieu'] ?></span>&ensp;<i
                            class="fa-solid fa-grip-lines-vertical"></i>&ensp;<span class="soluong">Còn:
                            <?php echo $row_sanpham['pro_soluong'] ?> sản phẩm</span></div>
                    <?php 
                                if($row_sanpham['pro_giamgia'] == 0){
                                    echo '<span class="deal__price">'.number_format(floatval($row_sanpham['pro_gia']), 0, ',', '.') . 'đ'.'';
                                }else{
                                    echo'<span class="deal__price">'.number_format(floatval($sale), 0, ',', '.') . 'đ'.'';
                                    echo'<span class="deal__sale_price"><del>'.number_format(floatval($row_sanpham['pro_gia']), 0, ',', '.') . 'đ'.'</del>';
                                    echo'<span class="deal__percent">-'.$row_sanpham['pro_giamgia'].'%</span></span></span>';
                                    echo'<div class="tietkiem">(Tiết kiệm: <span class="tietkiemsanpham">'.number_format(floatval($tietkiem), 0, ',', '.') . 'đ'.'</span>)</div>';
                                }
                            ?>
                    <div class="mota">
                        <ul>
                            <?php 
                        // Lấy giá trị từ cột pro_huongvi
                        $pro_mota = $row_sanpham['pro_mota'];
                        
                        // Làm sạch dữ liệu
                        $pro_mota = trim($pro_mota);
                        
                        // Tách các hương vị thành một mảng
                        $mota_array = explode(',', $pro_mota);
                        
                        // Lặp qua mảng để hiển thị từng hương vị
                        foreach ($mota_array as $mota) {
                            echo'<li> - ' . trim($mota) . '</li>';
                        }
                    ?>
                        </ul>
                    </div>
                    <div class="modal_head">Hương vị: </div>
                    <?php
// Lấy giá trị từ cột pro_huongvi
$pro_huongvi = $row_sanpham['pro_huongvi'];

// Làm sạch dữ liệu
$pro_huongvi = trim($pro_huongvi);

// Tách các hương vị thành một mảng
$huongvi_array = explode(',', $pro_huongvi);

// Lặp qua mảng để hiển thị từng hương vị
foreach ($huongvi_array as $huongvi) {
    echo '<div class="huongvi">';
    echo '<label for="' . trim($huongvi) . '">';
    echo '<input type="radio" name="huongvi" value="' . trim($huongvi) . '">';
    echo '<span class="choose">' . trim($huongvi) . '</span>';
    echo '</label>';
    echo '</div>';
}
?>
                    <input type="hidden" name="pro_id" value="<?php echo $row_sanpham['pro_id']; ?> ">
                    <input type="hidden" name="pro_image" value="<?php echo $row_sanpham['pro_image']; ?>">
                    <input type="hidden" name="pro_name" value="<?php echo $row_sanpham['pro_name']; ?>">
                    <input type="hidden" name="pro_price" value="<?php echo $sale; ?>">
                    <input type="hidden" name="pro_huongvi" value="<?php echo $row_sanpham['pro_huongvi']?>">
                    <div class="heading_num">Số lượng: <input class="number" value="1" type="number" min="1"
                            name="number" id="number"></div>
                    <?php 
                               $soluong = $row_sanpham['pro_soluong'];
                               if($soluong == 0){
                                echo '<button class="btn_hethang" type="submit" name="submit_add" disabled>Thêm vào giỏ hàng</button>';
                                
                               }else{
                                echo '<button class="btn_add" type="submit" name="submit_add" >Thêm vào giỏ hàng</button>';
                                //echo '<button class="btn_buy" type="submit" name="submit_buy">Mua ngay</button>';
                               }
                            ?>


            </div>
            </form>
            <?php 
    }
}
    }
?>
            <?php
                if (isset($_POST['submit_add'])) {
                        if (!isset($_SESSION["user_id"])) {
                            echo "<script>
                            Swal.fire({
                                icon: 'warning',
                                title: 'Bạn cần đăng nhập để thêm vào giỏ hàng !',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = 'login.php';
                            });
                        </script>";
                        } else if (isset($_SESSION["user_id"])) {
                            

                               // Lấy dữ liệu từ form
                               $pro_id = $_POST['pro_id'];
                               $cart_name = $_POST['pro_name'];
                               $cart_price = $_POST['pro_price'];
                               $cart_huongvi = isset($_POST['huongvi']) ? $_POST['huongvi'] : '';
                               $cart_soluong = $_POST['number'];
                               $cart_image = $_POST['pro_image'];
                               // Lấy user_id từ phiên đăng nhập (điều này cần được cập nhật dựa trên cách bạn quản lý đăng nhập)
                               $user_id = $_SESSION['user_id'];
                            
                            $query = 'SELECT * FROM tbl_products WHERE pro_id = ?';
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param('i', $pro_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows > 0) {
                            while ($row_sanpham = $result->fetch_assoc()) {
                                $soluong = $row_sanpham['pro_soluong'];
                           if($cart_soluong >  $soluong){
                            echo "<script>
                            Swal.fire({
                                icon: 'warning',
                                title: 'Bạn không thể chọn số lượng nhiều hơn số lượng của sản phẩm!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = 'chitietsanpham.php?pro_id=". $pro_id."';
                            });
                        </script>";
                           } else if (empty($cart_huongvi)) {
                                   echo "<script>
                                   Swal.fire({
                                       icon: 'warning',
                                       title: 'Chưa chọn hương vị !',
                                       showConfirmButton: false,
                                       timer: 1500
                                   }).then(function() {
                                       window.location.href = 'chitietsanpham.php?pro_id=". $pro_id."';
                                   });
                               </script>";
                               }else{
                                     // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
                               $check_query = "SELECT * FROM tbl_cart WHERE user_id = '$user_id' AND pro_id = '$pro_id' AND cart_huongvi = '$cart_huongvi'";
                               $check_result = $conn->query($check_query);
                              
                               if ($check_result->num_rows > 0) {
                                while ($row_check = $check_result->fetch_assoc()) {
                                    $soluongtronggio = $row_check['cart_soluong'];
                                    if($soluongtronggio + $cart_soluong > $soluong){
                                        echo "<script>
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Số lượng trong giỏ không thể lớn hơn số lượng của sản !',
                                            showConfirmButton: false,
                                            timer: 1500
                                        }).then(function() {
                                            window.location.href = 'chitietsanpham.php?pro_id=". $pro_id."';
                                        });
                                    </script>";
                                    }else {
                                   // Nếu sản phẩm đã tồn tại, cập nhật số lượng và giá
                                   $update_query = "UPDATE tbl_cart 
                                                    SET cart_soluong = cart_soluong + '$cart_soluong', 
                                                        cart_price = '$cart_price' 
                                                    WHERE user_id = '$user_id' AND pro_id = '$pro_id'";
                                   
                                   if ($conn->query($update_query) === TRUE) {
                                       echo "<script>
                                       Swal.fire({
                                           icon: 'success',
                                           title: 'Cập nhật thành công !',
                                           showConfirmButton: false,
                                           timer: 1500
                                       }).then(function() {
                                           window.location.href = 'cart.php';
                                       });
                                   </script>";
                                   } else {
                                       echo "Lỗi: " . $update_query . "<br>" . $conn->error;
                                   }
                                }
                                }
                               } else {
                                   // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
                                   $insert_query = "INSERT INTO tbl_cart (user_id, pro_id, cart_name, cart_image, cart_price, cart_huongvi, cart_soluong)
                                                    VALUES ('$user_id','$pro_id','$cart_name', '$cart_image', '$cart_price', '$cart_huongvi', '$cart_soluong')";
                                   
                                   if ($conn->query($insert_query) === TRUE) {
                                       echo "<script>
                                       Swal.fire({
                                           icon: 'success',
                                           title: 'Thêm vào giỏ hàng thành công!',
                                           showConfirmButton: false,
                                           timer: 1500
                                       }).then(function() {
                                           window.location.href = 'cart.php';
                                       });
                                   </script>";
                                   } else {
                                       echo "Lỗi: " . $insert_query . "<br>" . $conn->error;
                                   }
                               }
                               }
                            }
                        }
                            }
                       }
                    
                       ?>
            <!-- Thanh phan -->
            <?php


// Câu truy vấn SQL để lấy dữ liệu từ tbl_ingredient
$query_ingredient = 'SELECT * FROM tbl_ingredient WHERE pro_id = ?';

// Sử dụng prepare để chuẩn bị câu truy vấn
$stmt_ingredient = mysqli_prepare($conn, $query_ingredient);

// Kiểm tra lỗi prepare
if (!$stmt_ingredient) {
    die("Lỗi prepare: " . mysqli_error($conn));
}

// Sử dụng bind_param để thêm tham số vào câu truy vấn
mysqli_stmt_bind_param($stmt_ingredient, "i", $pro_id);

// Thực hiện câu truy vấn
mysqli_stmt_execute($stmt_ingredient);

// Nhận kết quả
$result_ingredient = mysqli_stmt_get_result($stmt_ingredient);
?>
            <div class="thanhphan">
                <h2>THÀNH PHẦN DINH DƯỠNG</h2>
                <?php
// Kiểm tra xem có dữ liệu hay không
if (mysqli_num_rows($result_ingredient) > 0) {
    while ($row_ingredient = mysqli_fetch_assoc($result_ingredient)) {
        echo '<table>';
        echo '<tr>';
        echo '    <th colspan="3">Supplement Facts: '.$row_ingredient['ing_sfacts'].'</th>';
        echo '</tr>';
        echo '<tr>';
        echo '    <th colspan="3">Serving Size: '.$row_ingredient['ing_ssize'].'</th>';
        echo '</tr>';
        echo '<tr>';
        echo '    <th colspan="3">Servings Per Container: ~ '.$row_ingredient['ing_percontainer'].' Serving</th>';
        echo '</tr>';
        echo '<tr>';
        echo '    <th></th>';
        echo '    <th>Amount Per Serving</th>';
        echo '    <th>% Daily Value</th>';
        echo '</tr>';
        echo '<tr>';
        echo '    <td class="head">Calories</td>';
        echo '    <td>'.$row_ingredient['ing_caloamount'].' g</td>';
        echo '    <td>'.$row_ingredient['ing_calopercent'].' %</td>';
        echo '</tr>';
        echo '<tr>';
        echo '    <td class="head">Total Fat</td>';
        echo '    <td>'.$row_ingredient['ing_totalamount'].' g</td>';
        echo '    <td>'.$row_ingredient['ing_totalpercent'].' %</td>';
        echo '</tr>';
        echo '<tr>';
        echo '    <td><span class="tp">Saturated Fat</span></td>';
        echo '    <td>'.$row_ingredient['ing_sfatamount'].' g</td>';
        echo '    <td>'.$row_ingredient['ing_sfatpercent'].' %</td>';
        echo '</tr>';
        echo '<tr>';
        echo '    <td><span class="tp"> Trans Fat</span></td>';
        echo '    <td>'.$row_ingredient['ing_tfatamount'].' g</td>';
        echo '    <td>'.$row_ingredient['ing_tfatpercent'].' %</td>';
        echo '</tr>';
        echo '<tr>';
        echo '    <td class="head">Cholesterol</td>';
        echo '    <td>'.$row_ingredient['ing_choleamount'].' mg</td>';
        echo '    <td>'.$row_ingredient['ing_cholepercent'].' %</td>';
        echo '</tr>';
        echo '<tr>';
        echo '    <td class="head">Sodium</td>';
        echo '    <td>'.$row_ingredient['ing_sodiamount'].' mg</td>';
        echo '    <td>'.$row_ingredient['ing_sodipercent'].' %</td>';
        echo '</tr>';
        echo '<tr>';
        echo '    <td class="head">Protein</td>';
        echo '    <td>'.$row_ingredient['ing_proamount'].' mg</td>';
        echo '    <td>'.$row_ingredient['ing_propercent'].' %</td>';
        echo '</tr>';
        echo '<tr>';
        echo '    <td><span class="tp">Potassium</span></td>';
        echo '    <td>'.$row_ingredient['ing_potaamount'].' mg</td>';
        echo '    <td>'.$row_ingredient['ing_potapercent'].' %</td>';
        echo '</tr>';
        echo '<tr>';
        echo '    <td><span class="tp">Iron</span></td>';
        echo '    <td>'.$row_ingredient['ing_ironamount'].' mg</td>';
        echo '    <td>'.$row_ingredient['ing_ironpercent'].' %</td>';
        echo '</tr>';
        echo '<tr>';
        echo '    <td><span class="tp">Calcium</span></td>';
        echo '    <td>'.$row_ingredient['ing_calciamount'].' mg</td>';
        echo '    <td>'.$row_ingredient['ing_calcipercent'].' %</td>';
        echo '</tr>';
        echo '<tr>';
        echo '    <td><span class="tp">Vitamin D</span></td>';
        echo '    <td>'.$row_ingredient['ing_vitaminamount'].' mg</td>';
        echo '    <td>'.$row_ingredient['ing_vitaminpercent'].' %</td>';
        echo '</tr>';
        echo '</table>';
    }
}
?>


            </div>
        </div>
        <div class="comment">
            <h2> <i class="fa-regular fa-comments"></i> &ensp;Bình luận</h2>
            <?php
// Kiểm tra nếu tồn tại tham số pro_id trong URL
if (isset($_GET["pro_id"])) {
    // Lấy thông tin từ URL
    $pro_id = $_GET['pro_id'];

    // Thực hiện truy vấn để lấy dữ liệu từ bảng tbl_comment
    $comment_query = 'SELECT * FROM tbl_comment WHERE pro_id = ?';
    $comment_stmt = $conn->prepare($comment_query);
    $comment_stmt->bind_param('i', $pro_id);
    $comment_stmt->execute();
    $comment_result = $comment_stmt->get_result();
   
    // Kiểm tra xem có bình luận nào hay không
    if ($comment_result->num_rows > 0) {
        
        while ($row_cmt = $comment_result->fetch_assoc()) {
            // Lấy user_id từ hàng hiện tại
            $userID = $row_cmt['user_id'];
            $cmt_id =  $row_cmt['cmt_id'];

            // Change this condition to compare with the integer 0
            if ($userID == 0) {
                $cmt_query = 'SELECT * FROM tbl_repcmt WHERE cmt_id = ?';
                $cmt_stmt = $conn->prepare($cmt_query);
                $cmt_stmt->bind_param('i', $cmt_id);
                $cmt_stmt->execute();
                $cmt_result = $cmt_stmt->get_result();
                echo '<div class="list-comments">';
                echo '<div class="name_cmt">Ẩn danh</div>';
                echo '<div class="cmt">' . $row_cmt['cmt_cmt'] . '</div>';
                
                if ($cmt_result->num_rows > 0) {
                    while ($row_cmt = $cmt_result->fetch_assoc()) {
                        echo '<div class="name_cmt_ad">Foxpro Store</div>';
                        echo '<div class="cmt_ad">' . $row_cmt['rep_comment'] . '</div>';
                        
                    }
                } 
                echo '</div>';
            } else {
                $user_query = 'SELECT * FROM tbl_user_info WHERE user_id = ?';
                $user_stmt = $conn->prepare($user_query);
                $user_stmt->bind_param('i', $userID);
                $user_stmt->execute();
                $user_result = $user_stmt->get_result();
                // Kiểm tra xem có thông tin người dùng hay không
                if ($user_result->num_rows > 0) {
                    $cmt_query = 'SELECT * FROM tbl_repcmt WHERE cmt_id = ?';
                $cmt_stmt = $conn->prepare($cmt_query);
                $cmt_stmt->bind_param('i', $cmt_id);
                $cmt_stmt->execute();
                $cmt_result = $cmt_stmt->get_result();
                echo '<div class="list-comments">';
                    while ($row_info = $user_result->fetch_assoc()) {
                        // Thay đổi $row_cmt thành $row_info trong lệnh echo
                        echo '<div class="name_cmt">' . $row_info['user_name'] . '</div>';
                        echo '<div class="cmt">' . $row_cmt['cmt_cmt'] . '</div>'; // Sửa lại thành $row_info
                        echo '';
                    }
                    // Kiểm tra xem có bình luận hay không
                if ($cmt_result->num_rows > 0) {
                    while ($row_cmt = $cmt_result->fetch_assoc()) {
                        echo '<div class="name_cmt_ad">Foxpro Store</div>';
                        echo '<div class="cmt_ad">' . $row_cmt['rep_comment'] . '</div>';
                        
                    }
                }
                echo '</div>'; 
                } 
                
            }
            
        }
    }
   
// Hiển thị form để thêm bình luận
echo '<div class="comment-form">';
echo '<form id="comment-form" method="post" action="chitietsanpham.php">';
echo '    <textarea name="comment" rows="4" required placeholder="Viết bình luận..."></textarea>';
echo '    <div class="button-container">';
echo '        <button type="submit" name="btn_cmt">';
echo '            <i data-visualcompletion="css-img" class="x1b0d499 xmgbrsx"';
echo '                style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v3/yx/r/Ga6PYXP61Zu.png?_nc_eui2=AeEnSScr6DN-6cxITJF7Q48Mp83AaNQpftCnzcBo1Cl-0HPxSvWuglAN82ezaiQomq6nPPYHpp7KZ-SSgSmfAe85&quot;); background-position: 0px -1280px; background-size: 22px 1434px; width: 16px; height: 16px; background-repeat: no-repeat; display: inline-block;"></i>';
echo '        </button>';
echo '    </div>';
echo '<input type="text" value="'.$pro_id.'" name="proid" hidden>';
echo '</form>';
echo '</div>';
}
// Kiểm tra khi có sự kiện thêm bình luận
if (isset($_POST['btn_cmt'])) {
    $cmt_cmt = $_POST['comment'];
    $pro_id = $_POST['proid'];
    $user_id = '0';
    if (!isset($_SESSION["user_id"])) {
        $query = 'INSERT INTO tbl_comment (pro_id, user_id, cmt_cmt) VALUES (?, ?, ?)';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iis', $pro_id, $user_id, $cmt_cmt);
        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: '',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'chitietsanpham.php?pro_id=". $pro_id."';
            });
        </script>";
        } else {
            echo "Lỗi khi thêm bình luận: " . $stmt->error;
        }
    }
    else{

    
    // Lấy thông tin từ form
    $user_id = $_SESSION["user_id"];
    $cmt_cmt = $_POST['comment'];
    $pro_id = $_POST['proid'];

    // Kiểm tra và chắc chắn rằng có dữ liệu để thêm vào cơ sở dữ liệu
    if (!empty($user_id) && !empty($cmt_cmt)) {
        // Thực hiện truy vấn để thêm bình luận vào bảng tbl_comment
        $query = 'INSERT INTO tbl_comment (pro_id, user_id, cmt_cmt) VALUES (?, ?, ?)';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iis', $pro_id, $user_id, $cmt_cmt);
    
        // Kiểm tra và hiển thị thông báo thành công hoặc lỗi
        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: '',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'chitietsanpham.php?pro_id=". $pro_id."';
            });
        </script>";
        } else {
            echo "Lỗi khi thêm bình luận: " . $stmt->error;
        }
    
        // Đóng kết nối
        $stmt->close();
    } else {
        // Hiển thị thông báo nếu có trường dữ liệu bị thiếu
        echo "Vui lòng nhập đầy đủ thông tin để thêm bình luận.";
    }
}
    
}
?>

        </div>
    </main>

    <?php include './view/footer/footer.php' ?>