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

function calculateAverageScore($students) {
    $totalScore = 0;

    foreach ($students as $student) {
        $totalScore += $student["score"];
    }

    return $totalScore / count($students);
}

function getRank($score) {
    if ($score >= 8) return "Gioi";
    if ($score >= 6.5) return "Kha";
    if ($score >= 5) return "Trung Binh";
    return "Yeu";
}

function displayStudent($student) {
    return "Ho va ten: " . $student["name"] . ", tuoi: " . $student["age"] . ", diem: " . $student["score"]
        . ", xep loai: " . getRank($student["score"]) . PHP_EOL;
}

//Main
foreach($students as $student) {
    echo(displayStudent($student));
}

echo "Diem trung binh: " . calculateAverageScore($students);
