<?php
    define('APP_ROOT', true);
    require_once 'includes/config.php';
    require_once 'includes/header.php';

    $id_emp = $_GET['emp_no'];
    $dept_no_Vaovao = $_POST['nvDept'];
    $nouvelle_date =$_POST['nouvelle_date'];
    changerDeDepartement($dept_no_Vaovao, $nouvelle_date , $id_emp, $mysqli);

    header("Location: employeesFiche.php");
?>
