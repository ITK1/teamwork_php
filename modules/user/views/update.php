<!DOCTYPE html>
<html>

<head>
    <title>Sửa User</title>
</head>

<body>
    <h2>Cập nhật thông tin: <?php echo htmlspecialchars($user['username']); ?></h2>

    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>

        <label>Mật khẩu mới (Để trống nếu không đổi):</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Lưu thay đổi</button>
        <a href="?module=user&action=list">Hủy</a>
    </form>
</body>

</html>