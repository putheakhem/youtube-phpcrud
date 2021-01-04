<?php
    if(isset($_POST["id"]) && !empty($_POST["id"]))  {

    $servername = "localhost";
    $dbname = "crudphp";
    $password = "";
    $username = "root";
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $sql = "DELETE FROM employees WHERE id = :id";
        $stmsql = $pdo->prepare($sql);

        $stmsql->bindParam(":id", $param_id);
        $param_id = $_POST["id"];
        if($stmsql->execute()) {
            header("location: index.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>CRUD-Delete</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
    <p> Are you sure want to delete this employee</p>
    <input type="submit" value="Yes" class="btn btn-danger">
    <a href="index.php" class="btn btn-info">Cancel</a>
</form>

</body>
</html>