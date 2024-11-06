<?php

require 'DB.php';

class WorkDay{
    const required_work_hour_daily = 8;

    public $pdo;

    public function __construct(){
        $db = new DB();
        $this->pdo = $db->pdo;
    }

    public function store(string $name, string $arrived_at, string $left_at){
        $arrived_at = new DateTime($arrived_at);
        $left_at = new DateTime($left_at);

        $diff = $arrived_at->diff($left_at);
        $hour = $diff->h;
        $minute = $diff->i;
        $total = ((self::required_work_hour_daily * 3600) - (($hour * 3600) + ($minute * 60)));

        $insertQuery = "INSERT INTO daily(name, arrived_at, left_at, required_of)  
                        VALUES (:name, :arrived_at, :left_at, :required_of)";

        $stmt = $this->pdo->prepare($insertQuery);

        $stmt->bindParam(":name", $name);
        $stmt->bindValue(":arrived_at", $arrived_at->format("Y-m-d H:i"));
        $stmt->bindValue(":left_at", $left_at->format("Y-m-d H:i"));
        $stmt->bindParam(":required_of", $total);
        $stmt->execute();

        header("Location: index.php");
        exit;
    }

    public function getWorkDayList(){
        $selectQuery = "SELECT * FROM daily";
        $stmt = $this->pdo->query($selectQuery);
        return $stmt->fetchAll();
    }
}