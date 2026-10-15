<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/model/product.php";

$products = getAllProducts();

require_once __DIR__ . "/view/header.php";
?>

<h2>Danh sách sản phẩm</h2>

<p>
    <a href="product_add.php">Thêm sản phẩm</a>
</p>

<?php if (empty($products)): ?>
    <p>Chưa có sản phẩm nào.</p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Chức năng</th>
        </tr>

        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= (int)$product["id"] ?></td>
                <td><?= htmlspecialchars($product["name"], ENT_QUOTES, "UTF-8") ?></td>
                <td><?= number_format((float)$product["price"], 2) ?></td>
                <td><?= (int)$product["quantity"] ?></td>
                <td>
                    <a href="product_edit.php?id=<?= (int)$product["id"] ?>">Sửa</a>
                    |
                    <a href="product_delete.php?id=<?= (int)$product["id"] ?>">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php require_once __DIR__ . "/view/footer.php"; ?>