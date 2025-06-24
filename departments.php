<?php
    define('APP_ROOT', true);
    require_once 'includes/config.php';
    require_once 'includes/header.php';

    $query = "SELECT d.dept_no, d.dept_name, 
            CONCAT(e.first_name, ' ', e.last_name) AS manager
            FROM departments d
            INNER JOIN dept_manager dm ON d.dept_no = dm.dept_no
            INNER JOIN employees e ON dm.emp_no = e.emp_no
            WHERE dm.to_date > CURDATE()";

    $result = mysqli_query($mysqli, $query);
    if (!$result) {
        die('Erreur requête: ' . mysqli_error($mysqli));
    }
?>

<section aria-labelledby="dept-heading">
    <h2 id="dept-heading" class="h3 mb-4">Liste des départements</h2>

    <table class="table table-striped">
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?= ($row['dept_no']) ?></td>
                <td><?= ($row['dept_name']) ?></td>
                <td><?= ($row['manager']) ?></td>
                <td>
                    <a href="employees.php?dept=<?= $row['dept_no'] ?>"
                       class="btn btn-sm btn-outline-primary">
                        Voir équipe
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php 
mysqli_free_result($result);
include 'includes/footer.php'; 
?>