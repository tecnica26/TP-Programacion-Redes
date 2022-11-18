<?php
include './utils/db.php';

if (isset($_COOKIE['session'])) {
    header('Location: index.php');
}

if (isset($_POST['email'])) $email = $_POST['email'];
if (isset($_POST['password'])) $password = $_POST['password'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "select * from user where email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            if ($password == $row['password']) {
                setcookie('session', $row['id'], time() + (86400 * 30) * 360, "/");
                header("Location: index.php");
            } else {
                $msg = 'Nombre de usuario o contraseña incorrectos.';
            }
        }
    } else {
        $msg = 'Nombre de usuario o contraseña incorrectos.';
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
        <form action="login.php" method="post" class="bg-white p-6 rounded-sm flex flex-col gap-4 shadow-lg">
            <div class="flex flex-col gap-2">
                <label class="text-md text-neutral-700 font-semibold" for="">Email</label>
                <input class="focus:outline-none focus:border-neutral-400 text-neutral-700 px-2 py-1 text-xl border border-neutral-300 rounded-sm" required type="email" name="email" id="" placeholder="Email">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-md text-neutral-700 font-semibold" for="">Contraseña</label>
                <input class="focus:outline-none focus:border-neutral-400 text-neutral-700 px-2 py-1 text-xl border border-neutral-300 rounded-sm" required autocomplete="off" type="password" name="password" id="" placeholder="Contraseña">
            </div>
            <input class="text-xl text-neutral-700 bg-purple-500 font-semibold rounded-sm text-white py-2 cursor-pointer" type="submit" value="Iniciar sesion">
            <a class="text-neutral-700 hover:underline" href="register.php">No tienes una cuenta? Registrate</a>
            <?php if(isset($_GET['msg'])){ ?>
                <p class="text-neutral-700 font-semibold text-center" href="login.php"><?php echo $_GET['msg']; ?></p>
            <?php } ?>
        </form>
    </div>
</body>
</html>