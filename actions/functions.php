<?php
//session_start();
//$id = $_SESSION["user_id"];
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

function select($query){
    include(__DIR__ . "/bd.php");
    $result = $conn->query("set names utf8");
    $sql = $query;
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        $resultset[] = $row;
    }
    if(!empty($resultset)) {
        return $resultset;
    } else {
        return "no data";
    }

}

function insert($query){
    include(__DIR__ . "/bd.php");
    $insert_row = $conn->query("set names utf8");
    $insert_row = $conn->query($query);
    if($insert_row){
        return "ok";
    } else {
        return "error";
    }
}

function update($query, $variable){
    include(__DIR__ . "/bd.php");
    $update = $conn->prepare($query);
    $update->bind_param('i', $variable);
    $update->execute();
    $update->close();
    if($update){
        return "ok";
    } else {
        return "error";
    }
}

function delete($query, $variable){
    include(__DIR__ . "/bd.php");
    if (!empty($variable)) {
        $delete = $conn->prepare($query);
        $delete->bind_param('i', $variable);
        $delete->execute();
        $delete->close();
        if($delete){
            return "ok";
        } else {
            return "error";
        }
    }
}
?>