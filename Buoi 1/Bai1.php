<?php

$students = [
    [
        "name" => "Nguyen Van An",
        "age" => 20,
        "score" => 8.5
    ],
    [
        "name" => "Tran Thi Binh",
        "age" => 21,
        "score" => 6.5
    ],
    [
        "name" => "Le Van Cuong",
        "age" => 19,
        "score" => 4.5
    ],
    [
        "name" => "Pham Thi Dung",
        "age" => 20,
        "score" => 7.5
    ]
];

foreach ($students as $student) {
    echo "Ho va ten: " . $student["name"] . ", tuoi: " . $student["age"] . ", diem: " . $student["score"] . PHP_EOL;
}

$totalScore = 0;
foreach ($students as $student) {
    $totalScore += $student["score"];
}
echo "Diem trung binh cua tat ca sinh vien: " . $totalScore / count($students);