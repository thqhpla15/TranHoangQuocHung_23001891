<?php

require_once __DIR__ . "/../common/dbConnect.php";

function getAllProducts() {
    global $conn;

    $sql = "SELECT * FROM products ORDER BY id ASC";
    $result = $conn->query($sql);

    if (!$result) {
        return [];
    }

    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    return $products;
}

function getProductById($id) {
    global $conn;

    if (filter_var($id, FILTER_VALIDATE_INT) === false || (int)$id <= 0) {
        return null;
    }

    $id = (int)$id;
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    $stmt->close();

    return $product ?: null;
}

function addProduct($name, $price, $quantity) {
    global $conn;

    $name = trim($name);

    if ($name === "" || strlen($name) > 100) {
        return false;
    }

    if (!is_numeric($price) || (float)$price <= 0) {
        return false;
    }

    if (filter_var($quantity, FILTER_VALIDATE_INT) === false || (int)$quantity < 0) {
        return false;
    }

    $price = (float)$price;
    $quantity = (int)$quantity;

    $sql = "INSERT INTO products (name, price, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("sdi", $name, $price, $quantity);
    $success = $stmt->execute();

    $stmt->close();

    return $success;
}

function updateProduct($id, $name, $price, $quantity) {
    global $conn;

    if (filter_var($id, FILTER_VALIDATE_INT) === false || (int)$id <= 0) {
        return false;
    }

    $name = trim($name);

    if ($name === "" || strlen($name) > 100) {
        return false;
    }

    if (!is_numeric($price) || (float)$price <= 0) {
        return false;
    }

    if (filter_var($quantity, FILTER_VALIDATE_INT) === false || (int)$quantity < 0) {
        return false;
    }

    $id = (int)$id;
    $price = (float)$price;
    $quantity = (int)$quantity;

    if (!getProductById($id)) {
        return false;
    }

    $sql = "UPDATE products SET name = ?, price = ?, quantity = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("sdii", $name, $price, $quantity, $id);
    $success = $stmt->execute();

    $stmt->close();

    return $success;
}

function deleteProduct($id) {
    global $conn;

    if (filter_var($id, FILTER_VALIDATE_INT) === false || (int)$id <= 0) {
        return false;
    }

    $id = (int)$id;

    if (!getProductById($id)) {
        return false;
    }

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("i", $id);
    $success = $stmt->execute();

    $stmt->close();

    return $success;
}
