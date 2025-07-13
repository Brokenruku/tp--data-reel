<?php
    define('APP_ROOT', true);
    require_once 'includes/config.php';
    require_once 'includes/header.php';
    require_once 'includes/fonction.php';

    $dept_name = $_POST['dept_name'];

    $ok_ajoutDepartement = ajouterDeparetement($mysqli, $dept_name); 

    header("Location: departments.php?" . ($ok_ajoutDepartement ? "ok_ajoutDepartement=1" : "ok_ajoutDepartement=3"));
?>