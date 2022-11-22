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

if (isset($_GET['id'])) $userID = $_GET['id'];

$sql = "delete from files where userID='$userID'";
$result = $conn->query($sql);
$sql2 = "delete from user where id='$userID'";
$result2 = $conn->query($sql2);

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

$target_dir = "uploads/" . $userID;
if (file_exists($target_dir)) {
    deleteDirectory($target_dir);
}

header("Location: users.php");
exit;
?>