<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <?php include './partials/header.php' ?>

    <div class="w-full h-screen flex justify-center items-center">
        <form action="./api/user.php" method="post" class="flex flex-col bg-slate-600 p-6 gap-4 rounded shadow-lg">
            <input type="text" name="nombre" id="" placeholder="Nombre" class="px-2 text-2xl">
            <input type="email" name="email" id="" placeholder="Email" class="px-2 text-2xl">
            <input type="password" name="contraseña" id="" placeholder="Contraseña" class="px-2 text-2xl">
            <input type="submit" value="Añadir usuario" class="px-2 text-2xl bg-slate-400 text-white cursor-pointer">
        </form>
    </div>

</body>

</html>