<?php
require_once "CartItem.php";
require_once "ShoppingCart.php";

$cart = new ShoppingCart();

$item1 = new CartItem("Apple", 10000, 3);
$item2 = new CartItem("Milk", 15000, 2);
$item3 = new CartItem("Bread", 20000, 1);
$item4 = new CartItem("Egg", 3000, 10);

$cart->addItem($item1);
$cart->addItem($item2);
$cart->addItem($item3);
$cart->addItem($item4);

echo "Gio hang ban dau: \n";
$cart->displayCart();

echo "\nTong tien: " . $cart->calculateTotal() . "\n";

echo "\nXoa san pham ten 'MILK': \n";
$cart->removeItem("Milk");

echo "\nCap nhat gio hang: \n";
$cart->displayCart();