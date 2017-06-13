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
if($status == 1){
    $club_id = $_GET['club'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Управление столами</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
            <div class="panel-title" style="font-size: 16px;text-align: center;margin-top: 15px;"><span>Контроль по учету времени</span>
            </div>
            <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Добавить</button>
            <table class="table table-hover " style="width: 100%">
                <thead>
                <tr>
                    <th>№ стола</th>
                    <th>Время заказа</th>
                    <th>Обратный отсчет</th>
                    <th>Цена заказа</th>
                    <th width="15%">Дата</th>
                </tr>
                </thead>
                <tbody id="board">
                <?php
                $board = select("SELECT * FROM Board WHERE club_id = '$club_id'");
                if($board != "no data"){
                    foreach ($board as $s) {
                        $finish = strtotime($s['finish_time']);
                        $start = strtotime("now");
                        $count = $finish - $start;
                        $hours = floor($count / (60 * 60));
                        $minutes = floor($count / (60)) - ($hours * 60);
                        $count = $count % 60;
                        $seconds = $count;
                        $b_id = $s['id'];
                        if ($start <= $finish) {
                            ?>
                            <tr>
                                <td><?php echo $s['table_id'] ?></td>
                                <td><?php echo $s['hour'] . " час и ".$s['minute']." минуты" ?></td>
                                <td style="text-align: center;"><?php echo $hours . ":" . $minutes ?></td>
                                <td style="text-align: center"><?php echo $s['price'] ?></td>
                                <td width="15%"><?php echo $s['time'] ?></td>
                                <td>
                                    <button class="btn btn-default" style="margin-right: 15px" data-toggle="modal" data-target="#myModal2" onclick="actions('getBoard', <?php echo $b_id ?>)">Продлить</button>
                                    <button class="btn btn-danger" onclick="
                                        if (confirm('Вы хотите завершить?')){
                                        actions('endBoard', <?php echo $b_id ?>)}">Завершить</button>
                                </td>
                            </tr>
                            <?php
                        } else {
                            $insert = insert("INSERT INTO Archive_B SELECT * FROM Board WHERE id = '$b_id' AND id NOT IN (SELECT id FROM Archive_B)");
                            if($insert){
                                $delete = delete("DELETE FROM Board WHERE id = ?", $b_id);
                            }
                        }
                    }
                }
                ?>
                </tbody>
            </table>
            <a href="report.php">
                <button class="btn btn-warning">Архив</button>
            </a>
        </div>
        <div class="col-sm-2 sidenav">

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Добавление</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" data-toggle="validator" id="form">
                    <fieldset>

                        <div class="form-group">
                            <label for="inputTime" class="col-lg-4 control-label">Выбрать стол:</label>

                            <div class="col-lg-4">
                                <select class="form-control select_table" required>
                                    <option value="">Выберите</option>
                                    <?php
                                    $table = select("SELECT * FROM Tables WHERE id NOT IN (SELECT table_id FROM Board WHERE id = '$club_id')");
                                    foreach ($table as $t) {
                                    ?>
                                    <option value="<?php echo $t['id'] ?>"><?php echo $t['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputClient" class="col-lg-4 control-label">Выбрать время:</label>

                            <div class="col-lg-2">
                                <select class="form-control hour" required>
                                    <option value="">Выберите</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input class="form-control minute" type="number" min="1" placeholder="00">
                            </div>
                            <div class="col-lg-2">
                                <input class="check" type="checkbox" value="0">Подарок
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPhone" class="col-lg-4 control-label">Цена:</label>

                            <div class="col-lg-4">
                                <p class="get price">400</p>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <div class="form-group text-center">
                    <div class="col-lg-12 add">
                        <button class="btn btn-success" onclick="actions('addBoard')">Добавить</button>
                        <button type="button" class="btn btn-default closebtn" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Продление</h4>
            </div>
            <div class="modal-body getBoard">

            </div>
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    setInterval(function () {
       $("#board").load("../actions/board.php");
    }, 60000);

    $(".check").click(function () {
        var a = 0;

        if($(".check").val() == 0){
            $(".check").val(1);
            a = parseInt($(".price").text())+100;
        } else {
            $(".check").val(0);
            a = parseInt($(".price").text())-100;
        }
        $(".price").html(a);
    });

    function calcPrice(hour, minute, selector){
        var priceHour = 400;
        var price = 0;
        var calcMinute = 0;
        var calcHour = 0;
        if($(hour).val() == 0 && $(minute).val() == ''){
            $(selector).text(0);
        }
        $(hour).change(function() {
            if($(minute).val() == ''){
                calcHour = parseFloat($(hour).val())*priceHour;
                $(selector).html(calcHour);
                if($(".check").val() == 1){
                    $(selector).html(calcHour+100);
                }
            }
            if($(minute).val() != ''){
                calcHour = parseFloat($(hour).val())*priceHour;
                //console.log("hour1: "+ calcHour);
                calcMinute = (parseFloat($(minute).val()/60)*priceHour).toFixed(2);
                //console.log("min1: "+ calcMinute);
                price = parseInt(calcHour) + parseInt(calcMinute);
                //console.log("price1: "+ price);
                $(selector).html(price);
                if($(".check").val() == 1){
                    $(selector).html(calcHour+100);
                }
            }
            return price;
        });
        $(minute).keyup(function() {
            if($(hour).val() == ''){
                calcMinute = (parseFloat($(minute).val()/60)*priceHour).toFixed(2);
                $(selector).html(calcMinute);

            }
            else if($(hour).val() != ''){
                calcMinute = (parseFloat($(minute).val()/60)*priceHour).toFixed(2);
                //console.log("min2: "+ calcMinute);
                calcHour = parseFloat($(hour).val())*priceHour;
                //console.log("hour2: "+ calcHour);
                price = parseInt(calcHour) + parseInt(calcMinute);
                //console.log("price2: "+ price);
                $(selector).html(price);
            }
            return price;
        });

    }

    calcPrice(".hour", ".minute", ".price");

    /*$(".hour").keyup(function() {
        var price = 400;
        var calc = $(".price").html((parseFloat($(".hour").val())*price));
        if($(".hour").val() == 0){
            $(".price").text(0);
        }
    });

    $(".minute").keyup(function() {
        var price = 400;
        var calc = $(".price").html((parseFloat($(".minute").val()/60)*price).toFixed(2));
        if($(".minute").val() == 0){
            $(".price").text(0);
        }
    });*/

    function actions(action, val){
        var table = $(".select_table").val();
        var hour = $(".hour").val();
        var minute = $(".minute").val();
        var price = $(".price").text();

        var get_hour = $(".get_hour").val();
        var get_minute = $(".get_minute").val();
        var get_table = $(".get_table").val();
        var get_price = $(".get_price").text();
        if($(".check").val() == 1){
            hour = parseInt(hour)+1;
        }
        $.ajax({
            type: "POST",
            url: "../actions/actions.php",
            data: {action:action,val:val,table:table,hour:hour,minute:minute,price:price,
                get_hour:get_hour,get_minute:get_minute,get_table:get_table,get_price:get_price},
            success: function(data){
                switch (action) {
                    case "addBoard":
                        alert(data);
                        $(".closebtn").click();
                        $("#board").load("../actions/board.php");
                        break;
                    case "getBoard":
                        $(".getBoard").html(data);
                        calcPrice(".get_hour", ".get_minute", ".get_price");
                        break;
                    case "editBoard":
                        alert(data);
                        $(".closebtn").click();
                        $("#board").load("../actions/board.php");
                        break;
                    case "endBoard":
                        alert(data);
                        $("#board").load("../actions/board.php");
                        break;
                }

            }
        });
    }
</script>
</body>
</html>
