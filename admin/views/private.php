<?php
if ($_SESSION['rol'] != 1) 
    header("location:noaccess.php");
?>