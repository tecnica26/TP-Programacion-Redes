<header class="stikcy top-0 left-0 w-full bg-white shadow-lg flex justify-between px-4 py-2 items-center">
    <div class="flex gap-4">
        <?php if($ADMIN == true) {?>
            <a href="index.php" class="text-xl text-neutral-700">Inicio</a>
            <a href="users.php" class="text-xl text-neutral-700">Usuarios</a>
            <!-- <p class="text-xl text-neutral-500">ID: <?php echo $id; ?></p> -->
        <?php } ?>
        <p class="text-xl text-neutral-500">Usuario: <?php echo $username; ?></p>
    </div>
    <a class="bg-red-500 text-xl rounded-sm text-white py-1 px-2" href="logout.php">Cerrar sesion</a>
</header>