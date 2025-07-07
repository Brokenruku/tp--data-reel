<?php
    define('APP_ROOT', true);
    require_once 'includes/config.php';
    require_once 'includes/header.php';

    $id_emp = $_GET['emp_no'];

?>
    <from action="ChangeDeptMethode.php?id_emp=<?= $id_emp ?>" method="post">
        <label for="nvDept">Votre nouveau departments</label>
        <input type="text" id="nvDept" name="nvDept"> <br>

        <label for="nouvelle_date">Date de commencement</label>
        <input type="text" id="nouvelle_date" name="nouvelle_date"> <br>
    </from>
<?php
include 'includes/footer.php';
?>