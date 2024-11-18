<!-- Trong phần PHP của cart.php -->

<?php
include_once 'db/conect.php'
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
    <link rel="stylesheet" href="./assets/css/cart.css" />
    <link rel="stylesheet" href="./assets/css/cart-responsive.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    
</head>

<body>
    <!--Header-->
    <?php include'php/menu.php' ?>
    <!-- BreadCrumb -->

    <div class="cart">
        <div class="container">
            <h1 class="cart__heading">Giỏ hàng</h1>
            <div class="cart__inner">
            <?php

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    // Truy vấn SQL để lấy dữ liệu từ bảng tbl_cart dựa trên user_id
    $query = "SELECT * FROM tbl_cart WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
    ?>
    <table>
        <tr>
            <th></th>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Hương vị</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th colspan="2">Thao tác</th>
        </tr>
        <tbody>

            <?php
            $total = 0;
            
            if ($result) {

                // Kiểm tra xem có dữ liệu trong bảng tbl_cart hay không
                if (mysqli_num_rows($result) > 0) {
                    echo '<form method="post" action="dathang.php">';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        $pro_id = $row['pro_id'];
                         $query_show = 'SELECT * FROM tbl_products WHERE pro_id = ?';
                         $stmt_show = $conn->prepare($query_show);
                         $stmt_show->bind_param('i', $pro_id);
                         $stmt_show->execute();
                         $result_show = $stmt_show->get_result();
                         if ($result_show->num_rows > 0) {
                            while ($row_sanpham = $result_show->fetch_assoc()) {
                                $soluong = $row_sanpham['pro_soluong'];
                                if($row['cart_soluong'] > $soluong){
                                echo '<td> <input disabled class="checkbox-item" type="checkbox"></td>';
                                }else{
                                    echo '<td> <input class="checkbox-item" type="checkbox" name="selected_products[]" id="' . $row['cart_id'] . '" value="' . $row['cart_id'] . '"></td>';
                                }
                            }
                        }
                        echo '<input type="hidden" name="pro_id" value="' . $row['pro_id'] . '">';
                        echo '<input type="hidden" name="cart_id" value="' . $row['cart_id'] . '">';
                        echo '<input type="hidden" name="cart_huongvi" value="' . $row['cart_huongvi'] . '">';
                        
                        echo '<td class="image"><img src="admin/' . $row['cart_image'] . '" alt=""></td>';
                        echo '<td>' . $row['cart_name'] . '</td>';
                        echo '<td>' . $row['cart_huongvi'] . '</td>';
                        echo '<td class="pro_price ">' . number_format(floatval($row['cart_price']), 0, ',', '.') . 'đ' . '</td>';
                        echo '<td class="quantity"><input class="number" min="0" value="' . $row['cart_soluong'] . '" type="number" name="quantity" id="quantity_' . $row['pro_id'] . '" oninput="updateTotal(' . $row['pro_id'] . ')"></td>';
                        echo '<td class="total_price">' . number_format(floatval(($row['cart_price'] * $row['cart_soluong'])), 0, ',', '.') . 'đ' . '</td>';
                        echo '<td> <button name="btn_update" class="bn31" type="submit" data-proid="' . $row['pro_id'] . '" data-prohuongvi="' . $row['cart_huongvi'] . '"><span class="bn31span"><i class="fa-solid fa-arrows-rotate"></i></span></button></td> ';
                        echo '<td> <button name="btn_delete" class="bn54" type="submit" data-proid="' . $row['pro_id'] . '" data-prohuongvi="' . $row['cart_huongvi'] . '"><span class="bn54span"><i class="fa-solid fa-trash"></i>&ensp;!</span></button></td> ';
                        echo '</tr>';

                        // Cập nhật tổng giá trị
                        $total += $row['cart_price'] * $row['cart_soluong'];
                        
                    }
                } else {
                    // Hiển thị thông báo nếu giỏ hàng trống
                    echo '<tr>';
                    echo '<td class="error" colspan="9">Giỏ hàng của bạn đang rỗng !</td>';
                    echo '</tr>';
                }
            } else {
                // Hiển thị thông báo khi có người dùng nhưng giỏ hàng trống
                echo '<tr>';
                echo '<td class="error" colspan="9">Giỏ hàng của bạn đang rỗng !</td>';
                echo '</tr>';
            }
            ?>
            <tr>
                <th></th>
                <th colspan="2"><a href="index.php#sanpham">Tiếp tục mua sắm >></a></th>
                <th></th>
                <th>Tổng: </th>
                <th></th>
                <th id="totalAmount"><?php echo number_format($total, 0, ',', '.') . 'đ'; ?></th>
                <th colspan="2"><button class="bn13" type="submit" onclick="checkItemsAndPay()"><i class="fa-solid fa-cart-shopping"></i></button></th>
            </tr>
        </tbody>
        </form>
    </table>
    
    <?php
} else {
                echo '<div class="errorM"><span class="iconerror"><i class="fa-solid fa-circle-exclamation"></i></span>&ensp;Bạn chưa đăng nhập!</div>';
}
?>

            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <script>
    function checkItemsAndPay() {
        var checkboxes = document.getElementsByName("selected_products[]");
        var atLeastOneChecked = false;

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                atLeastOneChecked = true;
                break;
            }
        }

        if (!atLeastOneChecked) {
            alert("Vui lòng chọn ít nhất một sản phẩm trước khi đặt hàng!");
            return false; // Ngăn chặn việc gửi biểu mẫu
        }

        // Nếu có ít nhất một ô checkbox được chọn, tiếp tục gửi biểu mẫu
        document.getElementById("cartForm").submit();
    }
</script>
    <script src="js/dathang.js"></script>
    <!-- Footer -->
    <?php include'./view/footer/footer.php'?>