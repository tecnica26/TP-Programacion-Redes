<?php

include '../utils/db.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if (isset($_GET['id'])) $id = $_GET['id'];

    $sql = "select * from registro where id = $id";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo "0 results";
    }
}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['nombre'])) $nombre = $_POST['nombre'];
    if (isset($_POST['email'])) $email = $_POST['email'];
    if (isset($_POST['contraseña'])) $contraseña = $_POST['contraseña'];

    $sql = "insert into users (nombre, email, contraseña) values ('$nombre', '$email', '$contraseña')";
    if ($conn->query($sql) === TRUE) {
        echo "New user created successfully";
    } else {
        echo $conn->error;
    }
    header('Location: ../index.php');
    die();
}