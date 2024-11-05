<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkOfTracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <form method="POST">
        <div class="container text-center text-primary">
            <h1>Work of tracker</h1>
        </div>
        <div class="container">
            <div class="mb-3">
                <label for="name" class="form-label">ISM</label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" required>
            </div>
            <div class="mb-3">
                <label for="arrived_at" class="form-label">KELGAN VAQTI</label>
                <input type="datetime-local" class="form-control" id="arrived_at" name="arrived_at" required>
            </div>
            <div class="mb-3">
                <label for="left_at" class="form-label">KETGAN VAQTI</label>
                <input type="datetime-local" class="form-control" id="left_at" name="left_at" required>
            </div>
            <button class="btn btn-primary" type="submit" value="Submit">YUBORISH</button>
        </div>
    </form>

    <?php


    require 'DB.php';

    $db = new DB();

    $pdo = $db->pdo;

    
    const required_work_hour_daily = 8;

    if (isset($_POST["name"]) && isset($_POST["arrived_at"]) && isset($_POST["left_at"])) {

        if (!empty($_POST['name']) && !empty($_POST['arrived_at']) && !empty($_POST['left_at'])) {

            $name = $_POST["name"];
            $arrived_at = new DateTime($_POST["arrived_at"]);
            $left_at = new DateTime($_POST["left_at"]);

            $diff = $arrived_at->diff($left_at);
            $hour = $diff->h;
            $minute = $diff->i;
            $second = $diff->s;
            $total = ((required_work_hour_daily * 3600) - (($hour * 3600) + ($minute * 60)));
            
            require 'INSERTQUERY.php';

            $iq = new INSERTQUERY();

            $insertQuery = $iq->insertQuery;

            $stmt = $pdo->prepare($insertQuery);

            $stmt->bindParam(":name", $name);
            $stmt->bindValue(":arrived_at", $arrived_at->format("Y-m-d H:i"));
            $stmt->bindValue(":left_at", $left_at->format("Y-m-d H:i"));
            $stmt->bindParam(":required_of", $total);
            $stmt->execute();

            header("Location: index.php");
            exit;
        }
    }

    require 'SELECTQUERY.php';

    $sq = new   SELECTQUERY();

    $selectQuery = $sq->selectQuery;

    $next_stmt = $pdo->query($selectQuery);
    $records = $next_stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container mt-4">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ISMI</th>
                    <th scope="col">KELGAN VAQTI</th>
                    <th scope="col">KETGAN VAQTI</th>
                    <th scope="col">QARZDORLIK VAQTI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($records))
                    return;
                foreach ($records as $record) {
                    echo "<tr>
                        <td>{$record['id']}</td>
                        <td>{$record['name']}</td>
                        <td>{$record['arrived_at']}</td>
                        <td>{$record['left_at']}</td>
                        <td>" . gmdate('H:i', $record['required_of']) . "</td>     
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>