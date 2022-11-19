<?php

include './utils/db.php';

if (!isset($_COOKIE['session'])) header('Location: login.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_COOKIE['session'];

    $target_dir = "uploads/" . $id . "/";
    $target_filename = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $target_filename;

    echo $target_file;

    if (!file_exists($target_dir)) {
        mkdir("uploads/" . $id, 0777);
    } 

    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $sql = "insert into files (filename, userID) values ('$target_filename', '$id')";

    $result = $conn->query($sql);

    header("Location: index.php");
    exit;
}
?>