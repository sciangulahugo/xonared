<?php 
include("../includes/header.php");
require("private.php");
include("../config/db.php");
if ($_POST) {
    $service_name = $_POST['service_name'];
    $service_description = $_POST['service_description'];
    $service_price = $_POST['service_price'];
    $service_type = $_POST['service_type'];
    $query = "INSERT INTO services (name, description, price, type) VALUES ('$service_name','$service_description',$service_price,$service_type)";
    mysqli_query($conexion, $query);
    header("location:addservice.php");      
}
?>
<div class="row mt-2">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Add service:
            </div>
            <div class="card-body">
                <form action="addservice.php" method="post">
                    Service Name: <input type="text" name="service_name" class="form-control form-control-sm" placeholder="Service name..."> <br>
                    Service Price: <input type="number" name="service_price" class="form-control form-control-sm" placeholder="Service price..."> <br>
                    <textarea name="service_description" class="form-control" placeholder="Service description..."></textarea>
                    Service Type: <input type="number" name="service_type" class="form-control form-control-sm" placeholder="Service type..."> <br>
                    <input type="submit" value="Save" class="btn btn-success btn-sm">
                </form>
            </div>
            <div class="card-footer text-muted">
                ForCoderss
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = "SELECT * FROM services";
                $result = mysqli_query($conexion, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?= $row['name'];?></td>
                    <td><?= $row['description'];?></td>
                    <td><?= $row['price'];?></td>
                    <td><?= $row['type'];?></td>
                    <td>
                        <a href="editservice.php?id=<?= $row['id'];?>" class="btn btn-success btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .50rem;"><i class="bi bi-pencil"></i></a>
                        <!-- Inicio Modal -->
                        <button type="button" class="btn btn-danger btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .50rem;" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row['id'];?>"><i class="bi bi-trash3-fill"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?= $row['id'];?>" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteModalLabel">Delete <?= $row['name'];?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <a href="deleteservice.php?id=<?= $row['id'];?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i> Delete</a>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Modal -->
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
    </div>
</div>
<?php 
include("footer.php");
?>