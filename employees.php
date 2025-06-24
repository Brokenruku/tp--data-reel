<?php
    define('APP_ROOT', true);
    require_once 'includes/config.php';
    require_once 'includes/header.php';

    $dept_no = isset($_GET['dept']) ? mysqli_real_escape_string($mysqli, $_GET['dept']) : '';

    $dept_name = mysqli_fetch_array(mysqli_query($mysqli, 
        "SELECT dept_name FROM departments WHERE dept_no = '$dept_no'"));
    $dept_name = $dept_name[0];
?>

<section aria-labelledby="team-heading">
    <h2 id="team-heading" class="h3 mb-4">
        Équipe du département : 
        <span class="text-primary"><?= $dept_name ?></span>
    </h2>
    
    <?php
    $result = mysqli_query($mysqli,
        "SELECT e.emp_no, e.first_name, e.last_name, e.gender, e.hire_date
         FROM employees e
         INNER JOIN dept_emp de ON e.emp_no = de.emp_no
         WHERE de.dept_no = '$dept_no' AND de.to_date > CURDATE()");
    ?>
    
    <div class="table-responsive">
        <table class="table table-hover">
        </table>
    </div>
    
    <nav aria-label="Navigation secondaire">
        <a href="departments.php" class="btn btn-secondary">
            ← Retour  departements
        </a>
    </nav>
</section>

<?php 
    mysqli_free_result($result);
    include 'includes/footer.php'; 
?>