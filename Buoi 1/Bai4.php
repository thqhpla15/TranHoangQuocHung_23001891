<?php

class Student {
    public $name;
    public $age;
    public $score;

    public function __construct($name, $age, $score) {
        $this->name = $name;
        $this->age = $age;
        $this->score = $score;
    }

    public function getRank() {
        if ($this->score >= 8) {
            return "Gioi";
        }

        if ($this->score >= 6.5) {
            return "Kha";
        }

        if ($this->score >= 5) {
            return "Trung Binh";
        }

        return "Yeu";
    }

    public function isPassed() {
        return $this->score >= 5;
    }

    public function display() {
        return "Ho va ten: " . $this->name
            . ", tuoi: " . $this->age
            . ", diem: " . $this->score
            . ", xep loai: " . $this->getRank();
    }
}

function findBestStudent($students) {
    $bestStudent = $students[0];
    foreach ($students as $student) {
        if ($student->score > $bestStudent->score) {
            $bestStudent = $student;
        }
    }

    return $bestStudent;
}

function countPassedStudents($students) {
    $countPassed = 0;
    foreach ($students as $student) {
        if ($student->isPassed()) {
            $countPassed++;
        }
    }

    return $countPassed;
}

function calculateAverageScore($students) {
    $totalScore = 0;
    foreach ($students as $student) {
        $totalScore += $student->score;
    }

    return $totalScore / count($students);
}

// Main
$student1 = new Student("Nguyen Van An", 20, 8.5);
$student2 = new Student("Tran Thi Binh", 21, 6.5);
$student3 = new Student("Le Van Cuong", 19, 4.5);
$student4 = new Student("Pham Thi Dung", 20, 7.5);

$students = [$student1, $student2, $student3, $student4];


foreach ($students as $student) {
    echo $student->display() . PHP_EOL;
}


$bestStudent = findBestStudent($students);
echo "Sinh vien co diem cao nhat: " . $bestStudent->name
    . ", diem: " . $bestStudent->score . PHP_EOL;

echo "So sinh vien dat: " . countPassedStudents($students) . PHP_EOL;

echo "Diem trung binh cua lop: " . calculateAverageScore($students) . PHP_EOL;