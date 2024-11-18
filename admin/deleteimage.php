<?php
include 'db/connect.php';
if (isset($_POST['img_id'])) {
    $img_id = $_POST['img_id'];

    // Perform the deletion from tbl_image
    $query_delete_image = 'DELETE FROM tbl_image WHERE img_id = ?';
    $stmt_delete_image = $conn->prepare($query_delete_image);
    $stmt_delete_image->bind_param('i', $img_id);

    if ($stmt_delete_image->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt_delete_image->close();
} else {
    echo 'error';
}

$conn->close();
?>