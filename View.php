<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkOfTracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            background-image: url('https://images.pexels.com/photos/5852264/pexels-photo-5852264.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 30px;
            max-width: 600px;
            margin-top: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 16px;
            text-align: center;
        }

        .form-label {
            font-weight: bold;
            color: #0056b3;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
            border-color: #007bff;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        button[type="submit"] {
            width: 48%;
            padding: 12px;
            font-weight: bold;
            border-radius: 8px;
            background-color: #007bff;
            border: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .btn-export {
            width: 48%;
            padding: 12px;
            font-weight: bold;
            border-radius: 8px;
            background-color: #28a745;
            border: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-export:hover {
            background-color: #218838;
        }

        .table-container {
            margin-top: 30px;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            max-width: 800px;
        }

        .table-primary th {
            background-color: #007bff;
            color: #fff;
        }

        @media (max-width: 576px) {
            .container {
                padding: 20px;
                margin-top: 30px;
            }

            h1 {
                font-size: 24px;
            }

            button[type="submit"],
            .btn-export {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <form method="POST">
        <div class="container">
            <h1>Work of Tracker</h1>
            <div class="mb-3">
                <label for="name" class="form-label">Ism</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ismingizni kiriting" required>
            </div>
            <div class="mb-3">
                <label for="arrived_at" class="form-label">Kelgan vaqti</label>
                <input type="datetime-local" class="form-control" id="arrived_at" name="arrived_at" required>
            </div>
            <div class="mb-3">
                <label for="left_at" class="form-label">Ketgan vaqti</label>
                <input type="datetime-local" class="form-control" id="left_at" name="left_at" required>
            </div>
            <div class="button-group">
                <button type="button" class="btn-export">Yuklash</button>
                <button type="submit">Yuborish</button>
            </div>
        </div>
    </form>

    <div class="container table-container">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ismi</th>
                    <th scope="col">Kelgan vaqti</th>
                    <th scope="col">Ketgan vaqti</th>
                    <th scope="col">Qarzdorlik vaqti</th>
                    <th scope="col">Qarzdorlik hisobi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($records)) {
                    foreach ($records as $record) {
                        echo "<tr>
                            <td>{$record['id']}</td>
                            <td>{$record['name']}</td>
                            <td>{$record['arrived_at']}</td>
                            <td>{$record['left_at']}</td>
                            <td>" . gmdate('H:i', $record['required_of']) . "</td>   
                            <td><a href='index.php?done=" . $record['id'] . "'>Done</a></td> 
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container table-container">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ismi</th>
                    <th scope="col">Qarz vaqti</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($monthly)) {
                    $num = 1;
                    foreach ($monthly as $record) {
                        echo "<tr>
                            <td>$num</td>
                            <td>{$record['name']}</td>
                            <td>" . gmdate('H:i', $record['debt']) . "</td>    
                        </tr>";
                        $num++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
