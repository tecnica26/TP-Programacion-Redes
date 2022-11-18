<?php

function generateRandomString($length = 4) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

include './utils/db.php';

if (isset($_COOKIE['session'])) {
    header('Location: index.php');
}

if (isset($_POST['username'])) $username = $_POST['username'];
if (isset($_POST['email'])) $email = $_POST['email'];
if (isset($_POST['password'])) $password = $_POST['password'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tag = generateRandomString();

    $sql = "insert into user (username, email, password, tag) values ('$username', '$email', '$password', '$tag')";

    if ($conn->query($sql) === TRUE) {
        $msg = 'Usuario registrado perfectamente';
    } else {
        $msg = 'Ya existe un usuario con ese mismo email.';
    }

    header("Location: " . $_SERVER["REQUEST_URI"] . "?msg=" . $msg);
    exit;
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
    <div class="w-screen h-screen flex justify-center items-center">
        <form action="register.php" method="post" class="bg-white p-6 rounded-sm flex flex-col gap-4 shadow-lg">
            <div class="flex flex-col gap-2">
                <label class="text-md text-neutral-700 font-semibold" for="">Nombre de usuario</label>
                <input class="focus:outline-none focus:border-neutral-400 text-neutral-700 px-2 py-1 text-xl border border-neutral-300 rounded-sm" required autocomplete="off" type="text" name="username" id="" placeholder="Nombre de usuario">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-md text-neutral-700 font-semibold" for="">Email</label>
                <input class="focus:outline-none focus:border-neutral-400 text-neutral-700 px-2 py-1 text-xl border border-neutral-300 rounded-sm" required autocomplete="off" type="email" name="email" id="" placeholder="Email">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-md text-neutral-700 font-semibold" for="">Contraseña</label>
                <input class="focus:outline-none focus:border-neutral-400 text-neutral-700 px-2 py-1 text-xl border border-neutral-300 rounded-sm" required autocomplete="off" type="password" name="password" id="" placeholder="Contraseña">
            </div>
            <input class="text-xl text-neutral-700 bg-purple-500 font-semibold rounded-sm text-white py-2 cursor-pointer" type="submit" value="Registrarse">
            <a class="text-neutral-700 hover:underline" href="login.php">Ya tienes una cuenta? Inicia sesion</a>
            <?php if(isset($_GET['msg'])){ ?>
                <p class="text-neutral-700 font-semibold text-center" href="login.php"><?php echo $_GET['msg']; ?></p>
            <?php } ?>
        </form>
    </div>
</body>
</html>