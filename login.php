<!DOCTYPE html>
<html lang="en">
<head>
    <title>Вход</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

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

            <ul class="nav navbar-nav navbar-right">
                <li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Зарегистрироваться</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div id="loginbox" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" style="background: #f9f9f9; border-color: #f9f9f9;">
            <div class="panel-heading" style="background: #f9f9f9; color: #585858; border-color: #f9f9f9;">
                <div class="panel-title" style="font-size: 15px;text-align: center"><span>Вход в личный кабинет</span></div>
            </div>
            <div style="padding-top:30px" class="panel-body">
                <?php echo $msg; ?>
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <form id="loginform" class="form-horizontal" role="form">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="login-username" type="text" class="form-control" name="email"
                               placeholder="Почта" required value="<?php if(isset($_COOKIE['user_login'])) { echo $_COOKIE['user_login']; } ?>">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password"
                               placeholder="Пароль" required value="<?php if(isset($_COOKIE['user_password'])) echo $_COOKIE['user_password']; ?>">
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <div class="checkbox">
                            <label class="col-lg-12 control-label"><input type="checkbox" name="remember" value="1" <?php if(isset($_COOKIE["user_login"])) echo 'checked'; ?>>Запомнить меня</label>
                        </div>
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <input type="hidden" name="type" value="login">
                            <button type="submit" id="btn-login" class="btn btn-success" style="width: 100%">Войти</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/ajaxscript.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
