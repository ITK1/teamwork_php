<!DOCTYPE html>
<html>

<head>
    <title>Đăng ký</title>
</head>

<body>
    <h2>Đăng Ký</h2>
    <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
    <?php if ($success) echo "<p style='color:green'>$success</p>"; ?>

    <form method="POST" action="?module=auth&action=register">
        User: <input type="text" name="username" required><br>
        Email: <input type="email" name="email" required><br>
        Pass: <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
    <a href="?module=auth&action=login">Quay lại đăng nhập</a>
</body>

</html>