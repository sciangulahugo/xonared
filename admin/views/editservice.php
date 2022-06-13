<?php
include("../includes/header.php");
include("../views/private.php");
include("../config/db.php");
$name = "";
$price = "";
$type = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM services WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) >= 1) {
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $type = $row['type'];
    }
}
if ($_POST) {
    $id = $_GET['id'];  
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $query = "UPDATE services SET name = '$name', description = '$description', price = $price, type = $type WHERE id = $id";
    mysqli_query($conexion, $query);
}
?>

<div class="row mt-2 justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Editar: <?= $name;?>
            </div>
            <div class="card-body">
                <form action="editservice.php?id=<?= $id;?>" method="post">
                    Service name: <input type="text" value="<?= $name;?>" name="name" class="form-control form-control-sm" placeholder="Service name..."><br>
                    Service description: <textarea name="description" class="form-control"><?= $description;?></textarea> <br>
                    Service price: <input type="text" value="<?= $price;?>" name="price" class="form-control form-control-sm"> <br>
                    Service type: <input type="number" value="<?= $type?>" name="type" class="form-control form-control-sm"> <br>
                    <input type="submit" value="Update" class="btn btn-success btn-sm">
                </form>
            </div>
            <div class="card-footer text-muted">
                ForCoderss
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <!-- MODAL -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Modal">
            Add option
        </button>
        <!-- Modal -->
        <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Add option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- FORM --> 
                <form action="addserviceopciones.php?id=<?= $_GET['id'];?>" method="post">
                    <div class="modal-body">
                        Name option: <input type="text" name="name_option" class="form-control form-control-sm" placeholder="Name option..." autofocus> <br>
                        Price option: <input type="number" name="price_option" class="form-control form-control-sm" placeholder="Price option..."> <br>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Add option</button>
                    </div>
                </form>
                <!-- FIN FORM -->
                </div>
            </div>
        </div>
        <!-- FIN MODAL -->
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>Option Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = "SELECT * FROM servicio_opciones WHERE id_servicio = $id";
                $result = mysqli_query($conexion, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?= $row['name'];?></td>
                    <td><?= $row['price']?></td>
                    <td></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
    </div>
</div>

<?php
include("../includes/footer.php");
?>