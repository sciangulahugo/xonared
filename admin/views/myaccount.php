<?php
include("../includes/header.php");
include("../config/db.php");
$id = $_SESSION['id'];
$message = "";
$message_color = "";
if ($_POST) {
    $password = $_POST['password'];   
    $query = "SELECT * FROM user WHERE id = $id AND password = '$password'";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) >= 1) {
        if ($_POST['new_password'] != $_POST['repeat_new_password']) {
            $message = "Your new password do not match";
            $message_color = "warning";
        } else {
            $new_password = $_POST['new_password'];
            $query = "UPDATE user SET password = $new_password WHERE id = $id";
            mysqli_query($conexion, $query);
            $message = "Your password is changed successfully";
            $message_color = "success";
        }
    } else {
        $message = "Error, your actual password is incorrect";
        $message_color = "danger";
    }
}
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-4">
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
                Change password
            </div>
            <div class="card-body">
                <form action="myaccount.php" method="post">
                    Your password: <input type="password" name="password" class="form-control" placeholder="Your password..." autofocus> <br>
                    New password: <input type="password" name="new_password" class="form-control" placeholder="New password..."> <br>
                    Repeat new password: <input type="password" name="repeat_new_password" class="form-control" placeholder="Repeat your new password..."> <br>
                    <input type="submit" value="Change" class="btn btn-success btn-sm">
                </form> 
            </div>
            <div class="card-footer text-muted">
                ForCoderss
            </div>
        </div>
    </div>
</div>

<?php
include("../includes/footer.php");
?>