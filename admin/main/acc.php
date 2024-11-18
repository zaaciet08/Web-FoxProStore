<?php
include 'db/connect.php';

// Thêm tài khoản
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $acc_user = $_POST["acc_user"];
    $acc_pass = $_POST["acc_pass"];
    $tensp = $_POST["tensp"];

    $sql = "INSERT INTO tbl_account (acc_user, acc_pass, tensp) VALUES ('$acc_user', '$acc_pass', '$tensp')";
    $conn->query($sql);
}

// Sửa tài khoản
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $id = $_POST["id"];
    $acc_user = $_POST["acc_user"];
    $acc_pass = $_POST["acc_pass"];
    $tensp = $_POST["tensp"];

    $sql = "UPDATE tbl_account SET acc_user='$acc_user', acc_pass='$acc_pass', tensp='$tensp' WHERE id='$id'";
    $conn->query($sql);
}

// Xóa tài khoản
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $id = $_GET["delete"];

    $sql = "DELETE FROM tbl_account WHERE id='$id'";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tài Khoản</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Quản Lý Tài Khoản</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccountModal">
        Thêm Tài Khoản
    </button>

    <br><br>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tài Khoản Người Dùng</th>
            <th>Mật Khẩu</th>
            <th>Tên Sản Phẩm</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM tbl_account");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['acc_user']}</td>
                    <td>{$row['acc_pass']}</td>
                    <td>{$row['tensp']}</td>
                    <td>
                        <a href='#' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal{$row['id']}'>Xóa</a>
                        <a href='#' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editModal{$row['id']}'>Sửa</a>
                    </td>
                </tr>";

            // Modal for Delete
            echo "<div class='modal fade' id='deleteModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='deleteModalLabel'>Xác nhận Xóa</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                Bạn có chắc chắn muốn xóa tài khoản này không?
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Đóng</button>
                                <a href='?delete={$row['id']}' class='btn btn-danger'>Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>";

            // Modal for Edit
            echo "<div class='modal fade' id='editModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='editModalLabel'>Chỉnh Sửa Tài Khoản</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <form method='post'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <div class='form-group'>
                                        <label for='acc_user'>Tài Khoản Người Dùng:</label>
                                        <input type='text' class='form-control' name='acc_user' value='{$row['acc_user']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='acc_pass'>Mật Khẩu:</label>
                                        <input type='password' class='form-control' name='acc_pass' value='{$row['acc_pass']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='tensp'>Tên Sản Phẩm:</label>
                                        <input type='text' class='form-control' name='tensp' value='{$row['tensp']}' required>
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
<div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAccountModalLabel">Thêm Tài Khoản Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="acc_user">Tài Khoản Người Dùng:</label>
                        <input type="text" class="form-control" name="acc_user" required>
                    </div>
                    <div class="form-group">
                        <label for="acc_pass">Mật Khẩu:</label>
                        <input type="password" class="form-control" name="acc_pass" required>
                    </div>
                    <div class="form-group">
                        <label for="tensp">Tên Sản Phẩm:</label>
                        <input type="text" class="form-control" name="tensp" required>
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
