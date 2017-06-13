<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
header('Content-type: text/html; charset=utf8');
session_start();
include("../bd.php");
include("../actions/functions.php");
$status = $_SESSION['status'];
$id = $_SESSION['user_id'];
$club_id = $_SESSION['club_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Управление столами</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .col-lg-12.add {
            margin-top: -15px;
        }
    </style>
</head>
<body>
<?php include("template.php"); ?>
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">

        </div>
        <div class="col-sm-8 text-left">
            <div class="panel-title" style="font-size: 16px;text-align: center;margin-top: 15px;"><span>Архив</span></div>
            <input class="form-control" placeholder="Дата" id="dateFilter" style="width: 20%; margin-bottom: 20px">
            <?php if($status == 1){?>
                <select class="form-control clubFilter" style="width: 20%; margin-bottom: 20px" onchange="actions('getBoardClub', this.value)">
                    <option value="">Выберите</option>
                <?php
                $club_select = select("SELECT * FROM Clubs");
                foreach($club_select as $cs){
                    $cs_id = $cs['id'];
                    $cs_name = $cs['name'];
                    echo '<option value="'.$cs_id.'">'.$cs_name.'</option>';
                }
                echo '</select>';
            } ?>
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a data-toggle="tab" href="#home">Черный</a></li>
                <li><a data-toggle="tab" href="#menu1">Белый</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <table class="table table-hover " style="width: 100%">
                        <thead>
                        <tr>
                            <th>№ стола</th>
                            <th>Время заказа</th>
                            <th style="text-align: center">Обратный отсчет</th>
                            <th style="text-align: center">Цена заказа</th>
                            <th width="15%">Дата</th>
                        </tr>
                        </thead>
                        <tbody id="board_1">
                        <?php
                        $query = "";
                        if($status == 1){
                            $query = "SELECT * FROM Archive_B";
                        } else{
                            $query = "SELECT * FROM Archive_B WHERE club_id = '$club_id'";
                        }
                        $board = select($query);
                        if($board != "no data"){
                            foreach ($board as $s) {
                                $b_id = $s['id'];
                                ?>
                                <tr>
                                    <td><?php echo $s['table_id'] ?></td>
                                    <td><?php echo $s['hour'] . " час и ".$s['minute']." минуты" ?></td>
                                    <td style="text-align: center"><?php echo "00:00" ?></td>
                                    <td style="text-align: center"><?php echo $s['price'] ?></td>
                                    <td width="15%"><?php echo $s['time'] ?></td>
                                    <td>Завершен</td>
                                    <td class="inputs"><input class="check" type="checkbox" value="<?php echo $b_id ?>"></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <a href="dashboard.php">
                        <button class="btn btn-default">Назад</button>
                    </a>
                    <button class="btn btn-success" style="float: right" onclick="create('createWhiteBoard')">Отправить выбранные элементы</button>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <table class="table table-hover " style="width: 100%">
                        <thead>
                        <tr>
                            <th>№ стола</th>
                            <th>Время заказа</th>
                            <th style="text-align: center">Обратный отсчет</th>
                            <th style="text-align: center">Цена заказа</th>
                            <th width="15%">Дата</th>
                        </tr>
                        </thead>
                        <tbody id="board_2">
                        <?php
                        $query = "";
                        if($status == 1){
                            $query = "SELECT * FROM Archive_A";
                        } else {
                            $query = "SELECT * FROM Archive_A WHERE club_id = '$club_id'";
                        }
                        $board = select($query);
                        if($board != "no data"){
                            foreach ($board as $s) {
                                $b_id = $s['id'];
                                ?>
                                <tr>
                                    <td><?php echo $s['table_id'] ?></td>
                                    <td><?php echo $s['hour'] . " час и ".$s['minute']." минуты" ?></td>
                                    <td style="text-align: center"><?php echo "00:00" ?></td>
                                    <td style="text-align: center"><?php echo $s['price'] ?></td>
                                    <td width="15%"><?php echo $s['time'] ?></td>
                                    <td>Завершен</td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <a href="dashboard.php">
                        <button class="btn btn-default">Назад</button>
                    </a>
                </div>

            </div>


        </div>
        <div class="col-sm-2 sidenav">

        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>

<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

    $(function () {
        $('#dateFilter').datepicker({
            autoclose: true,
            dateFormat: 'dd-mm-yy',
            language: 'ru',
            todayHighlight: true,
            onSelect: function() {
                var date = $("#dateFilter").val();
                actions('getBoardDate',date);
            }
        });
        $.datepicker.regional['ru'] = {clearStatus: '',
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
                'Июл','Авг','Сен','Окт','Ноя','Дек'],
            dayNames: ['Воскресенье','Понедельник','Вторник','Среда','Четверг','Пятница','Суббота'],
            dayNamesShort: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            firstDay: 1 };
        $.datepicker.setDefaults($.datepicker.regional['ru']);
    });

    function actions(action, val){
        var a = 0;
        if($("#home").hasClass("active")){
            a = 1;
        } else {
            a = 2;
        }
        $.ajax({
            type: "POST",
            url: "../actions/actions.php",
            data: {action:action,val:val,a:a},
            success: function(data){
                switch (action) {
                    case "getBoardDate":
                        if(a == 1){
                            $("#board_1").html(data);
                        } else {
                            $("#board_2").html(data);
                        }
                        break;
                    case "getBoardClub":
                        if(a == 1){
                            $("#board_1").html(data);
                        } else {
                            $("#board_2").html(data);
                        }
                        break;
                }
            }
        });
    }

    function create(action){
        $(".inputs").each(function () {
            var ids = $(this).find("input[class='check']:checked").val();

            $.ajax({
                type: "POST",
                url: "../actions/actions.php",
                data: {action:action, ids:ids},
                success: function(data){
                    switch (action) {
                        case "createWhiteBoard":
                            console.log("copied");
                            break;
                    }
                }
            });
        })
    }

</script>
</body>
</html>
