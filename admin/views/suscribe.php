<?php
include("../includes/header.php");
include("../config/db.php");
if ($_GET) {
    $id_servicio = $_GET['id'];
    $id_cliente = $_SESSION['id'];
    //Primero buscamos si ya no esta suscripto a ese servicio
    $query = "SELECT * FROM user_service WHERE id_user = $id_cliente AND id_service = $id_servicio";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) >= 1) {
        $_SESSION['message'] = "You already have this service";
        $_SESSION['message_color'] = 'warning';
        $location = "location:viewservice.php?id=".$id_servicio;
        header($location);
    } else {
        $query = "INSERT INTO user_service (id_user, id_service, status) VALUES ($id_cliente, $id_servicio, 1)";
        mysqli_query($conexion, $query);
        $_SESSION['message'] = "You have successfully subscribed.";
        $_SESSION['message_color'] = 'success';
        header("location:myservices.php");
    }
}
?>