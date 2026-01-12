<!DOCTYPE html>
<html>

<head>
    <title>Xóa User</title>
</head>

<body>
    <h2 style="color:red;">Xóa thành viên?</h2>
    <p>Bạn có chắc muốn xóa tài khoản: <strong><?php echo htmlspecialchars($user['email']); ?></strong>?</p>

    <form method="POST" action="">
        <button type="submit">Đồng ý Xóa</button>
        <a href="?module=user&action=list">Quay lại</a>
    </form>
</body>

</html>