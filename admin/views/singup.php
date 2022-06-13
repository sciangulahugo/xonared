<?php
require("../config/db.php");
session_start();
$name = "";
$password = "";
if (isset($_SESSION['online']))
    header("location:index.php");
if ($_POST) {
    $name = $_POST['name'];
    $query = "SELECT * FROM user WHERE name = '$name'";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) >= 1) {
        $message = "That user already exist";
        $message_color = "danger";
    } else {
        if ($_POST['password'] != $_POST['repeat_password']) {
            $message = "Password do not match";
            $message_color = "warning";
        } else {
            $password = $_POST['password'];
            $query = "INSERT INTO user (name, password) VALUES ('$name','$password')";
            mysqli_query($conexion, $query);
            $_SESSION['message'] = "Registered Successfully";
            $_SESSION['message_color'] = "success";
            header("location:login.php");
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
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
                        SingUp.
                    </div>
                    <div class="card-body">
                        <!-- Inputs -->
                        <form action="singup.php" method="post">
                            Name: <input type="text" name="name" value="<?=$name;?>" class="form-control form-control-sm" placeholder="Your Name..." autofocus required> <br>
                            Password: <input type="password" name="password" class="form-control form-control-sm" placeholder="Your Password..." required> <br>
                            Repeat Password: <input type="password" name="repeat_password" class="form-control form-control-sm" placeholder="Repeat your password" required> <br>
                            <input type="submit" value="SingUp" class="btn btn-success btn-sm">
                            <a href="login.php" class="btn btn-secondary btn-sm">Login</a>
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
    <!-- Fin Card -->
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>