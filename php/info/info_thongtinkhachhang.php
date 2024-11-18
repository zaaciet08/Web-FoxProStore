<?php
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
$query = "SELECT user_email, user_name FROM tbl_accounts WHERE user_id = ?" ;
// Sử dụng prepared statement để tránh SQL injection
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
if ($result->num_rows > 0) {
    // Lặp qua từng dòng dữ liệu
    while ($row = $result->fetch_assoc()) {
        // Truyền dữ liệu vào biểu mẫu tương ứng
        $email = $row['user_email'];
        $name = $row['user_name'];
    ?>
    <?php 
    
   
    echo'            <table>';
    echo'                <tr>';
    echo'                    <th colspan="3">THÔNG TIN KHÁCH HÀNG</th>';
    echo'                </tr>';
    echo'                <tr>';
    echo'                    <td>Tài khoản: </td>';
    echo'                    <td> <input type="text" value="'.$email.'" disabled></td>';
    echo'                    <td></td>';
    echo'                </tr>';
    echo'                <tr>';
    echo'                    <td>Mật khẩu: </td>';
    echo'                    <td style="text-align: center;">';
    echo'                        <i class="fa fa-pencil" id="butDoiMatKhau" onclick="openChangePass()"> </i>';
    echo'                    </td>';
    echo'                    <td></td>';
    echo'                </tr>';
    echo'                <tr>';
    echo'                    <td colspan="3" id="khungDoiMatKhau">';
    echo'                        <table>';
    echo'                            <tr>';
    echo'                                <td>';
    echo'                                    <div>Mật khẩu cũ:</div>';
    echo'                              </td>';
    echo'                                <td>';
    echo'                                    <div><input type="password" name="oldpass"></div>';
    echo'                                </td>';
    echo'                            </tr>';
    echo'                            <tr>';
    echo'                                <td>';
    echo'                                    <div>Mật khẩu mới:</div>';
    echo'                                </td>';
    echo'                                <td>';
    echo'                                    <div><input type="password" name="newpass"></div>';
    echo'                                </td>';
    echo'                            </tr>';
    echo'                            <tr>';
    echo'                                <td>';
    echo'                                    <div>Xác nhận mật khẩu:</div>';
    echo'                                </td>';
    echo'                                <td>';
    echo'                                    <div><input type="password" name="resetpass"></div>';
    echo'                                </td>';
    echo'                            </tr>';
    echo'                            <tr>';
    echo'                                <td></td>';
    echo'                                <td>';
    echo'                                    <div><button type="submit" class="form__btn" name="submit_updateacc">Đồng ý</button></div>';
    echo'                                </td>';
    echo'                            </tr>';
    echo'                        </table>';
    echo'                    </td>';
    echo'                </tr>';  
    echo'                <tr>';
    echo'                    <td>Họ và tên: </td>';
    echo'                    <td> <input type="text" value="'.$name.'" name="hoTen"></td>';
    echo'                    <td></td>';
    echo'               </tr>';
    }
}
}
}
?>
    <!--================================ Xử lí load user_info ==============================================-->
    <?php
// Lấy user_id từ phiên đăng nhập
$user_id = $_SESSION["user_id"];

// Chuẩn bị truy vấn SQL để lấy thông tin từ bảng tbl_user_info
$sql = "SELECT * FROM tbl_user_info WHERE user_id = ?";

// Sử dụng prepared statement
$stmt = $conn->prepare($sql);

// Kiểm tra lỗi prepared statement
if ($stmt === false) {
    die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
}

// Sử dụng bind_param với kiểu dữ liệu phù hợp
$stmt->bind_param("i", $user_id);

// Thực hiện truy vấn
$stmt->execute();

// Lấy kết quả
$result = $stmt->get_result();
$hasPhoneNumber = false;
// Kiểm tra xem có dữ liệu hay không
if ($result->num_rows > 0) {
    // In thông tin ra table
    while ($row = $result->fetch_assoc()) {
        
        // Kiểm tra xem số điện thoại có được nhập hay không
        if (!empty($row['user_phone'])) {
            $hasPhoneNumber = true;
        }
        echo '<tr>';
        echo '<td>Điện thoại: </td>';
        echo '<td> <input type="text" value="' . $row['user_phone'] . '" name="soDienThoai" ></td>';
        echo '<td></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Giới tính: </td>';
        echo '<td> <select name="gioiTinh">';
        echo '<option value="Nam" ' . ($row['user_sex'] === 'Nam' ? 'selected' : '') . '>Nam</option>';
        echo '<option value="Nữ" ' . ($row['user_sex'] === 'Nữ' ? 'selected' : '') . '>Nữ</option>';
        echo '<option value="Khác" ' . ($row['user_sex'] === 'Khác' ? 'selected' : '') . '>Khác</option>';
        echo '</select></td>';
        echo '<td></td>';
        echo '</tr>';

        $ngaySinhFormatted = date("Y-m-d", strtotime($row['user_date']));
        echo '<tr>';
        echo '<td>Ngày sinh: </td>';
        echo '<td> <input type="date" value="'.$ngaySinhFormatted.'" name="ngaySinh"></td>';
        echo '<td></td>';
        echo '</tr>';     

        echo '<tr>';
        echo '<td>Tỉnh/TP: </td>';
        echo '<td> <select name="tinh" id="province">
        <option value="">-- Chọn tỉnh --</option>
        <option value="'.$row['user_province'].'" selected>'.$row['user_province'].'</option>
       </select></td>';
        echo '<td></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Quận/Huyện: </td>';
        echo '<td><select name="huyen" id="district">
        <option value="">-- Chọn Quận/Huyện --</option>
        <option value="'.$row['user_distric'].'" selected>'.$row['user_distric'].'</option>
        </select></td>';
        echo '<td></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Xã: </td>';
        echo '<td><select name="xa" id="ward">
        <option value="">-- Chọn Xã/Phường --</option>
        <option value="'.$row['user_ward'].'" selected>'.$row['user_ward'].'</option>
       </select></td>';
        echo '<td></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Địa chỉ: </td>';
        echo '<td> <input type="text" value="' . $row['user_address'] . '" name="diaChi" ></td>';
        echo '<td></td>';
        echo '</tr>';
    }
} else {
        echo '<tr>';
        echo '<td>Điện thoại: </td>';
        echo '<td> <input type="text" value="" name="soDienThoai" ></td>';
        echo '<td></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Giới tính: </td>';
        echo '<td> <select name="gioiTinh">';
        echo '<option value="Nam" ' . ($row['user_sex'] === 'Nam' ? 'selected' : '') . '>Nam</option>';
        echo '<option value="Nữ" ' . ($row['user_sex'] === 'Nữ' ? 'selected' : '') . '>Nữ</option>';
        echo '<option value="Khác" ' . ($row['user_sex'] === 'Khác' ? 'selected' : '') . '>Khác</option>';
        echo '</select></td>';
        echo '<td></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Ngày sinh: </td>';
        echo '<td> <input type="date" value="" name="ngaySinh"></td>';
        echo '<td></td>';
        echo '</tr>';     
        echo '<tr>';
        echo '<td>Tỉnh: </td>';
        echo '<td> <select name="tinh" id="province">
        <option value="">-- Chọn tỉnh --</option>
        <option value="" selected></option>
       </select></td>';
        echo '<td></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Huyện: </td>';
        echo '<td><select name="huyen" id="district">
        <option value="">-- Chọn Quận/Huyện --</option>
        <option value="" selected></option>
        </select></td>';
        echo '<td></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Xã: </td>';
        echo '<td><select name="xa" id="ward">
        <option value="">-- Chọn Xã/Phường --</option>
        <option value="" selected></option>
       </select></td>';
        echo '<td></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Địa chỉ: </td>';
        echo '<td> <input type="text" value="" name="diaChi"></td>';
        echo '<td></td>';
        echo '</tr>';
}

?>
    <tr>
        <td colspan="3" style="padding:5px; border-top: 2px solid #ccc;"></td>
    </tr>
    <tr>
        <td>Thao tác: </td>
        <?php
    // Sử dụng biến $hasPhoneNumber để quyết định hiển thị nút nào
    if ($hasPhoneNumber) {
        echo '<td><button type="submit" class="form__btn" name="submit_updateinfo"><i class="fa-solid fa-arrows-rotate" title="Cập nhật thông tin"></i></button></td>';
    } else {
        echo '<td><button type="submit" class="form__btn" name="submit"><i class="fa-solid fa-cloud-arrow-up" title="Hoàn thiện thông tin"></i></button></td>';
    }
    
    echo '</tr>';
    echo '</table>';
    ?>
     <!--===================================== Xử lí add thông tin khách hàng ===================-->
     <?php
$user_id = $_SESSION["user_id"];
$email = $_SESSION['user_email'];
// Bắt đầu phiên
if (isset($_POST["submit"])) {
    // Kiểm tra xem thông tin đã tồn tại hay chưa
$sqlCheck = "SELECT * FROM tbl_user_info WHERE user_id = ?";
$stmtCheck = $conn->prepare($sqlCheck);

// Kiểm tra lỗi prepared statement
if ($stmtCheck === false) {
    die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
}

// Sử dụng bind_param với kiểu dữ liệu phù hợp
$stmtCheck->bind_param("i", $user_id);

// Thực hiện truy vấn SELECT
$stmtCheck->execute();

// Lấy kết quả
$resultCheck = $stmtCheck->get_result();

// Kiểm tra xem có dữ liệu hay không
if ($resultCheck->num_rows > 0) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Thông tin đã tồn tại!',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = 'info.php';
        });
    </script>";
} 
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $hoTen = $_POST["hoTen"];
        $soDienThoai = $_POST["soDienThoai"];
        $gioiTinh = $_POST["gioiTinh"];
        $tinh = $_POST["tinh"];
        $huyen = $_POST["huyen"];
        $xa = $_POST["xa"];
        $diaChi = $_POST["diaChi"];
        $ngaySinh = $_POST["ngaySinh"];
        $ngaySinh = date("Y-m-d", strtotime($ngaySinh));
        // Lấy user_id từ phiên đăng nhập
       
        // Chuẩn bị truy vấn SQL để chèn dữ liệu vào bảng tbl_user_info
        $sql = "INSERT INTO tbl_user_info (user_id, user_name, user_email, user_phone, user_sex, user_date, user_province, user_distric, user_ward, user_address)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // Sử dụng prepared statement
        $stmt = $conn->prepare($sql);
        // Kiểm tra lỗi prepared statement
        if ($stmt === false) {
            die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
        }

        // Sử dụng bind_param với các kiểu dữ liệu phù hợp
        $stmt->bind_param("isssssssss", $user_id, $hoTen, $email, $soDienThoai, $gioiTinh, $ngaySinh, $tinh, $huyen, $xa, $diaChi);
       
        // Thực hiện truy vấn
        if (empty($hoTen) || empty($soDienThoai) || empty($tinh) || empty($huyen) || empty($xa) || empty($diaChi)) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Vui lòng nhập đầy đủ thông tin!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'info.php';
                });
            </script>";

        }else if ($stmt->execute()) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Đã hoàn thiện thông tin của bạn !',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'info.php';
            });
        </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Thêm thất bại!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'info.php';
                });
            </script>";
        }

        // Đóng statement
        $stmt->close();
    }
}
?>

    <!--=============================== Hàm xử lí thay đổi mật khẩu ===============================-->
    <?php

// Lấy user_id từ phiên đăng nhập
$user_id = $_SESSION["user_id"];

if (isset($_POST["submit_updateacc"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $matKhauCu = $_POST["oldpass"];
        $matKhauMoi = $_POST["newpass"];
        $xacNhanMatKhau = $_POST["resetpass"];

        // Kiểm tra tính hợp lệ của dữ liệu (ví dụ: mật khẩu cũ phải đúng)
        // Note: Trong ứng dụng thực tế, bạn cần thêm nhiều kiểm tra hơn
        $sql = "SELECT user_password FROM tbl_accounts WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if(empty($matKhauCu)||empty( $matKhauMoi)||empty($xacNhanMatKhau)){
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Vui lòng điền đầy đủ thông tin!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'info.php';
            });
        </script>";
        }
        else if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $matKhauHienTai = $row["user_password"];

            if (password_verify($matKhauCu, $matKhauHienTai) && $matKhauMoi === $xacNhanMatKhau) {
                // Mật khẩu cũ đúng và mật khẩu mới khớp, cập nhật mật khẩu mới
                $hashedMatKhauMoi = password_hash($matKhauMoi, PASSWORD_DEFAULT);
                $updateSql = "UPDATE tbl_accounts SET user_password = ? WHERE user_id = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("si", $hashedMatKhauMoi, $user_id);

                if ($updateStmt->execute()) {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Thay đổi mật khẩu thành công!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = 'info.php';
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Thay đổi mật khẩu thất bại!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = 'info.php';
                        });
                    </script>";
                }

                $updateStmt->close();
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Mật khẩu không đúng hoặc không trùng khớp!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'info.php';
                    });
                </script>";
            }
        } else {
            echo "Không tìm thấy tài khoản.";
        }

        $stmt->close();
    }
}


?>
    <!--================================ Xử lí update_user_info ==============================================-->
    <?php


// Lấy user_id từ phiên đăng nhập
$user_id = $_SESSION["user_id"];

if (isset($_POST["submit_updateinfo"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $hoTen = $_POST["hoTen"];
        $soDienThoai = $_POST["soDienThoai"];
        $gioiTinh = $_POST["gioiTinh"];
        $tinh = $_POST["tinh"];
        $huyen = $_POST["huyen"];
        $xa = $_POST["xa"];
        $diaChi = $_POST["diaChi"];
        $ngaySinh = $_POST["ngaySinh"];

        // Kiểm tra hoặc định dạng lại ngày
        $ngaySinh = date("Y-m-d", strtotime($ngaySinh));

        // Chuẩn bị truy vấn SQL để cập nhật dữ liệu trong bảng tbl_user_info
        $sql = "UPDATE tbl_user_info 
                SET user_name = ?, 
                    user_phone = ?, 
                    user_sex = ?, 
                    user_province = ?, 
                    user_distric = ?, 
                    user_ward = ?, 
                    user_address = ?, 
                    user_date = ?
                WHERE user_id = ?";

        // Sử dụng prepared statement
        $stmt = $conn->prepare($sql);

        // Kiểm tra lỗi prepared statement
        if ($stmt === false) {
            die("Lỗi prepared statement: " . htmlspecialchars($conn->error));
        }

        // Sử dụng bind_param với các kiểu dữ liệu phù hợp
        $stmt->bind_param("ssssssssi", $hoTen, $soDienThoai, $gioiTinh, $tinh, $huyen, $xa, $diaChi, $ngaySinh, $user_id);
        if (empty($hoTen) || empty($soDienThoai) || empty($tinh) || empty($huyen) || empty($xa) || empty($diaChi)) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Vui lòng nhập đầy đủ thông tin!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'info.php';
                });
            </script>";

        }else if ($stmt->execute()) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Cập nhật thông tin thành công!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'info.php';
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Cập nhật thông tin thất bại!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'info.php';
                    });
                </script>";
        }

        // Đóng statement
        $stmt->close();
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    

    const host = "https://provinces.open-api.vn/api/";
var callAPI = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data, "province");
        });
}
callAPI('https://provinces.open-api.vn/api/?depth=1');
var callApiDistrict = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data.districts, "district");
        });
}
var callApiWard = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data.wards, "ward");
        });
}

var renderData = (array, select) => {
    let row = ' <option disable value="">Chọn</option>';
    array.forEach(element => {
        row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
    });
    document.querySelector("#" + select).innerHTML = row
}

$("#province").change(() => {
    callApiDistrict(host + "p/" + $("#province").find(':selected').data('id') + "?depth=2");
    printResult();
});
$("#district").change(() => {
    callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
    printResult();
});
$("#ward").change(() => {
    printResult();
})

var printResult = () => {
    if ($("#district").find(':selected').data('id') != "" && $("#province").find(':selected').data('id') != "" &&
        $("#ward").find(':selected').data('id') != "") {
        let result = $("#province option:selected").text() +
            " | " + $("#district option:selected").text() + " | " +
            $("#ward option:selected").text();
        $("#result").text(result)
        console.log($("#province").val());
    }

}
</script>