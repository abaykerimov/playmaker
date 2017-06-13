<?php
session_start();
include("../bd.php");
include("../actions/functions.php");
$status = $_SESSION['status'];
$id = $_SESSION['user_id'];
$club_id = $_SESSION['club_id'];

$board = select("SELECT * FROM Board WHERE club_id = '$club_id'");
if($board != "no data"){
    foreach ($board as $s) {
        $finish = strtotime($s['finish_time']);
        $start = strtotime("now");
        $count = $finish - $start;
        $hours = floor($count / (60*60));
        $minutes = floor($count / (60))-($hours*60);
        $count = $count%60;
        $seconds = $count;
        $b_id = $s['id'];
        if ($start <= $finish) {
            ?>
            <tr>
                <td><?php echo $s['table_id'] ?></td>
                <td><?php echo $s['hour'] . " час и ".$s['minute']." минуты" ?></td>
                <td style="text-align: center"><?php echo $hours . ":" . $minutes ?></td>
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