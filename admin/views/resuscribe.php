<?php
include("../config/db.php");
if ($_GET) {
    $id_relation = $_GET['id_relation'];
    $query = "UPDATE user_service SET status = 1 WHERE id = $id_relation";
    mysqli_query($conexion, $query);
    $location = "location:detailsservice.php?id_relation=".$id_relation;
    header($location);
}
?>