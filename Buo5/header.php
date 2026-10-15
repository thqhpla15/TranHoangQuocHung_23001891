<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>

<h1>Shopping Cart</h1>

<?php if (isset($_SESSION["username"])): ?>
    <p>
        Xin chào,
        <strong><?= htmlspecialchars($_SESSION["username"], ENT_QUOTES, "UTF-8") ?></strong>
        |
        <a href="logout.php">Đăng xuất</a>
    </p>
<?php endif; ?>

<hr>