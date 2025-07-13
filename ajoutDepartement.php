<?php
    define('APP_ROOT', true);
    require_once 'includes/config.php';
    require_once 'includes/header.php';
    require_once 'includes/fonction.php';
?>
    <form action="ajoutDepartementMethod.php" method="post">
        <label for="dept_name">nom du Departement</label>
        <input type="text" name="dept_name" class="form-control form-control-lg rounded-pill shadow-sm" required>
        <input type="submit" value="enregistrer" class="btn btn-warning btn-sm">
    </form>
<?php
include 'includes/footer.php';
?>