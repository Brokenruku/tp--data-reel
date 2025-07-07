<?php
    define('APP_ROOT', true);
    require_once 'includes/config.php';
    require_once 'includes/header.php';

    $id_emp = $_GET['emp_no'];

    changerDeDepartement($dept_no_Vaovao, $nouvelle_date , $id_emp, $mysqli);
?>

<?php
include 'includes/footer.php';
?>