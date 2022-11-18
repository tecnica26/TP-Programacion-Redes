<?php

$host = "localhost";
$usuario =  "root";
$contrasena =  "";
$bd = "proyecto";

$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    echo "Failed to connect to MyQL: " . $conn->connect_error;
    exit();
}

?>