<?php
include 'db/connect.php';

// Thêm menu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $menu_name = $_POST["menu_name"];
    $menu_link = $_POST["menu_link"];

    $sql = "INSERT INTO tbl_menu (menu_name, menu_link) VALUES ('$menu_name', '$menu_link')";
    $conn->query($sql);
}

// Sửa menu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $menu_id = $_POST["menu_id"];
    $menu_name = $_POST["menu_name"];
    $menu_link = $_POST["menu_link"];

    $sql = "UPDATE tbl_menu SET menu_name='$menu_name', menu_link='$menu_link' WHERE menu_id='$menu_id'";
    $conn->query($sql);
}

// Xóa menu
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $menu_id = $_GET["delete"];

    $sql = "DELETE FROM tbl_menu WHERE menu_id='$menu_id'";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Menu</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Quản Lý Menu</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMenuModal">
        Thêm Menu
    </button>

    <br><br>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Menu Name</th>
            <th>Menu Link</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM tbl_menu");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['menu_id']}</td>
                    <td>{$row['menu_name']}</td>
                    <td>{$row['menu_link']}</td>
                    <td>
                        <a href='#' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal{$row['menu_id']}'>Xóa</a>
                        <a href='#' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editModal{$row['menu_id']}'>Sửa</a>
                    </td>
                </tr>";

            // Modal for Delete
            echo "<div class='modal fade' id='deleteModal{$row['menu_id']}' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='deleteModalLabel'>Xác nhận Xóa</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                Bạn có chắc chắn muốn xóa menu này không?
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Đóng</button>
                                <a href='?delete={$row['menu_id']}' class='btn btn-danger'>Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>";

            // Modal for Edit
            echo "<div class='modal fade' id='editModal{$row['menu_id']}' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='editModalLabel'>Chỉnh Sửa Menu</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <form method='post'>
                                    <input type='hidden' name='menu_id' value='{$row['menu_id']}'>
                                    <div class='form-group'>
                                        <label for='menu_name'>Menu Name:</label>
                                        <input type='text' class='form-control' name='menu_name' value='{$row['menu_name']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='menu_link'>Menu Link:</label>
                                        <input type='text' class='form-control' name='menu_link' value='{$row['menu_link']}' required>
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
<div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMenuModalLabel">Thêm Menu Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="menu_name">Menu Name:</label>
                        <input type="text" class="form-control" name="menu_name" required>
                    </div>
                    <div class="form-group">
                        <label for="menu_link">Menu Link:</label>
                        <input type="text" class="form-control" name="menu_link" required>
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
