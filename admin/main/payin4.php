<?php
include 'db/connect.php';

// Thêm đơn đặt hàng
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $order_code = $_POST["order_code"];
    $user_id = $_POST["user_id"];
    $order_name = $_POST["order_name"];
    $order_phone = $_POST["order_phone"];
    $order_province = $_POST["order_province"];
    $order_district = $_POST["order_district"];
    $order_ward = $_POST["order_ward"];
    $order_address = $_POST["order_address"];
    $order_date = $_POST["order_date"];
    $order_status = $_POST["order_status"];

    $sql = "INSERT INTO orders (order_code, user_id, order_name, order_phone, order_province, order_district, order_ward, order_address, order_date, order_status) 
            VALUES ('$order_code', '$user_id', '$order_name', '$order_phone', '$order_province', '$order_district', '$order_ward', '$order_address', '$order_date', '$order_status')";
    $conn->query($sql);
}

// Sửa đơn đặt hàng
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $order_id = $_POST["order_id"];
    $order_code = $_POST["order_code"];
    $user_id = $_POST["user_id"];
    $order_name = $_POST["order_name"];
    $order_phone = $_POST["order_phone"];
    $order_province = $_POST["order_province"];
    $order_district = $_POST["order_district"];
    $order_ward = $_POST["order_ward"];
    $order_address = $_POST["order_address"];
    $order_date = $_POST["order_date"];
    $order_status = $_POST["order_status"];

    $sql = "UPDATE orders 
            SET order_code='$order_code', user_id='$user_id', order_name='$order_name', order_phone='$order_phone', 
                order_province='$order_province', order_district='$order_district', order_ward='$order_ward', 
                order_address='$order_address', order_date='$order_date', order_status='$order_status' 
            WHERE order_id='$order_id'";
    $conn->query($sql);
}

// Xóa đơn đặt hàng
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $order_id = $_GET["delete"];

    $sql = "DELETE FROM orders WHERE order_id='$order_id'";
    $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Thanh Toán</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Quản Lý Thanh Toán</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPaymentModal">
        Thêm Thanh Toán
    </button>

    <br><br>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên Người Dùng</th>
            <th>Số Tiền</th>
            <th>Trạng Thái</th>
            <th>Mã Sản Phẩm</th>
            <th>Thao tác</th>
           
        </tr>
        </thead>
        <tbody>
        <?php
$resultOrders = $conn->query("SELECT * FROM tbl_order");

while ($rowOrder = $resultOrders->fetch_assoc()) {
    echo "<tr>
            <td>{$rowOrder['order_id']}</td>
            <td>{$rowOrder['order_code']}</td>
            <td>{$rowOrder['user_id']}</td>
            <td>{$rowOrder['order_name']}</td>
            <td>{$rowOrder['order_phone']}</td>
            <td>{$rowOrder['order_province']}</td>
            <td>{$rowOrder['order_distric']}</td>
            <td>{$rowOrder['order_ward']}</td>
            <td>{$rowOrder['order_address']}</td>
            <td>{$rowOrder['order_date']}</td>
            <td>{$rowOrder['order_status']}</td>
            <td>
                <a href='#' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteOrderModal{$rowOrder['order_id']}'>Xóa</a>
                <a href='#' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editOrderModal{$rowOrder['order_id']}'>Sửa</a>
            </td>
        </tr>";

    // Modal for Delete Order
    echo "<div class='modal fade' id='deleteOrderModal{$rowOrder['order_id']}' tabindex='-1' role='dialog' aria-labelledby='deleteOrderModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='deleteOrderModalLabel'>Xác nhận Xóa</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        Bạn có chắc chắn muốn xóa đơn đặt hàng này không?
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Đóng</button>
                        <a href='?deleteOrder={$rowOrder['order_id']}' class='btn btn-danger'>Xóa</a>
                    </div>
                </div>
            </div>
        </div>";

    // Modal for Edit Order
    echo "<div class='modal fade' id='editOrderModal{$rowOrder['order_id']}' tabindex='-1' role='dialog' aria-labelledby='editOrderModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='editOrderModalLabel'>Chỉnh Sửa Đơn Đặt Hàng</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form method='post'>
                            <input type='hidden' name='order_id' value='{$rowOrder['order_id']}'>
                            <!-- Thêm các trường thông tin đơn đặt hàng tương tự như đã làm với thanh toán -->
                            <div class='form-group'>
                                <label for='order_name'>Tên Người Đặt Hàng:</label>
                                <input type='text' class='form-control' name='order_name' value='{$rowOrder['order_name']}' required>
                            </div>
                            <div class='form-group'>
                                <label for='order_phone'>Số Điện Thoại:</label>
                                <input type='text' class='form-control' name='order_phone' value='{$rowOrder['order_phone']}' required>
                            </div>
                            <!-- ... Thêm các trường khác tương tự ... -->
                            <button type='submit' class='btn btn-primary' name='editOrder'>Lưu</button>
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
<div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentModalLabel">Thêm Thanh Toán Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="user_name">Tên Người Dùng:</label>
                        <input type="text" class="form-control" name="user_name" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_amount">Số Tiền:</label>
                        <input type="text" class="form-control" name="payment_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_status">Trạng Thái:</label>
                        <input type="text" class="form-control" name="payment_status" required>
                    </div>
                    <div class="form-group">
                        <label for="ma_sp">Mã Sản Phẩm:</label>
                        <input type="text" class="form-control" name="ma_sp" required>
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
