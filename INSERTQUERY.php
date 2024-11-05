<?php

class INSERTQUERY{
    public $insertQuery;
    public function __construct(){
        $this->insertQuery = "INSERT INTO daily(name, arrived_at, left_at, required_of)  
                        VALUES (:name, :arrived_at, :left_at, :required_of)";
    }
}