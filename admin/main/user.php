<?php
include 'db/connect.php';

// Thêm người dùng
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $user_name = $_POST["user_name"];
    $user_pw = password_hash($_POST["user_pw"], PASSWORD_BCRYPT); // Hash mật khẩu
    $role = $_POST["role"];
    $sodu = $_POST["sodu"];

    $sql = "INSERT INTO tbl_user (name, address, email, user_name, user_pw, role, sodu) VALUES ('$name', '$address', '$email', '$user_name', '$user_pw', '$role', '$sodu')";
    $conn->query($sql);
}

// Sửa người dùng
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $user_name = $_POST["user_name"];
    $role = $_POST["role"];
    $sodu = $_POST["sodu"];

    // Kiểm tra xem mật khẩu có được cập nhật hay không
    $user_pw = empty($_POST["user_pw"]) ? "" : "user_pw='" . password_hash($_POST["user_pw"], PASSWORD_BCRYPT) . "',";

    $sql = "UPDATE tbl_user SET name='$name', address='$address', email='$email', user_name='$user_name', $user_pw role='$role', sodu='$sodu' WHERE id='$id'";
    $conn->query($sql);
}

// Xóa người dùng
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $id = $_GET["delete"];

    $sql = "DELETE FROM tbl_user WHERE id='$id'";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Quản Lý Người Dùng</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
        Thêm Người Dùng
    </button>

    <br><br>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Địa Chỉ</th>
            <th>Email</th>
            <th>Tên Người Dùng</th>
            <th>Quyền</th>
            <th>Số Dư</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM tbl_user");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['user_name']}</td>
                    <td>{$row['role']}</td>
                    <td>{$row['sodu']}</td>
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
                                Bạn có chắc chắn muốn xóa người dùng này không?
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
                                <h5 class='modal-title' id='editModalLabel'>Chỉnh Sửa Người Dùng</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <form method='post'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <div class='form-group'>
                                        <label for='name'>Tên:</label>
                                        <input type='text' class='form-control' name='name' value='{$row['name']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='address'>Địa Chỉ:</label>
                                        <input type='text' class='form-control' name='address' value='{$row['address']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='email'>Email:</label>
                                        <input type='email' class='form-control' name='email' value='{$row['email']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='user_name'>Tên Người Dùng:</label>
                                        <input type='text' class='form-control' name='user_name' value='{$row['user_name']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='user_pw'>Mật Khẩu:</label>
                                        <input type='password' class='form-control' name='user_pw' placeholder='Nhập mật khẩu mới nếu muốn thay đổi'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='role'>Quyền:</label>
                                        <input type='text' class='form-control' name='role' value='{$row['role']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='sodu'>Số Dư:</label>
                                        <input type='text' class='form-control' name='sodu' value='{$row['sodu']}' required>
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
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Thêm Người Dùng Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa Chỉ:</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="user_name">Tên Người Dùng:</label>
                        <input type="text" class="form-control" name="user_name" required>
                    </div>
                    <div class="form-group">
                        <label for="user_pw">Mật Khẩu:</label>
                        <input type="password" class="form-control" name="user_pw" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Quyền:</label>
                        <input type="text" class="form-control" name="role" required>
                    </div>
                    <div class="form-group">
                        <label for="sodu">Số Dư:</label>
                        <input type="text" class="form-control" name="sodu" required>
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
