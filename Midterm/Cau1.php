<?php

$name = "Trần Hoàng Quốc Hưng";
$score = 8.5;

if ($score >= 8) {
    $rank = "Giỏi";
} elseif ($score >= 6.5) {
    $rank = "Khá";
} elseif ($score >= 5) {
    $rank = "Trung Bình";
} else {
    $rank = "Yếu";
}

echo "Tên học sinh: " . $name . PHP_EOL;
echo "Điểm: " . $score . PHP_EOL;
echo "Xếp loại: " . $rank;
?>
