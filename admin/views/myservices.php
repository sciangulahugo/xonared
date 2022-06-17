<?php
include("../includes/header.php");
include("../config/db.php");
$message = "";
$message_color = "";
$listar = 0;
$id_user = $_SESSION['id'];
$query = "SELECT * FROM user_service WHERE id_user = $id_user";
$result_user = mysqli_query($conexion, $query);
if (mysqli_num_rows($result_user) >= 1) {
    $listar = 1;
    //Suscripto correctamente al servicio
    $message = $_SESSION['message'];
    $message_color = $_SESSION['message_color'];
    $_SESSION['message'] = "";
    $_SESSION['message_color'] = "";
}
?>
<?php if ($listar) { ?>
    <div class="row justify-content-center">
        <h2 class="mt-2 text-center">Mis Servicios</h2>
        <!-- Tabla -->
        <div class="col-md-6">
            <!-- Aviso -->
            <?php if (!empty($message)) { ?>
                <div class="alert mt-2 alert-<?= $message_color; ?> alert-dismissible fade show" role="alert">
                    <?= $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <!-- Fin Aviso -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row_user = mysqli_fetch_array($result_user)) {
                        $id_relation = $row_user['id'];
                        $id_service = $row_user['id_service'];
                        $query = "SELECT * FROM services WHERE id = $id_service";
                        $result = mysqli_query($conexion, $query);
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['description']; ?></td>
                                <td>
                                    <?php
                                    if ($row_user['status'] == 1) {
                                        $message = "online";
                                        $color = "success";
                                    } else {
                                        $message = "disabled";
                                        $color = "danger";
                                    }
                                    ?>
                                    <span class="badge bg-<?= $color; ?>"><?= $message; ?></span>
                                </td>
                                <td>
                                    <a href="detailsservice.php?id_relation=<?= $id_relation; ?>" class="btn btn-primary btn-sm" style="--bs-btn-padding-y: .35em; --bs-btn-padding-x: .65em; --bs-btn-font-size: .50rem;"><i class="bi bi-pencil"></i></a>        
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Fin tabla -->
    <?php } else { ?>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="alert alert-danger mt-2" role="alert">
                    You dont have services!
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="d-flex justify-content-center">
        <a href="index.php" class="btn btn-success btn-sm">Back</a>
    </div>
    </div>
    <?php
    include("../views/footer.php");
    ?>