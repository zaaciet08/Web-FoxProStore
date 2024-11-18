<?php
include 'db/connect.php';

// Thêm sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $pro_name = $_POST["pro_name"];
    $pro_image = $_POST["pro_image"];
    $pro_gia = $_POST["pro_gia"];
    $pro_mota = $_POST["pro_mota"];
    $pro_soluong = $_POST["pro_soluong"];
    $pro_giamgia = $_POST["pro_giamgia"];
    $pro_huongvi = $_POST["pro_huongvi"];
    $pro_thuonghieu = $_POST["pro_thuonghieu"];
    $pro_danhmuc = $_POST["pro_danhmuc"];

    $sql = "INSERT INTO tbl_products (pro_name, pro_image, pro_gia, pro_mota, pro_soluong, pro_giamgia, pro_huongvi, pro_thuonghieu, pro_danhmuc) VALUES ('$pro_name', '$pro_image', '$pro_gia', '$pro_mota', '$pro_soluong', '$pro_giamgia', '$pro_huongvi', '$pro_thuonghieu', '$pro_danhmuc')";
    $conn->query($sql);
}

// Sửa sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $pro_id = $_POST["pro_id"];
    $pro_name = $_POST["pro_name"];
    $pro_image = $_POST["pro_image"];
    $pro_gia = $_POST["pro_gia"];
    $pro_mota = $_POST["pro_mota"];
    $pro_soluong = $_POST["pro_soluong"];
    $pro_giamgia = $_POST["pro_giamgia"];
    $pro_huongvi = $_POST["pro_huongvi"];
    $pro_thuonghieu = $_POST["pro_thuonghieu"];
    $pro_danhmuc = $_POST["pro_danhmuc"];

    $sql = "UPDATE tbl_products SET pro_name='$pro_name', pro_image='$pro_image', pro_gia='$pro_gia', pro_mota='$pro_mota', pro_soluong='$pro_soluong', pro_giamgia='$pro_giamgia', pro_huongvi='$pro_huongvi', pro_thuonghieu='$pro_thuonghieu', pro_danhmuc='$pro_danhmuc' WHERE pro_id='$pro_id'";
    $conn->query($sql);
}

// Xóa sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $pro_id = $_GET["delete"];

    $sql = "DELETE FROM tbl_products WHERE pro_id='$pro_id'";
    $conn->query($sql);
}
?>

<div class="container mt-5">
    <h2>Quản Lý Sản Phẩm</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
        Thêm Sản Phẩm
    </button>

    <br><br>
    <?php
// Số sản phẩm hiển thị trên mỗi trang
$itemsPerPage = 10;

// Truy vấn để lấy tổng số lượng sản phẩm
$totalProducts = $conn->query("SELECT COUNT(*) as total FROM tbl_products")->fetch_assoc()['total'];

// Tính tổng số trang
$totalPages = ceil($totalProducts / $itemsPerPage);

// Xác định trang hiện tại
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Tính chỉ số bắt đầu và kết thúc của sản phẩm trên trang hiện tại
$startIndex = ($currentPage - 1) * $itemsPerPage;

// Truy vấn để lấy các sản phẩm trên trang hiện tại
$query = "SELECT pro_id, pro_name, pro_image, pro_gia, pro_soluong, pro_giamgia, pro_huongvi, pro_thuonghieu, pro_danhmuc 
          FROM tbl_products 
          LIMIT $startIndex, $itemsPerPage";

$result = $conn->query($query);

// Hiển thị bảng và phân trang
?>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ảnh</th>
            <th>Tên Sản Phẩm</th>
            <th>Giá</th>
            <th>Số Lượng</th>
            <th>Thương Hiệu</th>
            <th>Danh Mục</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        
        <tbody>
        <?php
        $result = $conn->query("SELECT pro_id, pro_name, pro_image, pro_gia, pro_soluong, pro_giamgia, pro_huongvi, pro_thuonghieu, pro_danhmuc FROM tbl_products");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['pro_id']}</td>
                    <td><img src='{$row['pro_image']}' width='25%'></td>
                    <td>{$row['pro_name']}</td>
                    <td>{$row['pro_gia']}</td>
                    <td>{$row['pro_soluong']}</td>
                    <td>{$row['pro_thuonghieu']}</td>
                    <td>{$row['pro_danhmuc']}</td>
                    <td>
                        <a href='#' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteProductModal{$row['pro_id']}'>Xóa</a>
                        <a href='#' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editProductModal{$row['pro_id']}'>Sửa</a>
                    </td>
                </tr>";

            // Modal for Delete
            echo "<div class='modal fade' id='deleteProductModal{$row['pro_id']}' tabindex='-1' role='dialog' aria-labelledby='deleteProductModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='deleteProductModalLabel'>Xác nhận Xóa</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                Bạn có chắc chắn muốn xóa sản phẩm này không?
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Đóng</button>
                                <a href='?delete={$row['pro_id']}' class='btn btn-danger'>Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>";

            // Modal for Edit
            echo "<div class='modal fade' id='editProductModal{$row['pro_id']}' tabindex='-1' role='dialog' aria-labelledby='editProductModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='editProductModalLabel'>Chỉnh Sửa Sản Phẩm</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <form method='post'>
                                    <input type='hidden' name='pro_id' value='{$row['pro_id']}'>
                                    <div class='form-group'>
                                        <label for='pro_name'>Tên Sản Phẩm:</label>
                                        <input type='text' class='form-control' name='pro_name' value='{$row['pro_name']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='pro_image'>Ảnh:</label>
                                        <input type='text' class='form-control' name='pro_image' value='{$row['pro_image']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='pro_gia'>Giá:</label>
                                        <input type='text' class='form-control' name='pro_gia' value='{$row['pro_gia']}' required>
                                    </div>
                                    
                                    <div class='form-group'>
                                        <label for='pro_soluong'>Số Lượng:</label>
                                        <input type='text' class='form-control' name='pro_soluong' value='{$row['pro_soluong']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='pro_giamgia'>Giảm Giá:</label>
                                        <input type='text' class='form-control' name='pro_giamgia' value='{$row['pro_giamgia']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='pro_huongvi'>Hương Vị:</label>
                                        <input type='text' class='form-control' name='pro_huongvi' value='{$row['pro_huongvi']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='pro_thuonghieu'>Thương Hiệu:</label>
                                        <input type='text' class='form-control' name='pro_thuonghieu' value='{$row['pro_thuonghieu']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='pro_danhmuc'>Danh Mục:</label>
                                        <input type='text' class='form-control' name='pro_danhmuc' value='{$row['pro_danhmuc']}' required>
                                    </div>
                                    <button type='submit' class='btn btn-primary' name='edit'>Lưu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        ?>
        </tbody>
    </table>

</div>

<!-- Modal for Add -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Thêm Sản Phẩm Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="pro_name">Tên Sản Phẩm:</label>
                        <input type="text" class="form-control" name="pro_name" required>
                    </div>
                    <div class="form-group">
                        <label for="pro_image">Ảnh:</label>
                        <input type="text" class="form-control" name="pro_image" required>
                    </div>
                    <div class="form-group">
                        <label for="pro_gia">Giá:</label>
                        <input type="text" class="form-control" name="pro_gia" required>
                    </div>
                    <div class="form-group">
                        <label for="pro_mota">Mô Tả:</label>
                        <textarea class="form-control" name="pro_mota"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pro_soluong">Số Lượng:</label>
                        <input type="text" class="form-control" name="pro_soluong" required>
                    </div>
                    <div class="form-group">
                        <label for="pro_giamgia">Giảm Giá:</label>
                        <input type="text" class="form-control" name="pro_giamgia" required>
                    </div>
                    <div class="form-group">
                        <label for="pro_huongvi">Hương Vị:</label>
                        <input type="text" class="form-control" name="pro_huongvi" required>
                    </div>
                    <div class="form-group">
                        <label for="pro_thuonghieu">Thương Hiệu:</label>
                        <input type="text" class="form-control" name="pro_thuonghieu" required>
                    </div>
                    <div class="form-group">
                        <label for="pro_danhmuc">Danh Mục:</label>
                        <input type="text" class="form-control" name="pro_danhmuc" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

