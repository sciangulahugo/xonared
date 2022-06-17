<?php
include("../includes/header.php");
include("../config/db.php");
$id_service = 0;
$id_option_service = "";
//ID del cliente
$id_cliente = $_SESSION['id'];
if (isset($_GET['id'])) {
    $id_service = $_GET['id'];
    //Primero buscamos si ya no esta suscripto a ese servicio
    $query = "SELECT * FROM user_service WHERE id_user = $id_cliente AND id_service = $id_service";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) >= 1) {
        $_SESSION['message'] = "You already have this service";
        $_SESSION['message_color'] = 'warning';
        $location = "location:viewservice.php?id=".$id_service;
        header($location);
    } else {
        $query = "INSERT INTO user_service (id_user, id_service, status) VALUES ($id_cliente, $id_service, 1)";
        mysqli_query($conexion, $query);
        $_SESSION['message'] = "You have successfully subscribed.";
        $_SESSION['message_color'] = 'success';
        header("location:myservices.php");
    }
} else {
    if ((isset($_GET['id_option'])) && (isset($_GET['id_service']))) {
        //Buscamos que no este suscripto a ningun plan
        $id_option_service = $_GET['id_option'];
        $id_service = $_GET['id_service'];
        $query = "SELECT * FROM user_service WHERE id_user = $id_cliente AND id_service = $id_service";
        $result = mysqli_query($conexion, $query);
        if (mysqli_num_rows($result) >= 1) {
            $_SESSION['message'] = "You already have this service.";
            $_SESSION['message_color'] = 'warning';
            $location = "location:viewservice.php?id=".$id_service;
            header($location);
        } else {
            $query = "INSERT INTO user_service (id_user, id_service, status) VALUES ($id_cliente, $id_service, 1)";
            mysqli_query($conexion, $query);
            $query = "INSERT INTO user_service_option (id_user, id_option, id_service) VALUES ($id_cliente, $id_option_service, $id_service)";
            mysqli_query($conexion, $query);
            $_SESSION['message'] = "You have successfully subscribed.";
            $_SESSION['message_color'] = 'success';
            header("location:myservices.php");
        }
    }
}
?>