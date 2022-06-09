<?php 
include("header.php");
include("../config/db.php");
if ($_POST) {
    $service_name = $_POST['service_name'];
    $service_price = $_POST['service_price'];
    $service_type = $_POST['service_type'];
    $query = "INSERT INTO services (name, price, type) VALUES ('$service_name',$service_price,$service_type)";
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
                    <td><?= $row['price'];?></td>
                    <td><?= $row['type'];?></td>
                    <td><a href="editservice.php?id=<?= $row['id'];?>" class="btn btn-success btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .50rem;"><i class="bi bi-pencil"></i></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
    </div>
</div>
<?php 
include("footer.php");
?>