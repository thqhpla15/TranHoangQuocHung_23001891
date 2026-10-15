<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: product_list.php");
    exit;
}

require_once __DIR__ . "/user.php";

$username = "";
$error = "";

$successMessage = $_SESSION["flash_message"] ?? "";
unset($_SESSION["flash_message"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    $user = getUserByUsername($username);

    if ($user && password_verify($password, $user["password"])) {
        session_regenerate_id(true);

        $_SESSION["username"] = $user["username"];
        $_SESSION["user_id"] = $user["id"];

        header("Location: product_list.php");
        exit;
    }

    $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
}

require_once __DIR__ . "/view/header.php";
?>

<h2>Đăng nhập</h2>

<?php if ($successMessage !== ""): ?>
    <p><?= htmlspecialchars($successMessage, ENT_QUOTES, "UTF-8") ?></p>
<?php endif; ?>

<?php if ($error !== ""): ?>
    <p><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></p>
<?php endif; ?>

<form method="POST" action="login.php">
    <label for="username">Tên đăng nhập:</label>
    <input
            type="text"
            id="username"
            name="username"
            value="<?= htmlspecialchars($username, ENT_QUOTES, "UTF-8") ?>"
            required
    >
    <br><br>

    <label for="password">Mật khẩu:</label>
    <input type="password" id="password" name="password" required>
    <br><br>

    <button type="submit">Đăng nhập</button>
</form>

<p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>

<?php require_once __DIR__ . "/view/footer.php"; ?>