<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method = "GET">
        <input type = "datetime-local" name = "arrived_at"><br><br>
        <input type = "datetime-local" name = "left_at>
        <button> Y U B O R I SH</button>
</form>

<?php
    define("WORK_TIME", 8);
    if (isset($_GET['arrived_at']) and isset($_GET['left_at'])){
        $arrived_at = new DateTime($_GET['arrived_at']);
        $left_at = new DateTime($_GET['left_at']);
        $diff = $arrived_at->diff($left_at);

        echo "
        <h1>Arrived Time:   ". $_GET['arrived_at'] . "</h1>
        <h1>Left Time:   ". $_GET['left_at'] ."</h1>
        <h1>Work Time:   ". WORK_TIME ."</h1>
        <h1>Difference Hour:   $diff->h</h1>
        <h1>Difference Min:    $diff->i</h1>
        ";
    }

    $pdo = new PDO('mysql:host=localhost;dbname=work_of_traker', 'root', '1234');

    $quary = "INSERT INTO work_times(kelgan_vaqt, ketgan_vaqt) VALUES (:kelgan, :ketgan)";

    $stmt = $pdo->prepare($quary);

    $stmt->bindParam(':kelgan', $arrived);
    $stmt->bindParam(':ketgan', $leaved);

    $stmt->execute();
?>

</body>
</html>