<?php
if (!isset($_COOKIE['session'])) {
    header('Location: login.php');
    exit;
}

include './utils/db.php';

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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-animated">
    <header class="stikcy top-0 left-0 w-full bg-white shadow-lg flex justify-between px-4 py-2 items-center">
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
    <div class="w-full h-screen flex justify-center items-center">
        <div class="flex flex-col gap-4">

            <form action="subir.php" method="post" id="form" enctype="multipart/form-data" class="bg-white p-6 rounded-sm flex flex-col gap-4 shadow-lg">
                <div class="flex flex-col gap-2">
                    <label class="text-md text-neutral-700 font-semibold" for="">Archivo</label>
                    <input form="form" class="file:border-none file:font-semibold file:rounded-sm file:px-2 file:py-1 file:text-white file:bg-purple-500 focus:outline-none focus:border-neutral-400 text-neutral-700 text-xl border border-neutral-300 rounded-sm" required autocomplete="off" type="file" name="file" id="">
                </div>
                <input class="text-xl bg-purple-500 font-semibold rounded-sm text-white py-2 cursor-pointer" type="submit" value="Subir archivo">
            </form>

            <div class="bg-white p-6 rounded-sm grid grid-columns-3 gap-6 shadow-lg">

                <?php while ($row = $resultFiles->fetch_assoc()) {?>
                    <?php if($row['userID'] == $id) {?>
                        <div class="flex flex-col border border-neutral-400 rounded-sm">
                            <div class="flex flex-col border border-neutral-300 rounded-sm px-2 py-1">
                                <p class="text-md text-neutral-500">Nombre de archivo</p>
                                <p class="text-xl text-neut ral-700"><?php echo $row['filename']; ?></p>
                            </div>
                            <div class="flex">
                                <a download href="<?php echo "uploads/" . $id . "/" . $row['filename']; ?>" class="px-2 w-[50%] py-1 bg-purple-500 rounded-l-sm text-center text-white text-xl font-semibold">Download</a>
                                <a href="<?php echo "eliminar.php?userid=" . $id . "&filename=" . $row['filename']; ?>" class="px-2 w-[50%] py-1 bg-red-500 rounded-r-sm text-center text-white text-xl font-semibold">Eliminar</a>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

            </div>
        </div>
    </div>
</body>
</html>
