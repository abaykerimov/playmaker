<?php
header('Content-type: text/html; charset=utf8');
include("bd.php");
include("actions/filter.php");
$error = "";
$msg = "";
error_reporting(0);
$check = 0;
$type = filter('type');
$passwd = filter('passwd');
$email = $_POST['email'];
$phone = filter('phone');
$fullname = filter("fullname");

if (isset($_POST) && isset($type)) {

    if ($type == "login" && isset($_POST['email'], $_POST['password'])) {
        $p = md5(md5($_POST['password'] . md5(sha1($_POST['password']))));
        $query = $conn->query("SELECT * FROM Users WHERE email = '$email' AND password = '$p'");

        if ($query->num_rows == 1) {
            if($row = $query->fetch_assoc()){
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['status'] = $row['status'];
                $_SESSION['club_id'] = $row['club_id'];

                if(!empty($_POST["remember"])) {
                    setcookie ("user_login",$_POST["email"],time()+ (10 * 365 * 24 * 60 * 60));
                    setcookie ("user_password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
                } else {
                    if(isset($_COOKIE["user_login"])) {
                        setcookie ("user_login","");
                    }
                    if(isset($_COOKIE["user_password"])) {
                        setcookie ("user_password","");
                    }
                }
            }

            echo '{"error":0,"redir":"okk"}';
        } else {
            echo '{"error":1,"message":"Неправильные данные."}';
        }

    } else if ($type == "register" && isset($_POST['email'], $_POST['fullname'], $_POST['passwd'], $_POST['confpasswd'])) {

        $password = md5(md5($passwd . md5(sha1($passwd))));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            echo '{"error":1,"message":"Введите валидную почту","focus":"email"}';

        } else {
            $query = $conn->query("SELECT id FROM Users WHERE email = '$email' OR phone = '$phone'");
            if ($query->num_rows > 0) {

                echo '{"error":2,"message":"Пользователь с такой почтой или телефоном уже существует."}';

            } else if ($passwd != $_POST['confpasswd']) {

                echo '{"error":1,"message":"Пароли не совпадают","focus":"confpasswd"}';

            } else {
				$query = $conn->query("set names utf8");
                $query = $conn->query("INSERT INTO Users (fullname, email,phone,password,created,status) VALUES('$fullname','$email','$phone','$password',NOW(),3)") or die($conn->error);
                echo '{"error":0,"message":"Пароль выслан на почту, спасибо.<br> <a href=\"login.php\">Нажмите</a>, чтобы войти","redir":"none"}';
                $check = 1;
            }
        }
    }
}

?>