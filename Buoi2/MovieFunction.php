<?php
function findMovieById($movies, $id) {
    foreach ($movies as $movie) {
        if ($movie->getId() == $id) {
            return $movie;
        }
    }

    return null;
}

function getTotalRevenue($movies) {
    $total = 0;

    foreach ($movies as $movie) {
        $total += $movie->getRevenue();
    }

    return $total;
}

function getBestSellingMovie($movies) {
    if (empty($movies)) {
        return null;
    }

    $bestMovie = $movies[0];

    foreach ($movies as $movie) {
        if ($movie->getSoldSeats() > $bestMovie->getSoldSeats()) {
            $bestMovie = $movie;
        }
    }

    return $bestMovie;
}