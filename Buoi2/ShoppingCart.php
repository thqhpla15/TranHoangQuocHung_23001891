<?php

class ShoppingCart {
    private $items;

    public function __construct() {
        $this->items = [];
    }

    public function addItem($item) {
        if ($item->getPrice() <= 0) {
            echo "Khong the them san pham: price phai lon hon 0.\n";
            return;
        }

        if ($item->getQuantity() <= 0) {
            echo "Khong the them san pham: quantity phai lon hon 0.\n";
            return;
        }

        $this->items[] = $item;
    }

    public function removeItem($name) {
        foreach ($this->items as $key => $item) {
            if ($item->getName() == $name) {
                unset($this->items[$key]);
                echo "Da xoa san pham: " . $name . "\n";
                return;
            }
        }

        echo "Khong tim thay san pham: " . $name . "\n";
    }

    public function calculateTotal() {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }

        return $total;
    }

    public function displayCart() {
        if (empty($this->items)) {
            echo "Gio hang trong.\n";
            return;
        }

        foreach ($this->items as $item) {
            echo "Ten: " . $item->getName() . "\n";
            echo "Don gia: " . $item->getPrice() . "\n";
            echo "So luong: " . $item->getQuantity() . "\n";
            echo "Thanh tien: " . $item->getTotal() . "\n";
            echo "----------------\n";
        }
    }
}