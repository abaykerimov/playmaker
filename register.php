<!DOCTYPE html>
<html lang="en">
<head>
    <title>Регистрация</title>
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
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Вход</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">

    <div id="signupbox" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" style="background: #f9f9f9; border-color: #f9f9f9;">
            <div class="panel-heading" style="background: #f9f9f9; color: #585858; border-color: #f9f9f9;">
                <div class="panel-title" style="font-size: 15px;text-align:center"><span>Создать аккаунт</span></div>

            </div>
            <div class="panel-body">
                <form id="signupform" class="form-horizontal" role="form" style="text-align:left;">
                    <div id="signupalert" style="display:none" class="alert alert-danger">
                        <p>Error:</p>
                        <span></span>
                    </div>

                    <div style="margin-bottom: 10px" class="input-group">

                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="email" type="text" class="form-control" name="email" value=""
                               placeholder="Почта" required>
                    </div>

                    <div style="margin-bottom: 10px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="fullname"
                               placeholder="ФИО" required>
                    </div>

                    <div style="margin-bottom: 10px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                        <input id="phone" type="text" class="form-control" name="phone"
                               placeholder="Телефон" required>
                    </div>

                    <div style="margin-bottom: 10px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" name="passwd"
                               placeholder="Введите пароль" pattern=".{5,100}" required title="Пароль должен состоять как минимум из 5 символов">
                    </div>

                    <div style="margin-bottom: 10px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" name="confpasswd"
                               placeholder="Подтвердите пароль" required>
                    </div>

                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <input type="hidden" name="type" value="register">
                            <button id="btn-signup" type="submit" class="btn btn-info" style="width: 100%"><i
                                    class="glyphicon glyphicon-hand-right"></i> &nbsp;Зарегистрироваться
                            </button>
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
<script src="/js/bootstrap.min.js"></script>
<script src="js/jquery.maskedinput.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#phone").mask("+7 (999) 999-99-99");
    });
</script>

</body>
</html>
