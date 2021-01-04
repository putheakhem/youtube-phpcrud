<?php
$name = $salary= $address = "";
if(isset($_GET["id"])) {

    $servername = "localhost";
    $dbname = "crudphp";
    $password = "";
    $username = "root";
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $sql = "SELECT * FROM employees WHERE id = :id";

        $result = $pdo->prepare($sql);

        $result->bindParam(":id", $param_id);

        $param_id = $_GET["id"];

        if($result->execute()) {
            if($result->rowCount() == 1) {
                $employee = $result->fetch(PDO::FETCH_ASSOC);
                $name = $employee["name"];
                $address = $employee["address"];
                $salary = $employee["salary"];
            } else {
                header("location: index.php");
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show </title>
</head>
<body>
    <div class="container">
       <p>Name : <?php echo $name ?></p>
       <p>Salary : <?php echo $salary ?></p>
       <p>Address : <?php echo $address ?></p>
    </div>
</body>
</html>