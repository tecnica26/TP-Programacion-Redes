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

    <?php
    include './partials/header.php';
    include './utils/db.php';

    $sql = "select * from users";
    $res = $conn->query($sql);
    ?>
    <div class="flex justify-center items-center w-screen h-screen">
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Contraseña</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contraseña']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

</body>

</html>