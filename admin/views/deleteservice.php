<?php
include("../config/db.php");
if ($_GET) {
    $id = $_GET['id'];
    $query = "DELETE FROM services WHERE id = $id";
    mysqli_query($conexion, $query);
    header("location:addservice.php");
}
?>