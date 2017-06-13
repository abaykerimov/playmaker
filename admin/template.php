<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
$id = $_SESSION["user_id"];
if(!$id){
    header("Location: ../login.php");
}
?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Logo</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if(isset($id)){
                $select = select("SELECT * FROM Users WHERE id = '$id'");
                foreach ($select as $i) {?>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $i['fullname'] ?></a></li>
                <?php
                    }
                    echo '<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span></a></li>';
                } ?>
            </ul>
        </div>
    </div>
</nav>