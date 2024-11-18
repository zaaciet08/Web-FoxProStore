<?php
include 'db/connect.php';

// Thêm danh mục
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $category_name = $_POST["category_name"];

    $sql = "INSERT INTO tbl_category (category_name) VALUES ('$category_name')";
    $conn->query($sql);
}

// Sửa danh mục
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $category_id = $_POST["category_id"];
    $category_name = $_POST["category_name"];

    $sql = "UPDATE tbl_category SET category_name='$category_name' WHERE category_id='$category_id'";
    $conn->query($sql);
}

// Xóa danh mục
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $category_id = $_GET["delete"];

    $sql = "DELETE FROM tbl_category WHERE category_id='$category_id'";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Mục</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Quản Lý Danh Mục</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
        Thêm Danh Mục
    </button>

    <br><br>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên Danh Mục</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM tbl_category");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['category_id']}</td>
                    <td>{$row['category_name']}</td>
                    <td>
                        <a href='#' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal{$row['category_id']}'>Xóa</a>
                        <a href='#' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editModal{$row['category_id']}'>Sửa</a>
                    </td>
                </tr>";

            // Modal for Delete
            echo "<div class='modal fade' id='deleteModal{$row['category_id']}' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='deleteModalLabel'>Xác nhận Xóa</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                Bạn có chắc chắn muốn xóa danh mục này không?
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Đóng</button>
                                <a href='?delete={$row['category_id']}' class='btn btn-danger'>Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>";

            // Modal for Edit
            echo "<div class='modal fade' id='editModal{$row['category_id']}' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='editModalLabel'>Chỉnh Sửa Danh Mục</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <form method='post'>
                                    <input type='hidden' name='category_id' value='{$row['category_id']}'>
                                    <div class='form-group'>
                                        <label for='category_name'>Tên Danh Mục:</label>
                                        <input type='text' class='form-control' name='category_name' value='{$row['category_name']}' required>
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
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Thêm Danh Mục Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="category_name">Tên Danh Mục:</label>
                        <input type="text" class="form-control" name="category_name" required>
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

</body>
</html>
