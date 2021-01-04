

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>CRUD PHP</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>All Employees</h1>


                <?php
                $servername = "localhost";
                $dbname = "crudphp";
                $password ="";
                $username = "root";
                try {
                    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $sql = "SELECT * FROM employees";

                    $employees = $pdo->query($sql);

                    if($employees->rowCount() > 0) {
                        echo "<table class='table'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th> ID </th>";
                        echo "<th> Name </th>";
                        echo "<th> Address</th>";
                        echo "<th> Salary</th>";
                        echo "<th> Action </th>";
                        echo "</tr>";

                        echo "<tbody>";
                        while($employee = $employees->fetch()) {
                            echo "<tr>";
                            echo "<td>" . $employee["id"] ."</td>";
                            echo "<td>" . $employee["name"] ."</td>";
                            echo "<td>" . $employee["address"] ."</td>";
                            echo "<td>" . $employee["salary"] ."</td>";
                            echo "<td>";
                            echo  "<a class='btn btn-info' href='show.php?id=" . $employee["id"] . "'>Show</a>";
                            echo  "<a class='btn btn-warning' href='update.php?id=" . $employee["id"] . "'>Edit</a>";
                            echo  "<a class='btn btn-danger' href='delete.php?id=" . $employee["id"] . "'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";

                        }
                        echo "</tbody>";

                        echo "</thead>";

                        echo "</table>";
                    }

                } catch (PDOException $e){
                    echo $e->getMessage();
                }

                ?>


            </div>
        </div>
    </div>
</body>
</html>