<?php

session_start();

if (isset($_SESSION["username"])) {
    header("Location: product_list.php");
} else {
    header("Location: login.php");
}

exit;