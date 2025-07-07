<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';

if (!isset($_GET['emp_no'])) {
    die("Paramètre 'emp_no' manquant !");
}
$id_emp = $_GET['emp_no'];

$result = mysqli_query($mysqli, "SELECT dept_name FROM departments");
$nomDesDept = [];

while ($row = mysqli_fetch_assoc($result)) {
    $nomDesDept[] = $row['dept_name'];
}
?>

<form action="ChangeDeptMethode.php?id_emp=<?= $id_emp ?>" method="post">
    <label for="nvDept">Votre nouveau département</label>
    <select name="nvDept" id="nvDept">
        <?php foreach ($nomDesDept as $dept) { ?>
            <option value="<?= $dept ?>"><?= $dept ?></option>
        <?php } ?>
    </select>

    <label for="nouvelle_date">Date de commencement</label>
    <input type="text" id="nouvelle_date" name="nouvelle_date"><br>
    <input type="submit" value="Valider">
</form>

<?php include 'includes/footer.php'; ?>
