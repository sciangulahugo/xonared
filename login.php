<?php
session_start();
require("db.php");
$name = "";
$password = "";
$message = "";
$message_color = "";
if ($_POST) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user WHERE name = '$name' AND password = '$password'";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['online'] = "";
        $_SESSION['message'] = "Welcome " . $_POST['name'];
        $_SESSION['message_color'] = "success";
        header("location:index.php");
    } else {
        $message = "User or password incorrect";
        $message_color = "danger";
    }
} else {
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $message_color = $_SESSION['message_color'];
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <!-- Card -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <!-- Aviso -->
                <?php if (!empty($message)) { ?>
                <div class="alert alert-<?= $message_color;?> alert-dismissible fade show" role="alert">
                    <?= $message;?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php } ?>
                <!-- Fin Aviso -->
                <div class="card">
                    <div class="card-header">
                        Login.
                    </div>
                    <div class="card-body">
                        <!-- Inputs -->
                        <form action="login.php" method="post">
                            Name: <input type="text" name="name" class="form-control form-control-sm" placeholder="Your Name..." autofocus> <br>
                            Password: <input type="password" name="password" class="form-control form-control-sm" placeholder="Your Password"> <br>
                            <input type="submit" value="Login" class="btn btn-success btn-sm">
                        </form>
                        <!-- Fin Inputs -->
                    </div>
                    <div class="card-footer text-muted">
                        ForCoders
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Find Card -->
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>