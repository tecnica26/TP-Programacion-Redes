<?php
if (!isset($_COOKIE['session'])){
    header('Location: login.php');
    exit;
}

$sessionID = $_COOKIE['session'];
$sessionResult = $conn->query("select * from user where id = '$sessionID'");

if ($sessionResult->num_rows > 0){
    while ($row = $sessionResult->fetch_assoc()) {
        if($row['ADMIN'] == 0){
            header('Location: index.php');
            exit;
        }
    }
}else{
    header('Location: login.php');
    exit;
}
?>