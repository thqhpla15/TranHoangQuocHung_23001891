<?php

require_once "model/product.php";

$id = $_GET["id"] ?? null;
$product = getProductById($id);

if (!$product) {
    die("Sản phẩm không tồn tại.");
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    if ($name === "") {
        $errors[] = "Tên sản phẩm không được rỗng.";
    }

    if ($price <= 0) {
        $errors[] = "Giá phải lớn hơn 0.";
    }

    if ($quantity < 0) {
        $errors[] = "Số lượng phải lớn hơn hoặc bằng 0.";
    }

    if (empty($errors)) {
        updateProduct($id, $name, $price, $quantity);
        header("Location: product_list.php");
        exit;
    }

    $product["name"] = $name;
    $product["price"] = $price;
    $product["quantity"] = $quantity;
}

require_once "view/header.php";
?>

    <h2>Sửa sản phẩm</h2>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

    <form method="POST">
        <label>Tên sản phẩm:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>">

        <br><br>

        <label>Giá:</label>
        <input type="number" name="price" value="<?= $product['price'] ?>">

        <br><br>

        <label>Số lượng:</label>
        <input type="number" name="quantity" value="<?= $product['quantity'] ?>">

        <br><br>

        <button type="submit">Cập nhật</button>
    </form>

<?php
require_once "view/footer.php";
?>