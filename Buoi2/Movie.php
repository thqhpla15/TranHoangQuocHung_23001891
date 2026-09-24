<?php

class Movie {
    private $id;
    private $title;
    private $price;
    private $totalSeats;
    private $availableSeats;

    /**
     * @param $id
     * @param $title
     * @param $price
     * @param $totalSeats
     */
    public function __construct($id, $title, $price, $totalSeats)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->totalSeats = $totalSeats;
        $this->availableSeats = $totalSeats;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getTotalSeats()
    {
        return $this->totalSeats;
    }

    /**
     * @param mixed $totalSeats
     */
    public function setTotalSeats($totalSeats): void
    {
        $this->totalSeats = $totalSeats;
    }

    /**
     * @return mixed
     */
    public function getAvailableSeats()
    {
        return $this->availableSeats;
    }

    /**
     * @param mixed $availableSeats
     */
    public function setAvailableSeats($availableSeats): void
    {
        $this->availableSeats = $availableSeats;
    }

    public function bookTicket($quantity) {
        if ($quantity <= 0) {
            echo "So luong ve phai lon hon 0.\n";
            return;
        }

        if ($quantity > $this->availableSeats) {
            echo "Khong du ghe trong.\n";
            return;
        }

        $this->availableSeats -= $quantity;
        echo "Dat thanh cong " . $quantity . " ve";
    }

    public function getSoldSeats() {
        return $this->totalSeats - $this->availableSeats;
    }

    public function cancelTicket($quantity) {
        if ($quantity <= 0) {
            echo "So luong ve khong hop le.\n";
            return;
        }

        if ($quantity > $this->getSoldSeats()) {
            echo "Khong the huy qua so luong ve da ban";
            return;
        }

        $this->availableSeats += $quantity;
        echo "Huy thanh cong " . $quantity . " ve\n";
    }

    public function getRevenue() {
        return $this->getSoldSeats() * $this->price;
    }

    public function displayInfo() {
        echo "Ma phim: " . $this->id . "\n";
        echo "Ten phim: " . $this->title . "\n";
        echo "Gia ve: " . $this->price . "\n";
        echo "Tong so ghe: " . $this->totalSeats . "\n";
        echo "So ghe con lai: " . $this->availableSeats . "\n";
        echo "So ve da ban: " . $this->getSoldSeats() . "\n";
        echo "Doanh thu: " . $this->getRevenue() . "\n";
    }
}