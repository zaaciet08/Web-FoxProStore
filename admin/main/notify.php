<?php
include 'db/connect.php';

// Thêm thông báo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $notify_name = $_POST["notify_name"];
    $notify_img = $_POST["notify_img"];
    $notify_stt = $_POST["notify_stt"];

    $sql = "INSERT INTO tbl_notify (notify_name, notify_img, notify_stt) VALUES ('$notify_name', '$notify_img', '$notify_stt')";
    $conn->query($sql);
}

// Sửa thông báo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $id = $_POST["id"];
    $notify_name = $_POST["notify_name"];
    $notify_img = $_POST["notify_img"];
    $notify_stt = $_POST["notify_stt"];

    $sql = "UPDATE tbl_notify SET notify_name='$notify_name', notify_img='$notify_img', notify_stt='$notify_stt' WHERE id='$id'";
    $conn->query($sql);
}

// Xóa thông báo
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $id = $_GET["delete"];

    $sql = "DELETE FROM tbl_notify WHERE id='$id'";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Thông Báo</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Quản Lý Thông Báo</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNotifyModal">
        Thêm Thông Báo
    </button>

    <br><br>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên Thông Báo</th>
            <th>Ảnh</th>
            <th>Trạng Thái</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM tbl_notify");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['notify_name']}</td>
                    <td><img src='{$row['notify_img']}' alt='Image' width='50'></td>
                    <td>{$row['notify_stt']}</td>
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
                                Bạn có chắc chắn muốn xóa thông báo này không?
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
                                <h5 class='modal-title' id='editModalLabel'>Chỉnh Sửa Thông Báo</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <form method='post'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <div class='form-group'>
                                        <label for='notify_name'>Tên Thông Báo:</label>
                                        <input type='text' class='form-control' name='notify_name' value='{$row['notify_name']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='notify_img'>Ảnh:</label>
                                        <input type='text' class='form-control' name='notify_img' value='{$row['notify_img']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='notify_stt'>Trạng Thái:</label>
                                        <input type='text' class='form-control' name='notify_stt' value='{$row['notify_stt']}' required>
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
<div class="modal fade" id="addNotifyModal" tabindex="-1" role="dialog" aria-labelledby="addNotifyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNotifyModalLabel">Thêm Thông Báo Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="notify_name">Tên Thông Báo:</label>
                        <input type="text" class="form-control" name="notify_name" required>
                    </div>
                    <div class="form-group">
                        <label for="notify_img">Ảnh:</label>
                        <input type="text" class="form-control" name="notify_img" required>
                    </div>
                    <div class="form-group">
                        <label for="notify_stt">Trạng Thái:</label>
                        <input type="text" class="form-control" name="notify_stt" required>
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
