<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';

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

<section aria-labelledby="team-heading">
    <h2 id="team-heading" class="h3 mb-4">
        Équipe du département : 
        <span class="text-primary"><?= htmlspecialchars($dept_name) ?></span>
    </h2>
    
    <a href="moteurRecherche.php" class="btn btn-secondary mb-3">
        Rechercher
    </a>

    <?php include 'includes/employees_table.php'; ?>
    
    <nav aria-label="Navigation secondaire" class="mt-3">
        <a href="departments.php" class="btn btn-secondary">
            Retour aux départements
        </a>
    </nav>
</section>

<?php
mysqli_free_result($employees);
include 'includes/footer.php';
?>