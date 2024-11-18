<?php
// update_total.php

if (isset($_POST['total'])) {
    $total = $_POST['total'];
    echo number_format(floatval($total), 0, ',', '.') . 'đ';
}
?>
