<?php

include './utils/db.php';

if (!isset($_COOKIE['session'])) header('Location: login.php');

if(isset($_GET['userid'])) $userID = $_GET['userid'];
if(isset($_GET['filename'])) $filename = $_GET['filename'];

$id = $_COOKIE['session'];
if ($userID == $id) {
    $target_dir = "uploads/" . $id . "/";
    $target_filename = $filename;
    $target_file = $target_dir . $filename;

    if (!file_exists($target_file)) {
        unlink($target_file);
    } 

    $sql = "delete from files where userID='$id' and filename='$filename'";
    $result = $conn->query($sql);

    header("Location: index.php");
    exit;
}
?>