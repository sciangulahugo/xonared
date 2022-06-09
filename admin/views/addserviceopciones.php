<?php
include("../config/db.php");
if ($_GET) {
    $id = $_GET['id'];
    $option_name = $_POST['name_option'];
    $option_price = $_POST['price_option'];
    $query = "INSERT INTO servicio_opciones (id_servicio,name,price) VALUES ($id,'$option_name',$option_price)";
    mysqli_query($conexion, $query);
    $location = "location:editservice.php?id=".$id;
    header($location);
}
?>