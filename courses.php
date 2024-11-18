<?php 
include_once'./db/conect.php';
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
    <link rel="stylesheet" href="./assets/css/courses.css" />
    <link rel="stylesheet" href="./assets/css/courses-responsive.css" />

</head>

<body>
    <!-- Header -->
    <?php include'php/menu.php' ?>

    <!-- Courses Area-->
    <div class="container_pro " style="display: flex; flex-wrap: wrap;">
        <?php
                       if(isset($_GET["dm_id"])){
                        $dm_id = $_GET['dm_id'];
    $query = 'SELECT * FROM tbl_products WHERE pro_danhmuc = "'.$dm_id.'"';
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row_sanpham = $result->fetch_assoc()) {
        $sale = $row_sanpham['pro_gia'] - (($row_sanpham['pro_gia'] * $row_sanpham['pro_giamgia']) / 100);
            
        // Lấy ảnh từ tbl_image dựa trên pro_id
        $query_images = 'SELECT * FROM tbl_image WHERE pro_id = ?';
        $stmt_images = $conn->prepare($query_images);
        $stmt_images->bind_param('i', $row_sanpham['pro_id']);
        $stmt_images->execute();
        $result_images = $stmt_images->get_result();
?>
        <section class="deal">
            <?php 
                            $soluong = $row_sanpham['pro_soluong'];
                            if($soluong == 0){
                                    echo'<span class="tinhtrang_hethang">Hết hàng</span>';
                            }else if($soluong >= 1 && $soluong <= 4){
                                echo ' <span class="tinhtrang_saphethang">Sắp hết hàng</span>';
                            }else{
                                 echo' <span class="tinhtrang_conhang">Còn hàng</span>';
                            }
                            ?>
            <img src="admin/<?php echo $row_sanpham['pro_image']; ?>" alt="">
            <a href="chitietsanpham.php?pro_id=<?php echo $row_sanpham['pro_id']; ?>"
                class="deal__heading"><?php echo $row_sanpham['pro_name']; ?></a>
            <span class="deal__price"><?php echo number_format(floatval($sale), 0, ',', '.') . 'đ'; ?></span>
            <span
                class="deal__sale_price"><del><?php echo number_format(floatval($row_sanpham['pro_gia']), 0, ',', '.') . 'đ'; ?></del></span>
            <span class="deal__percent">-<?php echo $row_sanpham['pro_giamgia']; ?>%</span>
            <p class="deal__footer"><i class="fa-solid fa-tag"></i>&ensp;Giá tốt nhất thị trường <br><br><i
                    class="fa-solid fa-caret-down"></i>&ensp;Giảm giá trực tiếp</p>
            <form action="index.php" method="post" id="form_<?php echo $row_sanpham['pro_id']; ?>">
                <input type="hidden" name="idsp" value="<?php echo $row_sanpham['pro_id']; ?>">

            </form>
        </section>
        <?php
    }
} else {
    echo 'Không có sản phẩm nào.';
}
}
?>
    </div>
    <!-- Footer -->
    <?php include'view/footer/footer.php' ?>