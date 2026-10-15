<?php

require_once __DIR__ . "/common/dbConnect.php";

function getUserByUsername($username) {
    global $conn;

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();

    return $user ?: null;
}

function registerUser($username, $password) {
    global $conn;

    $username = trim($username);

    if ($username === "" || strlen($username) > 50 || $password === "") {
        return false;
    }

    if (getUserByUsername($username)) {
        return false;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("ss", $username, $hashedPassword);
    $success = $stmt->execute();

    $stmt->close();

    return $success;
}