<?php
if (!isset($_COOKIE['session'])) {
    header('Location: login.php');
    exit;
}

include './utils/db.php';

$sql = "select * from user";
$result = $conn->query($sql);


$id = $_COOKIE['session'];
$ADMIN = false;
$sqlAdmin = "select * from user where id = '$id'";
$resultAdmin = $conn->query($sqlAdmin);
while ($row = $resultAdmin->fetch_assoc()) {
    if($row['ADMIN'] == 1) $ADMIN = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-animated">
    <header class="fixed top-0 left-0 w-full bg-white shadow-lg flex justify-between px-4 py-2">
        <p class="text-xl text-neutral-799">ID: <?php echo $id; ?></p>
        <a class="bg-red-500 rounded-sm text-white py-1 px-2" href="logout.php">Cerrar sesion</a>
    </header>
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="bg-white p-6 rounded-sm flex flex-col gap-1 shadow-lg">

            <?php while ($row = $result->fetch_assoc()) {?>
                <?php if($row['id'] == $id || $ADMIN == true) {?>
                    <div class="flex border border-neutral-400 rounded-sm">
                        <div class="flex flex-col border border-neutral-300 rounded-sm px-2 py-1">
                            <p class="text-md text-neutral-500">ID</p>
                            <p class="text-xl text-neutral-700"><?php echo $row['id']; ?></p>
                        </div>
                        <div class="flex flex-col border border-neutral-300 rounded-sm px-2 py-1">
                            <p class="text-md text-neutral-500">Nombre de usuario</p>
                            <p class="text-xl text-neutral-700"><?php echo $row['username']; ?></p>
                        </div>
                        <div class="flex flex-col border border-neutral-300 rounded-sm px-2 py-1">
                            <p class="text-md text-neutral-500">Email</p>
                            <p class="text-xl text-neutral-700"><?php echo $row['email']; ?></p>
                        </div>
                        <div class="flex flex-col border border-neutral-300 rounded-sm px-2 py-1">
                            <p class="text-md text-neutral-500">Tag</p>
                            <p class="text-xl text-neutral-700">#<?php echo $row['tag']; ?></p>
                        </div>
                        <div class="flex flex-col border border-neutral-300 rounded-sm px-2 py-1">
                            <p class="text-md text-neutral-500">ADMIN</p>
                            <p class="text-xl text-neutral-700"><?php echo $row['ADMIN']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>

        </div>
    </div>
</body>
</html>
