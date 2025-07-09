<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/fonction.php';

$id_emp = isset($_GET['id_emp']) ? $_GET['id_emp'] : '';
$dept_name = isset($_POST['nvDept']) ? $_POST['nvDept'] : '';
$nouvelle_date = isset($_POST['nouvelle_date']) ? $_POST['nouvelle_date'] : '';

$dept_no = transformation_enDeptNo($mysqli, $dept_name);

if ($dept_no && changerDeDepartement($dept_no, $nouvelle_date, $id_emp, $mysqli)) {
    header("Location: employeesFiche.php?emp_no=$id_emp&success=1");
} else {
    header("Location: employeesFiche.php?emp_no=$id_emp&error=1");
}
exit;
?>