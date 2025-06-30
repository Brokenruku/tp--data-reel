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

<div class="card shadow">
    <div class="card-header bg-gradient-primary text-white">
        <h2 class="card-title mb-0">
            <i class="fas fa-building me-2"></i>Liste des départements
        </h2>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="fw-bold">Code</th>
                    <th class="fw-bold">Département</th>
                    <th class="fw-bold">Manager</th>
                    <th class="fw-bold text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)){ ?>
                <tr class="align-middle">
                    <td><span class="badge bg-secondary"><?= ($row['dept_no']) ?></span></td>
                    <td class="fw-semibold text-primary"><?= ($row['dept_name']) ?></td>
                    <td><i class="fas fa-user me-1"></i><?= ($row['manager']) ?></td>
                    <td class="text-center">
                        <a href="employees.php?dept=<?= $row['dept_no'] ?>"
                           class="btn btn-outline-primary btn-sm rounded-pill">
                            <i class="fas fa-users me-1"></i>Voir équipe
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
mysqli_free_result($result);
include 'includes/footer.php'; 
?>