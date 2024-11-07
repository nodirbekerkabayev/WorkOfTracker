<?php

require 'WorkDay.php';
$workday = new WorkDay();

if (isset($_POST["name"]) && isset($_POST["arrived_at"]) && isset($_POST["left_at"])) {

    if (!empty($_POST['name']) && !empty($_POST['arrived_at']) && !empty($_POST['left_at'])) {

        $workday->store(($_POST['name']), ($_POST['arrived_at']), ($_POST['left_at']));
    }
}

$records = $workday->getWorkDayList();
$monthly = $workday->calculateDebtTime();

if (isset($_GET['done']) and !empty($_GET['done'])){
    $workday->markAsDone($_GET['done']);
}

require 'View.php';