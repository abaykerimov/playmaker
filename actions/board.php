<?php
session_start();
include("../bd.php");
include("../actions/functions.php");
$status = $_SESSION['status'];
$id = $_SESSION['user_id'];
$club_id = $_SESSION['club_id'];
if($status == 1){
    $club_id = $_GET['club'];
}
$board = select("SELECT * FROM Board WHERE club_id = '$club_id'");
if($board != "no data"){
    foreach ($board as $s) {
        $date_post = $s['date'];
        $date = DateTime::createFromFormat('Y-m-d', $date_post);
        $date_start = $date->format("d-m-Y");
        $open_time = $s['open_time'];
        $b_id = $s['id'];
        $price = $s['price'];
        $hours = 0;
        $minutes = 0;
        $seconds = 0;
        $finish = 0;
        $start = 0;
        if($open_time == 0){
            $finish = strtotime($s['finish_time']);
            $start = strtotime("now");
            $count = $finish - $start;
            $hours = floor($count / (60 * 60));
            $minutes = floor($count / (60)) - ($hours * 60);
            $count = $count % 60;
            $seconds = $count;
        } else {
            $start = strtotime($s['datetime']);
            $time_now = strtotime("now");
            $count = $time_now - $start;
            $hours = floor($count / (60 * 60));
            $minutes = floor($count / (60)) - ($hours * 60);
            $count = $count % 60;
            $seconds = $count;
            $price = round((400/60)*((int)$hours*60+$minutes), 2);
        }
        //if ($start <= $finish) {
        ?>
        <tr>
            <td><?php echo $s['table_id'] ?></td>
            <td><?php echo $s['hour'] . " час и ".$s['minute']." минуты" ?></td>
            <td style="text-align: center;"><?php if($start <= $finish && $open_time == 0){echo $hours . ":" . $minutes;} elseif($open_time == 1){echo $hours . ":" . $minutes;} else { echo "Завершен";}  ?></td>
            <td style="text-align: center"><?php echo $price ?></td>
            <td width="15%"><?php echo $s['time']."<br>".$date_start ?></td>
            <td>
                <button class="btn btn-default <?php if($open_time==1) echo 'disabled' ?>" style="margin-right: 15px" data-toggle="modal" data-target="#myModal2" onclick="actions('getBoard', <?php echo $b_id ?>)">Продлить</button>
                <button class="btn btn-danger" onclick="
                    if (confirm('Вы хотите завершить?')){
                    actions('endBoard', <?php echo $b_id ?>)}">Завершить</button>
            </td>
        </tr>
        <input type="hidden" class="hidden_open_<?php echo $b_id ?>" value="<?php echo $s['open_time'] ?>">
        <script>
            function start(counter){
                var hours = <?php echo $hours ?>;
                var minutes = <?php echo $minutes ?>;
                if(counter < 10){
                    setTimeout(function(){
                        counter++;
                        if(hours == 0 && minutes == 3){
                            document.getElementById("beepSound").play();
                        }
                        console.log(counter);
                        start(counter);
                    }, 2000);
                }
            }
            start(0);
        </script>
        <?php
        /*} else {
            $insert = insert("INSERT INTO Archive_B SELECT * FROM Board WHERE id = '$b_id' AND id NOT IN (SELECT id FROM Archive_B)");
            if($insert){
                $delete = delete("DELETE FROM Board WHERE id = ?", $b_id);
            }
        }*/
    }
}
?>