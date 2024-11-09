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
        $selectQuery = "SELECT * FROM daily ORDER BY arrived_at DESC";
        $stmt = $this->pdo->query($selectQuery);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateDebtTime(){
        $selectQuery = " select  name, sum(required_of) as 'debt' from daily group by name;";
        $stmt = $this->pdo->query($selectQuery);
        return $stmt->fetchAll();
    }

    public function markAsDone(int $id){
        $query = "UPDATE daily SET required_of=0 WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: index.php");
        exit;
    }

    public function getWorkDayListWithPagination(int $offset){
        $offset = $offset ? ($offset * 10) - 10 :0;
        $query = "SELECT * FROM daily ORDER BY arrived_at DESC LIMIT 10 OFFSET ". $offset."";
        $query= $this->pdo->prepare($query);
        // $query= $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalRecords(){
        $query = "SELECT COUNT(id) as pageCount FROM daily";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll( PDO::FETCH_ASSOC);
    }

    public function calculatePageCount(){
        $total = $this->getTotalRecords()[0]['pageCount'];
        return ceil($total / 10);
    }
}