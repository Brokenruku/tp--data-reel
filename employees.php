<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/fonction.php';

$dept_no = isset($_GET['dept']) ? mysqli_real_escape_string($mysqli, $_GET['dept']) : '';

$dept_name = mysqli_fetch_array(mysqli_query($mysqli, 
    "SELECT dept_name FROM departments WHERE dept_no = '$dept_no'"))[0];

$employees = mysqli_query($mysqli,
    "SELECT e.emp_no, e.first_name, e.last_name, e.gender, e.hire_date
     FROM employees e
     INNER JOIN dept_emp de ON e.emp_no = de.emp_no
     WHERE de.dept_no = '$dept_no' AND de.to_date > CURDATE()");

$ancien_dept = $dept_no;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-primary mb-1">
            <i class="fas fa-users me-2"></i>Équipe du département
        </h2>
        <h3 class="h4 text-muted">
            <i class="fas fa-building me-1"></i><?= htmlspecialchars($dept_name) ?>
        </h3>
    </div>
    <a href="moteurRecherche.php" class="btn btn-outline-success rounded-pill">
        <i class="fas fa-search me-1"></i>Rechercher
    </a>
</div>

<div class="card shadow-lg">
    <div class="card-body p-0">
        <?php include 'includes/employees_table.php'; ?>
    </div>
</div>

<div class="mt-4">
    <a href="departments.php" class="btn btn-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i>Retour aux départements
    </a>
</div>

<?php
include 'includes/footer.php';
?>