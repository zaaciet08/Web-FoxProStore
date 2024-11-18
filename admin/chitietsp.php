<?php
  include_once 'db/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fox Pro</title>
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
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/logo.png" />
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
    <link rel="stylesheet" href="../assets/css/reset.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/home-responsive.css" />
    <link rel="stylesheet" href="../assets/css/chitietsanpham.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/chuyendoianhchitiet.js"></script>
    <style>
        .quaylai{
            width: 110px;
            height: 30px;
            background-color: #dddd;
            border-radius: 5px;
            text-align: center;
           
        }
    </style>
</head>

<body>
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
                <div class="img-container"><img src="<?php echo $row_sanpham['pro_image']; ?>" alt="">
                </div>
                <div class="anhchitiet">
                    <?php
    // Hiển thị tất cả ảnh từ tbl_image
                    while ($row_image = $result_images->fetch_assoc()) {
                    echo '<img data-src="' . $row_image['img_image'] . '" src="' . $row_image['img_image'] . '" alt="">';
    }
    ?>
                </div>
                <div class="nav-btn-chitiet prev-btn"><i class="fa-solid fa-circle-chevron-left"></i></div>
                <div class="nav-btn-chitiet next-btn"><i class="fa-solid fa-circle-chevron-right"></i></div>

            </div>
            <div class="main-container">
               
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
                    <div class="quaylai"><a href="quanlysanpham.php">Quay lại >></a>
            </div>
            
            <?php 
    }
}
    }
?>

</div>
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
    </main>
