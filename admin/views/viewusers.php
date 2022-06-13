<?php
include("../includes/header.php");
include("private.php");
include("../config/db.php");
$message = "";
$message_color = "";
$query = "SELECT name, id, rol FROM user";
$result = mysqli_query($conexion, $query);
?>
<div class="row justify-content-center">
    <h2 class="mt-2 text-center">Usuarios</h2>
    <div class="col-md-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Rol</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?= $row['id'];?></td>
                    <td><?= $row['name']; ?></td>
                    <td>
                        <?php 
                        if ($row['rol'] == 0) { 
                        $message = "User";
                        $message_color = "success";
                        } else { 
                            $message = "Admin";
                            $message_color = "danger";
                        }    
                        ?>
                        <span class="badge bg-<?= $message_color; ?>"><?= $message; ?></span>
                    </td>
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