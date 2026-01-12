<?php
require_once __DIR__ .'/../core/Database.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập</title>
</head>

<body>
    <h2>Đăng Nhập</h2>
    <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>

    <form method="POST" action="?module=auth&action=login">
        Email: <input type="email" name="email" required><br>
        Pass: <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <a href="?module=auth&action=register">Đăng ký</a>
</body>

</html>