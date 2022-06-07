<?php
include("includes/header.php");
?>

<?php if ($_SESSION['message'] != "") { ?>
<div class="alert alert-<?= $_SESSION['message_color'];?> alert-dismissible fade show" role="alert">
    <?= $_SESSION['message'];?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } 
$_SESSION['message'] = "";
?>

<?php
include("includes/footer.php");
?>