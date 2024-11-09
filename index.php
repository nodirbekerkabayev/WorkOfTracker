<?php

require 'WorkDay.php';
$workDay = new WorkDay();

if (isset($_POST["name"]) && isset($_POST["arrived_at"]) && isset($_POST["left_at"])) {

    if (!empty($_POST['name']) && !empty($_POST['arrived_at']) && !empty($_POST['left_at'])) {

        $workDay->store(($_POST['name']), ($_POST['arrived_at']), ($_POST['left_at']));
    }
}

$currentPage = isset($_GET['page'])  ? $_GET['page'] : 0;
$records = $workDay->getWorkDayListWithPagination($currentPage);

print_r ($workDay->getTotalRecords()[0]['pageCount']);

$records = $workDay->getWorkDayList();
$monthly = $workDay->calculateDebtTime();

if (isset($_GET['done']) and !empty($_GET['done'])){
    $workDay->markAsDone($_GET['done']);
}

require 'View.php';