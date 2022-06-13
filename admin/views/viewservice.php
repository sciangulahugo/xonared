<?php
include("../includes/header.php");
include("../config/db.php");
if ($_GET) {
    $message = "";
    $message_color = "";
    $id = $_GET['id'];
    $query = "SELECT * FROM services WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_array($result);
    //Ya estas suscripto al servicio
    $message = $_SESSION['message'];
    $message_color = $_SESSION['message_color'];
    $_SESSION['message'] = "";
    $_SESSION['message_color'] = "";
}
?>
<div class="row justify-content-center">
    <div class="col-md-4">
        <!-- Aviso -->
        <?php if (!empty($message)) { ?>
            <div class="alert mt-2 alert-<?= $message_color; ?> alert-dismissible fade show" role="alert">
                <?= $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <!-- Fin Aviso -->
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="mt-2 p-5 bg-light text-center">
            <div class="container">
                <h1 class="display-3"><?= $row['name']; ?></h1>
                <p class="lead"><?= $row['description']; ?></p>
                <hr class="my-2">
                <p>Suscribe</p>
                <p class="lead">
                    <?php
                    $query = "SELECT * FROM servicio_opciones WHERE id_servicio = $id";
                    $result = mysqli_query($conexion, $query);
                    if (mysqli_num_rows($result)) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                            <input type="radio" class="btn-check" name="opciones" id="<?= $row['id']; ?>" value="<?= $row['name']; ?>">
                            <label class="btn btn-outline-primary btn-sm" for="<?= $row['id']; ?>"><?= $row['name']; ?></label>
                        <?php
                        } //End While
                    } else {
                        ?>
                        <a class="btn btn-primary btn-sm btn-lg" href="suscribe.php?id=<?= $row['id']; ?>" role="button">Buy $<?= $row['price']; ?></a>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>