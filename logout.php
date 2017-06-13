<?php
/*$wedding = strtotime("2017-05-21 16:00:00"); // or whenever the wedding is
$current=strtotime('now');
$diffference =$wedding-$current;
echo $diffference."<br>";
$hour=floor($diffference / (60*60));
$minute = floor($diffference / (60))-$hour*60;
$diffference = $diffference%60;
$second = $diffference;
echo "$hour hours and $minute minutes and $second seconds left";*/

session_start();
//Include FB config file
//Unset user data from session
unset($_SESSION['user_id']);

//Destroy session data

//Redirect to homepage
header("Location:login.php");
?>