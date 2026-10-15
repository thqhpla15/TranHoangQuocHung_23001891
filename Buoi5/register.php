<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: product_list.php");
    exit;
}

require_once __DIR__ . "/user.php";

$username = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";

    if ($username === "") {
        $errors[] = "Tên đăng nhập không được để trống.";
    } elseif (strlen($username) > 50) {
        $errors[] = "Tên đăng nhập không được vượt quá 50 byte.";
    } elseif (getUserByUsername($username)) {
        $errors[] = "Tên đăng nhập đã tồn tại.";
    }

    if ($password === "") {
        $errors[] = "Mật khẩu không được để trống.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Mật khẩu xác nhận không khớp.";
    }

    if (empty($errors)) {
        if (registerUser($username, $password)) {
            $_SESSION["flash_message"] = "Đăng ký thành công. Vui lòng đăng nhập.";
            header("Location: login.php");
            exit;
        }

        $errors[] = "Đăng ký thất bại. Vui lòng thử lại.";
    }
}

require_once __DIR__ . "/view/header.php";
?>

<h2>Đăng ký tài khoản</h2>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST" action="register.php">
    <label for="username">Tên đăng nhập:</label>
    <input
        type="text"
        id="username"
        name="username"
        maxlength="50"
        value="<?= htmlspecialchars($username, ENT_QUOTES, "UTF-8") ?>"
        required
    >
    <br><br>

    <label for="password">Mật khẩu:</label>
    <input type="password" id="password" name="password" required>
    <br><br>

    <label for="confirm_password">Xác nhận mật khẩu:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <br><br>

    <button type="submit">Đăng ký</button>
</form>

<p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>

<?php require_once __DIR__ . "/view/footer.php"; ?>