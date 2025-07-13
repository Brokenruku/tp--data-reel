<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/fonction.php';

$dept_name = $_POST['dept_name'];
$dept_no = $_POST['dept_no'];
$ok_Modification = modifierDepartement($mysqli, $dept_name, $dept_no);

header("Location: departments.php?" . ($ok_Modification ? "ok_Modification=1" : "ok_Modification=3"));

?>