<?php

session_start();

if (isset($_SESSION["usuario"])) {
    header("Location: panel.php");
} else {
    header("Location: login/login.php");
}

exit();

?>