<?php
//include("../views/private.php");
include("../config/db.php");
session_start();
$id_relation = $_SESSION['id_relation'];
$_SESSION['id_relation'] = "";
$id_relation_user_option = $_SESSION['id_relation_user_option'];
$_SESSION['id_relation_user_option'] = "";
$id_new_plan = $_GET['id_new_plan'];
$query = "UPDATE user_service_option SET id_option = $id_new_plan WHERE id = $id_relation_user_option";
mysqli_query($conexion, $query);
$_SESSION['message'] = "Your plan was changed successfully";
$_SESSION['message_color'] = "success";
$location = "location:detailsservice.php?id_relation=".$id_relation;
header($location);
?>