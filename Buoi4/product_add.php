<?php

require_once "model/product.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $errors = [];

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
        addProduct($name, $price, $quantity);
        header("Location: product_list.php");
        exit;
    }
}

require_once "view/header.php";
?>

    <h2>Thêm sản phẩm</h2>
<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

    <form method="POST">
        <label>Tên sản phẩm:</label>
        <input type="text" name="name">

        <br><br>

        <label>Giá:</label>
        <input type="number" name="price">

        <br><br>

        <label>Số lượng:</label>
        <input type="number" name="quantity">

        <br><br>

        <button type="submit">Thêm sản phẩm</button>
    </form>

<?php
require_once "view/footer.php";
?>