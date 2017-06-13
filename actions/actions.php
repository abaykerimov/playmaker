<?php
header('Content-type: text/html; charset=utf8');
session_start();
$status = $_SESSION['status'];
include("bd.php");
include("filter.php");
include("functions.php");
$id = $_SESSION["user_id"];
$club_id = $_SESSION["club_id"];
$action = filter("action");
if (!empty($action)) {
    switch ($action) {
        case "addBoard":
            $table = filter("table");
            $hour = filter("hour");
            $minute = filter("minute");
            if($minute == ""){
                $minute = "00";
            }
            $time = $hour.":".$minute;
            $price = filter("price");
            $second = $hour*3600;
            $insert = insert("INSERT INTO Board (table_id, hour, minute, price, date, time, finish_time, datetime, club_id) VALUES ('$table','$hour','$minute','$price', NOW(), NOW(), DATE_ADD(NOW(), INTERVAL '$time' HOUR_MINUTE),NOW(),'$club_id')");
            if($insert){
                echo "added";
            }
            break;

        case "getBoard":
            $board_id = filter("val");
            $select = select("SELECT * FROM Board WHERE id = '$board_id'");
            foreach($select as $s){
                ?>
                <form class="form-horizontal" data-toggle="validator" id="form">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputTime" class="col-lg-4 control-label">Поменять стол:</label>

                            <div class="col-lg-4">
                                <select class="form-control select_table get_table" required>
                                    <option value="">Выберите</option>
                                    <?php
                                    $table = select("SELECT * FROM Tables WHERE id NOT IN (SELECT table_id FROM Board WHERE id = '$club_id')");
                                    foreach ($table as $t) {
                                        ?>
                                        <option value="<?php echo $t['id'] ?>" <?php if($t['id'] == $s['table_id']) echo 'selected' ?>><?php echo $t['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputClient" class="col-lg-4 control-label">Продлить на:</label>

                            <div class="col-lg-2">
                                <select class="form-control get_hour" required>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input class="form-control get_minute" type="number" min="1" placeholder="00">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPhone" class="col-lg-4 control-label">Цена:</label>

                            <div class="col-lg-4">
                                <p class="get get_price">400</p>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <div class="form-group text-center">
                    <div class="col-lg-12 add">
                        <button class="btn btn-success" onclick="actions('editBoard', <?php echo $board_id ?>)">Сохранить</button>
                        <button type="button" class="btn btn-default closebtn" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            <?php }
            break;

        case "editBoard":
            $board_id = filter("val");
            $hour = filter("get_hour");
            $minute = filter("get_minute");
            $table = filter("get_table");
            $get_price = filter("get_price");
            if($minute == ""){
                $minute = "00";
            }
            $time = $hour.":".$minute;
            $select = select("SELECT hour, minute, price, finish_time FROM Board WHERE id = '$board_id'");
            foreach($select as $s){
                $hour = (int)$hour+(int)$s['hour'];
                $minute = (int)$minute+(int)$s['minute'];
                $price = (int)$get_price+(int)$s['price'];
                $finish_time = $s['finish_time'];
                $update = update("UPDATE Board SET table_id='$table',hour='$hour',minute='$minute',price='$price',date=NOW(),time=NOW(),finish_time=DATE_ADD('$finish_time', INTERVAL '$time' HOUR_MINUTE),datetime=NOW() WHERE id=?", $board_id);
                if($update){
                    echo "updated";
                }
            }

            break;

        case "endBoard":
            $board_id = filter("val");
            $insert = insert("INSERT INTO Archive_B SELECT * FROM Board WHERE id = '$board_id' AND id NOT IN (SELECT id FROM Archive_B)");
            if($insert){
                $delete = delete("DELETE FROM Board WHERE id = ?", $board_id);
                if($delete){
                    echo "ended";
                }
            }
            break;

        case "getBoardDate":
            $date_post = filter("val");
            $date = DateTime::createFromFormat('d-m-Y', $date_post);
            $date_start = $date->format("Y-m-d");

            $a = filter("a");
            $query = "";
            if($a == 1){
                $query = "SELECT * FROM Archive_B WHERE date = '$date_start'";
            } else {
                $query = "SELECT * FROM Archive_A WHERE date = '$date_start'";
            }
            $select = select($query);
            foreach($select as $s){
                $b_id = $s['id'];
                ?>
                <tr>
                    <td><?php echo $s['table_id'] ?></td>
                    <td><?php echo $s['hour'] . " час и ".$s['minute']." минуты" ?></td>
                    <td style="text-align: center"><?php echo "00:00" ?></td>
                    <td style="text-align: center"><?php echo $s['price'] ?></td>
                    <td width="15%"><?php echo $s['time'] ?></td>
                    <td>Завершен</td>
                    <?php if($a == 1){?>
                        <td class="inputs"><input class="check" type="checkbox" value="<?php echo $b_id ?>"></td>
                    <?php } ?>
                </tr>
            <?php }
            break;

        case "createWhiteBoard":
            $ids = filter("ids");
            $insert = insert("INSERT INTO Archive_A SELECT * FROM Archive_B WHERE id = '$ids' AND id NOT IN (SELECT id FROM Archive_A)");
            echo "copied";
            break;

        case "getBoardClub":
            $club_id = filter("val");

            $a = filter("a");
            $query = "";
            if($a == 1){
                $query = "SELECT * FROM Archive_B WHERE club_id = '$club_id'";
            } else {
                $query = "SELECT * FROM Archive_A WHERE club_id = '$club_id'";
            }
            $select = select($query);
            if($select != "no data"){
                foreach($select as $s){
                    $b_id = $s['id'];
                    ?>
                    <tr>
                        <td><?php echo $s['table_id'] ?></td>
                        <td><?php echo $s['hour'] . " час и ".$s['minute']." минуты" ?></td>
                        <td style="text-align: center"><?php echo "00:00" ?></td>
                        <td style="text-align: center"><?php echo $s['price'] ?></td>
                        <td width="15%"><?php echo $s['time'] ?></td>
                        <td>Завершен</td>
                        <?php if($a == 1){?>
                            <td class="inputs"><input class="check" type="checkbox" value="<?php echo $b_id ?>"></td>
                        <?php } ?>
                    </tr>
                <?php }
            }

            break;
    }
}
