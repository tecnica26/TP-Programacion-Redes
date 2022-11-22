<?php
include './utils/db.php';
include './middelwares/isLoginAsAdmin.php';

$id = $_COOKIE['session'];

$ADMIN = false;
$sqlAdmin = "select * from user where id = '$id'";
$resultAdmin = $conn->query($sqlAdmin);
while ($row = $resultAdmin->fetch_assoc()) {
    $username = $row['username'];
    if($row['ADMIN'] == 1) $ADMIN = true;
    else {
        header("Location: index.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	echo $_POST['id'];
    if (isset($_POST['id'])) $prop_id = $_POST['id'];
    if (isset($_POST['username'])) $username = $_POST['username'];
    if (isset($_POST['email'])) $email = $_POST['email'];
    if (isset($_POST['tag'])) $tag = $_POST['tag'];
    if (isset($_POST['ADMIN'])) $PROP_ADMIN = $_POST['ADMIN'];

    $sql = "update user set username = '$username', email = '$email', tag = '$tag', ADMIN = '$PROP_ADMIN' where id = '$prop_id'";
    $result = $conn->query($sql);
    header("Location: users.php");
    exit;
}
?>