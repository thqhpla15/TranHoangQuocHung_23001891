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

function findBestStudent($students) {
    $bestStudent = $students[0];
    foreach ($students as $student) {
        if ($student["score"] > $bestStudent["score"]) {
            $bestStudent = $student;
        }
    }

    return $bestStudent;
}

function findWorseStudent($students) {
    $worstStudent = $students[0];
    foreach ($students as $student) {
        if ($student["score"] < $worstStudent["score"]) {
            $worstStudent = $student;
        }
    }

    return $worstStudent;
}

function countPassedStudents($students) {
    $countPassed = 0;
    foreach($students as $student) {
        if ($student["score"] >=5 ) {
            $countPassed++;
        }
    }

    return $countPassed;
}

function findStudentByName($students, $name) {
    foreach($students as $student) {
        if (str_contains($student["name"], $name)) {
            return $student;
        }
    }

    return null;
}

//Main
$bestStudent = findBestStudent($students);
echo "Hoc sinh co diem cao nhat: " . $bestStudent["name"]
    . ", diem: " . $bestStudent["score"] . PHP_EOL;

$worstStudent = findWorseStudent($students);
echo "Hoc sinh co diem thap nhat: " . $worstStudent["name"]
    . ", diem: " . $worstStudent["score"] . PHP_EOL;

$countPassed = countPassedStudents($students);
echo "So sinh vien dat: " . $countPassed . PHP_EOL;

$targetStudent = findStudentByName($students, "An");
echo "Tim hoc sinh ten An: " . $targetStudent["name"];