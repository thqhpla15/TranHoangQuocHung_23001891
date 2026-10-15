<?php

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/model/product.php";

$name = "";
$price = "";
$quantity = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $price = trim($_POST["price"] ?? "");
    $quantity = trim($_POST["quantity"] ?? "");

    if ($name === "") {
        $errors[] = "Tên sản phẩm không được để trống.";
    } elseif (strlen($name) > 100) {
        $errors[] = "Tên sản phẩm không được vượt quá 100 byte.";
    }

    if ($price === "" || !is_numeric($price) || (float)$price <= 0) {
        $errors[] = "Giá phải là số lớn hơn 0.";
    } elseif (!is_finite((float)$price) || (float)$price > 99999999.99) {
        $errors[] = "Giá không hợp lệ hoặc vượt quá giới hạn cho phép.";
    } elseif (preg_match('/^\d+(?:\.\d{1,2})?$/', $price) !== 1) {
        $errors[] = "Giá chỉ được có tối đa 2 chữ số thập phân.";
    }

    if (
            $quantity === "" ||
            filter_var($quantity, FILTER_VALIDATE_INT) === false ||
            (int)$quantity < 0
    ) {
        $errors[] = "Số lượng phải là số nguyên không âm.";
    }

    if (empty($errors)) {
        if (addProduct($name, $price, $quantity)) {
            header("Location: product_list.php");
            exit;
        }

        $errors[] = "Không thể thêm sản phẩm. Vui lòng thử lại.";
    }
}

require_once __DIR__ . "/view/header.php";
?>

<h2>Thêm sản phẩm</h2>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST" action="product_add.php">
    <label for="name">Tên sản phẩm:</label>
    <input
            type="text"
            id="name"
            name="name"
            maxlength="100"
            value="<?= htmlspecialchars($name, ENT_QUOTES, "UTF-8") ?>"
            required
    >

    <br><br>

    <label for="price">Giá:</label>
    <input
            type="number"
            id="price"
            name="price"
            min="0.01"
            max="99999999.99"
            step="0.01"
            value="<?= htmlspecialchars($price, ENT_QUOTES, "UTF-8") ?>"
            required
    >

    <br><br>

    <label for="quantity">Số lượng:</label>
    <input
            type="number"
            id="quantity"
            name="quantity"
            min="0"
            step="1"
            value="<?= htmlspecialchars($quantity, ENT_QUOTES, "UTF-8") ?>"
            required
    >

    <br><br>

    <button type="submit">Thêm sản phẩm</button>
    <a href="product_list.php">Quay lại</a>
</form>

<?php require_once __DIR__ . "/view/footer.php"; ?>