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
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
            </div>
            <div class="mb-3">
                <label for="arrived_at" class="form-label">KELGAN VAQTI</label>
                <input type="datetime-local" class="form-control" id="arrived_at" name="arrived_at">
            </div>
            <div class="mb-3">
                <label for="left_at" class="form-label">KETGAN VAQTI</label>
                <input type="datetime-local" class="form-control" id="left_at" name="left_at">
            </div>
            <button class="btn btn-primary" type="submit" value="Submit">YUBORISH</button>
        </div>
    </form>

    <?php
    $dsn = "mysql:host=localhost;dbname=work_of_tracker";
    $pdo = new PDO($dsn, username: "root", password: "root");
    if (isset($_POST["name"]) && isset($_POST["arrived_at"]) && isset($_POST["left_at"])) {
        $name = $_POST["name"];
        $arrived_at = $_POST["arrived_at"];
        $left_at = $_POST["left_at"];

        $insertQuery = "INSERT INTO daily(name, arrived_at, left_at)  VALUES (:name, :arrived_at, :left_at)";

        $stmt = $pdo->prepare($insertQuery);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":arrived_at", $arrived_at);
        $stmt->bindParam(":left_at", $left_at);
        $stmt->execute();
        $select_query = "SELECT * FROM daily";
        $next_stmt = $pdo->query($select_query);
        $records = $next_stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
<div class="container">
    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ISMI</th>
                <th scope="col">KELGAN VAQTI</th>
                <th scope="col">KETGAN VAQTI</th>
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
                    </tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>