<?php
include './utils/db.php';
include './middelwares/isLoginAsAdmin.php';

$sql = "select * from user";
$result = $conn->query($sql);

$id = $_COOKIE['session'];

$sqlFiles = "select * from files where userID = '$id'";
$resultFiles = $conn->query($sqlFiles);

$ADMIN = false;
$sqlAdmin = "select * from user where id = '$id'";
$resultAdmin = $conn->query($sqlAdmin);
while ($row = $resultAdmin->fetch_assoc()) {
    $username = $row['username'];
    if($row['ADMIN'] == 1) $ADMIN = true;
    else header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-animated">
    <header class="fixed top-0 left-0 w-full bg-white shadow-lg flex justify-between px-4 py-2 items-center">
        <div class="flex gap-4">
            <?php if($ADMIN == true) {?>
                <a href="index.php" class="text-xl text-neutral-700">Inicio</a>
                <a href="users.php" class="text-xl text-neutral-700">Usuarios</a>
                <p class="text-xl text-neutral-500">ID: <?php echo $id; ?></p>
            <?php } ?>
            <p class="text-xl text-neutral-500">Usuario: <?php echo $username; ?></p>
        </div>
        <a class="bg-red-500 text-xl rounded-sm text-white py-1 px-2" href="logout.php">Cerrar sesion</a>
    </header>
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="flex flex-col gap-4">

            <div class="bg-white p-6 rounded-sm flex flex-col gap-1 shadow-lg">

                <?php while ($row = $result->fetch_assoc()) {?>
                    <?php if($row['id'] == $id || $ADMIN == true) {?>
                        <form action="update.php" method="post" class="flex border border-neutral-400 rounded-sm">
                            <div class="flex flex-col border border-neutral-300 rounded-sm px-2 py-1 hidden">
                                <p class="text-md text-neutral-500">ID</p>
                                <input class="text-xl text-neutral-700 focus:outline-neutral-300 cursor-pointer focus:outline w-16" name="id" type="text" value="<?php echo $row['id']; ?>">
                            </div>
                            <div class="flex flex-col border border-neutral-300 rounded-sm px-2 py-1">
                                <p class="text-md text-neutral-500">Nombre</p>
                                <input class="text-xl text-neutral-700 focus:outline-neutral-300 cursor-pointer focus:outline w-20" name="username" type="text" value="<?php echo $row['username']; ?>">
                            </div>
                            <div class="flex flex-col border border-neutral-300 rounded-sm px-2 py-1">
                                <p class="text-md text-neutral-500">Email</p>
                                <input class="text-xl text-neutral-700 focus:outline-neutral-300 cursor-pointer focus:outline w-64" name="email" type="email" value="<?php echo $row['email']; ?>">
                            </div>
                            <div class="flex flex-col border border-neutral-300 rounded-sm px-2 py-1">
                                <p class="text-md text-neutral-500">Tag</p>
                                <input class="text-xl text-neutral-700 focus:outline-neutral-300 cursor-pointer focus:outline w-16" name="tag" type="text" value="<?php echo $row['tag']; ?>">
                            </div>
                            <div class="flex flex-col border border-neutral-300 rounded-sm px-2 py-1">
                                <p class="text-md text-neutral-500">ADMIN</p>
                                <input class="text-xl text-neutral-700 focus:outline-neutral-300 cursor-pointer focus:outline w-16" name="ADMIN" type="text" value="<?php echo $row['ADMIN']; ?>">
                            </div>
                            <input type="submit" class="px-3 flex items-center py-1 bg-purple-500 text-center text-white text-xl font-semibold cursor-pointer" value="Guardar">
                            <a href="<?php echo "removeuser.php?id=" . $row['id']; ?>" class="px-3 flex items-center py-1 bg-red-500 text-center text-white text-xl font-semibold">Eliminar</a>
                        </form>
                    <?php } ?>
                <?php } ?>

            </div>
        </div>
    </div>
</body>
</html>
