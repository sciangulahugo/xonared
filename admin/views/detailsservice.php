<?php
include("../includes/header.php");
include("../config/db.php");
$id_user = $_SESSION['id'];
if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $message_color = $_SESSION['message_color'];
}
$_SESSION['message'] = "";
$_SESSION['message_color'] = "";
if (isset($_GET['id_relation'])) {
    //Buscamos la relacion del cliente y el servicio
    $id_relation = $_GET['id_relation'];
    $_SESSION['id_relation'] = $id_relation;
    $query = "SELECT * FROM user_service WHERE id = $id_relation";
    $result_relation = mysqli_query($conexion, $query);
    $row_relation = mysqli_fetch_array($result_relation);
    //print_r($row_relation);
    //Buscamos los datos del servicio con el que esta relacionado   
    $query = "SELECT * FROM services WHERE id = " . $row_relation['id_service'];
    $result_service = mysqli_query($conexion, $query);
    $row_service = mysqli_fetch_array($result_service);
}
?>

<div class="row justify-content-center">
    <div class="col-md-6 text-center">
                        <!-- Aviso -->
                        <?php if (!empty($message)) { ?>
                <div class="alert mt-2 alert-<?= $message_color;?> alert-dismissible fade show" role="alert">
                    <?= $message;?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php } ?>
                <!-- Fin Aviso -->
        <div class="p-5 bg-light">
            <div class="container">
                <h1 class="display-5"><?= $row_service['name']; ?></h1>
                <p class="lead"><?= $row_service['description']; ?></p>
                <hr class="my-2">
                <p>Details</p>
                <?php if ($row_service['type'] == 1) { ?>
                    <p>
                        <span class="badge bg-primary">$<?= $row_service['price']; ?>/mont</span>
                    </p>
                <?php } else { ?>
                    <?php
                    $query = "SELECT * FROM user_service_option WHERE id_service = " . $row_relation['id_service'] . " AND id_user = $id_user";
                    $result_option_service = mysqli_query($conexion, $query);
                    $row_option_service = mysqli_fetch_array($result_option_service);
                    //creamos una variable de session para guardar la relacion del usuario y del plan
                    $_SESSION['id_relation_user_option'] = $row_option_service['id'];
                    //print_r($result_option_service);   
                    ?>
                    You are suscribed to: <span class="badge bg-primary"><?= $row_service['name']; ?></span> <br> <br>
                    <!-- Open Plans Modal -->
                    <?php if ($row_relation['status'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#plansModal">
                        Change Plan
                    </button>
                    <?php } ?>
                <?php } ?>
                <?php if ($row_relation['status'] == 1) { ?>
                    <!-- <a class="btn btn-danger btn-sm" href="cancelsuscription.php?id_relation=<?= $id_relation; ?>" role="button">Cancel Suscription</a> -->
                    <!-- Inicio Modal -->
                    <button type="button" class="btn btn-danger btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .30rem;" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $id_relation;?>">Cancel Suscription</i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?= $id_relation;?>" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteModalLabel">Cancel this service</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <a href="cancelsuscription.php?id_relation=<?= $id_relation; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i> Cancel service</a>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Modal -->
                <?php } else { ?>
                    <a class="btn btn-success btn-sm" href="resuscribe.php?id_relation=<?= $id_relation; ?>" role="button">Suscribe</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
//verificamos de que este activado
if ($row_service['type'] == 2) { ?>
<?php
$query = "SELECT * FROM servicio_opciones WHERE id = " . $row_option_service['id_option'];
$result_actual_option = mysqli_query($conexion, $query);
$row_actual_option = mysqli_fetch_array($result_actual_option);
$id_plan_actual = $row_actual_option['id'];
//echo $id_plan_actual;
?>

<!-- Close Plans Modal -->
<form action="changeplan.php" method="get">
<div class="modal fade" id="plansModal" tabindex="-1" aria-labelledby="plansModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="plansModalLabel">Your actual plan is <span class="badge bg-primary"><?= $row_actual_option['name']; ?></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <?php
                    //aca buscamos todos los planes del servicio id_service
                    $query = "SELECT * FROM servicio_opciones WHERE id_servicio = " . $row_relation['id_service'];
                    $result_all_plans = mysqli_query($conexion, $query);
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Plan</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row_all_plans = mysqli_fetch_array($result_all_plans)) {
                            ?>
                                <tr <?php echo $success = ($row_all_plans['id'] == $id_plan_actual) ? "class=\"table-success\"" : ""; ?>>
                                    <td><?= $row_all_plans['name']; ?></td>
                                    <td>$<?= $row_all_plans['price']; ?></td>
                                    <td>
                                        <!-- Select new plan -->
                                        <input type="radio" class="btn-check" name="id_new_plan" value="<?= $row_all_plans['id'];?>" id="id_plan<?= $row_all_plans['id']; ?>" autocomplete="off" <?php echo $success = ($row_all_plans['id'] == $id_plan_actual) ? "disabled" : ""; ?>>
                                        <label class="btn btn-outline-success btn-sm" for="id_plan<?= $row_all_plans['id']; ?>">Select</label>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php } ?>
<?php
include("../includes/footer.php");
?>