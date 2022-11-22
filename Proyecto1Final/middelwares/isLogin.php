<?php
if (!isset($_COOKIE['session'])){
    header('Location: login.php');
    exit;
}

$sessionID = $_COOKIE['session'];
$sessionResult = $conn->query("select * from user where id = '$sessionID'");

if ($sessionResult->num_rows == 0){
    header('Location: logout.php');
    exit;
}
?>