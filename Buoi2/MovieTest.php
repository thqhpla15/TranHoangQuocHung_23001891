<?php
require_once "Movie.php";
require_once "MovieFunction.php";

$movies = [
    new Movie(1, "Avengers", 100000, 100),
    new Movie(2, "Avatar", 120000, 80),
    new Movie(3, "Batman", 90000, 120)];

$avengers = findMovieById($movies, 1);
$avatar = findMovieById($movies, 2);

$avengers->bookTicket(30);
$avatar->bookTicket(50);

$avengers->cancelTicket(10);

echo "\n===== THONG TIN CAC PHIM =====\n";

foreach ($movies as $movie) {
    $movie->displayInfo();
    echo "-------------------------\n";
}

echo "Tong doanh thu: " . getTotalRevenue($movies) . "\n";

$bestMovie = getBestSellingMovie($movies);

if ($bestMovie != null) {
    echo "Phim ban nhieu nhat: " . $bestMovie->getTitle() . "\n";
    echo "So ve da ban: " . $bestMovie->getSoldSeats() . "\n";
}