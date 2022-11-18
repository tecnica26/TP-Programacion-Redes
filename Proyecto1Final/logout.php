<?php
if (isset($_COOKIE['session'])) {
    unset($_COOKIE['session']);
    setcookie('session', null, -1, '/');
}
header('Location: login.php');
exit;
?>