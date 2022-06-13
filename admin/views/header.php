<?php
session_start();
if ($_SESSION['rol'] != 1) 
    header("location:noaccess.php");
?>
<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
</head>

<body>
    <div class="container">
        <nav class="nav bg-light nav-tabs justify-content-center mt-2">
            <a href="../../index.php" class="nav-link">Home</a>
            <a href="dashboard.php" class="nav-link">Dashboard</a>
            <a href="addservice.php" class="nav-link">Add Service</a>
        </nav>