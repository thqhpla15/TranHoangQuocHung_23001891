<?php

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

require_once __DIR__ . "/model/product.php";

$id = $_GET["id"] ?? "";

if (
        filter_var($id, FILTER_VALIDATE_INT) === false ||
        (int)$id <= 0
) {
    require_once __DIR__ . "/view/header.php";
    echo "<p>ID sản phẩm không hợp lệ.</p>";
    echo '<p><a href="product_list.php">Quay lại danh sách</a></p>';
    require_once __DIR__ . "/view/footer.php";
    exit;
}

$id = (int)$id;
$product = getProductById($id);

if (!$product) {
    require_once __DIR__ . "/view/header.php";
    echo "<p>Sản phẩm không tồn tại.</p>";
    echo '<p><a href="product_list.php">Quay lại danh sách</a></p>';
    require_once __DIR__ . "/view/footer.php";
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST["csrf_token"] ?? "";
    $sessionToken = $_SESSION["csrf_token"] ?? "";

    if (
            !is_string($token) ||
            !is_string($sessionToken) ||
            $sessionToken === "" ||
            !hash_equals($sessionToken, $token)
    ) {
        http_response_code(403);
        $error = "Yêu cầu không hợp lệ. Vui lòng tải lại trang.";
    } elseif (deleteProduct($id)) {
        header("Location: product_list.php");
        exit;
    } else {
        $error = "Không thể xóa sản phẩm. Vui lòng thử lại.";
    }
}

require_once __DIR__ . "/view/header.php";
?>

<h2>Xóa sản phẩm</h2>

<?php if ($error !== ""): ?>
    <p><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></p>
<?php endif; ?>

<p>
    Bạn có chắc chắn muốn xóa sản phẩm
    <strong><?= htmlspecialchars($product["name"], ENT_QUOTES, "UTF-8") ?></strong>
    không?
</p>

<form method="POST" action="product_delete.php?id=<?= $id ?>">
    <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($_SESSION["csrf_token"], ENT_QUOTES, "UTF-8") ?>"
    >
    <button type="submit">Xác nhận xóa</button>
    <a href="product_list.php">Hủy</a>
</form>

<?php require_once __DIR__ . "/view/footer.php"; ?>