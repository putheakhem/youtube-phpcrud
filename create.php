<?php

$name = $address = $salary = "";
$e_name = $e_address = $e_salary = "";

$servername = "localhost";
$dbname = "crudphp";
$password ="";
$username = "root";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(! empty($_POST["name"])) {
        $name = $_POST["name"];
    } else {
        $e_name = "Please enter your name";
    }

    if(! empty($_POST["address"])) {
        $address = $_POST["address"];
    } else {
        $e_address = "Please enter your address";
    }

    if(! empty($_POST["salary"])) {
        $salary = $_POST["salary"];
    } else {
        $e_salary = "Please enter your salary";
    }


    if(empty($e_name) && empty($e_salary) && empty($e_address)) {

        try  {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $sql = "INSERT INTO employees (name, address, salary) VALUES (:name, :address, :salary)";

            $smtsql = $pdo->prepare($sql);

            $smtsql->bindParam(":name", $param_name);
            $smtsql->bindParam(":address", $param_address);
            $smtsql->bindParam(":salary", $param_salary);

            $param_name = $name;
            $param_address =  $address;
            $param_salary = $salary;

            $smtsql->execute();


        } catch (PDOException $e) {

            echo $e->getMessage();

        }

        $name = $address = $salary = "";
    }

}
unset($pdo);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new employee</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <h1 class="">Create New Employee</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> ">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>">
                <span class="is-invalid"><?php echo $e_name; ?></span>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                <span id="address" class="is-invalid"> <?php echo $e_address; ?></span>
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $salary; ?>">
                <span class="is-invalid"> <?php echo $e_salary; ?></span>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>

