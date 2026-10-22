<?php
$prices = [100,200,160,300,250];

function calculateTotal($prices) {
    $total = 0;

    foreach ($prices as $price) {
        $total += $price;
    }

    return $total;
}

function findMaxPrice($prices) {
    $maxprice = $prices[0];

    foreach ($prices as $price) {
        if ($price > $maxprice) {
            $maxprice = $price;
        }
    }

    return $maxprice;
}

echo "Tổng giá trị sản phẩm: " . calculateTotal($prices) . PHP_EOL;
echo "Giá sản phẩm cao nhất: " . findMaxPrice($prices);