<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/fonction.php';

$id_emp = $_POST['id_emp'] ?? '';
$dept_no = $_POST['nvDept'] ?? '';
$new_from_date = $_POST['new_from_date'] ?? '';
$new_to_date = $_POST['new_to_date'] ?? '';
$current_dept = $_POST['current_dept'] ?? '';

if (empty($id_emp) || empty($dept_no) || empty($new_from_date) || empty($new_to_date)) {
    header("Location: employeesFiche.php?emp_no=$id_emp&error=1");
    exit;
}

if ($dept_no === $current_dept && $new_from_date === $current_info['from_date']) {
    header("Location: employeesFiche.php?emp_no=$id_emp&error=2");
    exit;
}

$success = changerDeDepartement($dept_no, $new_from_date, $new_to_date, $id_emp, $mysqli);

header("Location: employeesFiche.php?emp_no=$id_emp&" . ($success ? "success=1" : "error=3"));

?>