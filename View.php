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

        .btn-submit {
            width: 48%;
            padding: 12px;
            font-weight: bold;
            border-radius: 8px;
            background-color: #007bff;
            border: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
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

            .btn-submit,
            .btn-export {
                padding: 10px;
            }
        }

        /* Pagination umumiy stil */
        .pagination {
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Tugmalar uchun ranglar */
        .custom-link {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 50%;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .custom-link:hover {
            background-color: #0056b3;
            color: #fff;
        }

        /* Faol (active) tugma */
        .pagination .active .page-link {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        /* Previous va Next tugmalari */
        .custom-link-prev {
            background-color: #ff7f50;
            color: #fff;
            border-radius: 20px;
        }

        .custom-link-next {
            background-color: #20b2aa;
            color: #fff;
            border-radius: 20px;
        }

        .custom-link-prev:hover {
            background-color: #ff6347;
        }

        .custom-link-next:hover {
            background-color: #2e8b57;
        }
    </style>
</head>

<body>
    <form method="POST" action="index.php">
        <div class="container">
            <h1>Work of Tracker</h1>
            <div class="mb-3">
                <label for="name" class="form-label">Ism</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ismingizni kiriting"
                    required>
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
                <button type="submit" class="btn-export btn-success" form="export">Yuklash</button>
                <button type="submit" class="btn-submit btn-primary">Yuborish</button>
            </div>

        </div>
    </form>

    <form action="Download.php" id="export" method="post">
        <input type="text" name="export" value="true" hidden>
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
                $records = $records ?? [];
                $i = 0;
                foreach ($records as $record) {
                    $i++;
                    echo "<tr>
                        <td>$i</td>
                        <td>{$record['name']}</td>
                        <td>{$record['arrived_at']}</td>
                        <td>{$record['left_at']}</td>
                        <td>" . gmdate('H:i', $record['required_of']) . "</td>
                        <td><a href='index.php?done=" . $record['id'] . "'>Done</a></td>
                    </tr>";
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

                global $records;
                $i = isset($_GET['page']) ? (int) $_GET['page'] : 0;
                $monthly = $monthly ?? [];
                $num = 1;
                foreach ($monthly as $record) {
                    $i++;
                    echo "<tr>
                        <td>$num</td>
                        <td>{$record['name']}</td>
                        <td>" . gmdate('H:i', $record['debt']) . "</td>
                    </tr>";
                    $num++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container" mt="4">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php
                global $workDay, $currentPage;
                $disabled = $currentPage == 1 ? "disabled" : "";

                ?>
                <li class="page-item <?= $disabled ?>"><a class="page-link" href="#">Previous</a></li>
                <?php
                $pageCount = $workDay->calculatePageCount();
                for ($page = 1; $page <= $pageCount; $page++) {
                    $active = $page == $currentPage ? "active" : "";
                    echo "<li class='page-item $active''><a class='page-link'' href='index.php?page=" . $page . "''>" . $page . "</a></li>";
                }

                ?>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>




</body>

</html>