<?php
include("../config/db.php");
if ($_GET) {
    $id_relation = $_GET['id'];
    $query = "UPDATE user_service SET status = 1 WHERE id = $id_relation";
    mysqli_query($conexion, $query);
    header("location:myservices.php");
}
?>