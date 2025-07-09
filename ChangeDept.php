<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';
include 'includes/fonction.php'; 

if (!isset($_GET['emp_no'])) {
    die("Paramètre 'emp_no' manquant !");
}
$id_emp = $_GET['emp_no'];

$nomDesDept = [];

$nomDesDept = listeDepartement($mysqli);
?>

<form action="ChangeDeptMethode.php?id_emp=<?= $id_emp ?>" method="post">
    <label for="nvDept">Votre nouveau département</label>
    <select name="nvDept" id="nvDept">
        <?php for ($i = 0; $i < count($nomDesDept); $i++) { ?>
            <option value="<?= ($nomDesDept[$i]) ?>"><?= ($nomDesDept[$i]) ?></option>
        <?php } ?>
    </select>

    <label for="nouvelle_date">Date de commencement</label>
    <input type="text" id="nouvelle_date" name="nouvelle_date"><br>
    <input type="submit" value="Valider">
</form>

<?php include 'includes/footer.php'; ?>
