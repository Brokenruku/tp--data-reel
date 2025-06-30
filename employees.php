<?php
    define('APP_ROOT', true);
    require_once 'includes/config.php';
    require_once 'includes/header.php';

    if (isset($_GET['dept'])) {
        $dept_no = mysqli_real_escape_string($mysqli, $_GET['dept']);
    } else {
        $dept_no = '';
    }

    $dept_query = "SELECT dept_name FROM departments WHERE dept_no = '$dept_no'";
    $dept_result = mysqli_query($mysqli, $dept_query);
    $dept_name = mysqli_fetch_array($dept_result)[0];

    $employees_query = "SELECT e.emp_no, e.first_name, e.last_name, e.gender, e.hire_date
                    FROM employees e
                    INNER JOIN dept_emp de ON e.emp_no = de.emp_no
                    WHERE de.dept_no = '$dept_no' AND de.to_date > CURDATE()";

    $employees_result = mysqli_query($mysqli, $employees_query);
?>

<section aria-labelledby="team-heading">
    <a href="moteurRecherche.php" class="btn btn-secondary">
            Rechercher
        </a>

    <?php
    include 'includes/employees_table.php';
    ?>
    
    <nav aria-label="Navigation secondaire">
        <a href="departments.php" class="btn btn-secondary">
            Retour départements
        </a>
    </nav>
</section>

<?php
    mysqli_free_result($dept_result);
    mysqli_free_result($employees_result);
    include 'includes/footer.php';
?>