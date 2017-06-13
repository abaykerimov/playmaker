<?php
function filter($parameter) {
    if (isset($_POST[$parameter])) {
        $var = $_POST[$parameter];
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        $var = trim($var);
    } elseif (isset($_GET[$parameter])) {
        $var = $_GET[$parameter];
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        $var = trim($var);
    }
    else {
        $var = '';
    }
    return $var;
}