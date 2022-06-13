<?php
include("../includes/header.php");
include("../config/db.php");
//consulta de servicios a la base de datos
$query = "SELECT * FROM services";
$result = mysqli_query($conexion, $query);
?>
<?php if ($_SESSION['message'] != "") { ?>
    <div class="mt-2 alert alert-<?= $_SESSION['message_color']; ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php }
$_SESSION['message'] = "";
?>
<h2 class="text-center mt-2">Servicios</h2>
<div class="row mt-2">
    <?php 
    while ($row = mysqli_fetch_array($result)) {
    ?>
    <div class="col-sm-4 mt-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $row['name'];?></h5>
                <p class="card-text"><?= $row['description'];?></p>
                <a href="viewservice.php?id=<?=$row['id'];?>" class="btn btn-primary btn-sm">View Service</a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php
include("../includes/footer.php");
?>