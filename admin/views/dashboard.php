<?php
include("../includes/header.php");
require("private.php");
include("../config/db.php");
$query = "SELECT * FROM services";
$result = mysqli_query($conexion, $query);
$num_services = mysqli_num_rows($result);
?>
<div class="row mt-2">
    <div class="col-md-3">
        <div class="card">
            <h5 class="card-header">Services</h5>
            <div class="card-body">
                <h5 class="card-title">Services avaible</h5>
                <p class="card-text">Services <span class="badge bg-success"><?= $num_services ?></span></p>
                <a href="addservice.php" class="btn btn-primary btn-sm">Manage services</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <h5 class="card-header">Users</h5>
            <div class="card-body">
                <h5 class="card-title">Users registered</h5>
                <p class="card-text">Users <span class="badge bg-success">..</span></p>
                <a href="viewusers.php" class="btn btn-primary btn-sm">See users</a>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>