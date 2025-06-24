<?php
    define('APP_ROOT', true);
    require_once 'includes/config.php';
    require_once 'includes/header.php';

    $dept_no = isset($_GET['dept']) ? mysqli_real_escape_string($mysqli, $_GET['dept']) : '';

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
    <h2 id="team-heading" class="h3 mb-4">
        Équipe du département : 
        <span class="text-primary"><?= htmlspecialchars($dept_name) ?></span>
    </h2>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Genre</th>
                    <th>Date embauche</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($employee = mysqli_fetch_assoc($employees_result)): ?>
                <tr>
                    <td><?= htmlspecialchars($employee['emp_no']) ?></td>
                    <td><?= htmlspecialchars($employee['first_name']) ?></td>
                    <td><?= htmlspecialchars($employee['last_name']) ?></td>
                    <td><?= htmlspecialchars($employee['gender']) ?></td>
                    <td><?= htmlspecialchars($employee['hire_date']) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
    <nav aria-label="Navigation secondaire">
        <a href="departments.php" class="btn btn-secondary">
            ← Retour aux départements
        </a>
    </nav>
</section>

<?php
mysqli_free_result($dept_result);
mysqli_free_result($employees_result);
include 'includes/footer.php';
?>