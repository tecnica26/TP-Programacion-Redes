<?php
include './utils/db.php';
include './middelwares/isLogin.php';

$sql = "select * from user";
$result = $conn->query($sql);

$id = $_COOKIE['session'];

$search = '';
$sqlFiles = "select * from files where userID = '$id'";

if(isset($_GET['q'])) {
    $search = $_GET['q'];
    $sqlFiles = "select * from files where userID = '$id' and filename like '%$search%'";
}
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
    <?php include './utils/header.php'; ?>

    <div class='p-8 flex flex-col gap-4'>
        <form action="index.php" method="get" class='bg-white flex p-2 gap-2'>
            <input type="text" name="q" id="" placeholder="Buscar archivo" class='px-2 py-1 rounded-sm text-xl text-neutral-700 w-full focus:outline-none border border-neutral-300' value="<?php echo $search;?>">
            <input type="submit" id="" value="Buscar" class="rounded-sm text-white text-xl font-semibold bg-purple-500 px-2 py-1 cursor-pointer">
        </form>
        <div class="bg-white p-6 rounded-sm grid grid-cols-4 gap-6 shadow-lg">
            <?php if($search == '') {?>
                <form action="subir.php" method="post" id="form" enctype="multipart/form-data" class="border border-neutral-400 bg-white rounded-sm flex flex-col justify-between shadow-lg">
                    <div class="w-full h-32 relative    ">
                        <div class="absolute w-full h-full flex justify-center items-center pointer-events-none">
                            <p class="text-md opacity-50">Arrastrar o soltar para subir un archivo.</p>
                        </div>
                        <input form="form" class="file:hidden cursor-pointer w-full h-full focus:outline-none focus:border-neutral-400 text-neutral-700 text-xl border border-neutral-300 rounded-sm" required autocomplete="off" type="file" name="file" id="">
                    </div>
                    <input class="text-xl bg-purple-500 font-semibold rounded-sm text-white px-2 py-1 cursor-pointer" type="submit" value="Subir archivo">
                </form>
            <?php } ?>
            <?php while ($row = $resultFiles->fetch_assoc()) {?>
                <?php if($row['userID'] == $id) {?>
                    <div class="flex flex-col justify-between border border-neutral-400 rounded-sm">
                        <div class="flex flex-col h-full rounded-sm px-2 py-1">
                            <p class="text-md text-neutral-500">Nombre de archivo</p>
                            <p class="text-xl text-neut ral-700"><?php echo $row['filename']; ?></p>
                        </div>
                        <div class="flex">
                            <a download href="<?php echo "uploads/" . $id . "/" . $row['filename']; ?>" class="px-2 w-[50%] py-1 bg-purple-500 text-center text-white text-xl font-semibold">Download</a>
                            <a href="<?php echo "eliminar.php?userid=" . $id . "&filename=" . $row['filename']; ?>" class="px-2 w-[50%] py-1 bg-red-500 text-center text-white text-xl font-semibold">Eliminar</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</body>
</html>
