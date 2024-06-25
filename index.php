<style>
    body{
        background-image: url(https://www.shutterstock.com/shutterstock/photos/1100305700/display_1500/stock-photo-medicine-doctor-using-digital-tablet-find-information-patient-medical-history-at-the-hospital-1100305700.jpg);
        background-repeat: no-repeat;
  		background-size: cover;
  		background-attachment: fixed;
  		background-position: center;
    }
</style>
<?php require "./inc/session_start.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <?php include "./inc/head.php"; ?>
</head>

<body>
    <?php

    if (!isset($_GET['vista']) || $_GET['vista'] == "") {
        $_GET['vista'] = "login";
    }


    if (is_file("./vistas/" . $_GET['vista'] . ".php") && $_GET['vista'] != "login" && $_GET['vista'] != "404") {

        /*== Cerrar sesion ==*/
        if ((!isset($_SESSION['id']) || $_SESSION['id'] == "") || (!isset($_SESSION['usuario']) || $_SESSION['usuario'] == "")) {
            include "./vistas/logout.php";
            exit();
        }

        include "./inc/navbar.php";

        include "./vistas/" . $_GET['vista'] . ".php";

        include "./inc/script.php";
    } else {
        if ($_GET['vista'] == "login") {
            include "./vistas/login.php";
        } else {
            include "./vistas/404.php";
        }
    }
    ?>
</body>

</html>