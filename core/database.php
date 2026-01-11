<?php
// config/db.php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "shop_online";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) die("Lỗi kết nối: " . mysqli_connect_error());
mysqli_set_charset($conn, "utf8");
?>