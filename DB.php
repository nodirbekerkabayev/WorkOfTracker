<?php

class DB{
    public $pdo;
    public function __construct(){
        $dsn = 'mysql:host=localhost;dbname=work_of_tracker';
        $this->pdo = new PDO($dsn,'root','root');
        
    }
}