<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
header('Content-type: text/html; charset=utf8');
session_start();
include("../bd.php");
include("../actions/functions.php");
$status = $_SESSION['status'];
//$id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Управление</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include("template.php"); ?>
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">

        </div>
        <div class="col-sm-8 text-left" style="margin-top: 100px">

            <?php
            //$insert = insert("INSERT INTO Board (table_id, hour, price) VALUES ('$i','$q','$r')");

            $select = select("SELECT * FROM Clubs");
            foreach ($select as $i) {?>
                <div class="col-lg-12"  style="text-align: center; height: 50px;">
                    <a href="dashboard.php?club=<?php echo $i['id'] ?>"><span class="glyphicon glyphicon-hand-right"></span> <?php echo $i['name'] ?></a>
                </div>
            <?php } ?>
        </div>
        <div class="col-sm-2 sidenav">

        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
