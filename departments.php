<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/fonction.php';
$query = "SELECT d.dept_no, d.dept_name, 
            IFNULL(CONCAT(e.first_name, ' ', e.last_name), 'Pas de manager') AS manager,
            COUNT(DISTINCT de.emp_no) AS nb_employes
          FROM departments d
          LEFT JOIN dept_manager dm ON d.dept_no = dm.dept_no AND dm.to_date > CURDATE()
          LEFT JOIN employees e ON dm.emp_no = e.emp_no
          LEFT JOIN dept_emp de ON d.dept_no = de.dept_no AND de.to_date > CURDATE()
          GROUP BY d.dept_no, d.dept_name, manager
          ORDER BY d.dept_no ASC";

$result = mysqli_query($mysqli, $query);
?>

<form action="ajoutDepartement.php">
    <input type="submit" value="modifier un departments" class="btn btn-warning btn-sm">
</form>

<div class="card shadow">
    <div class="card-header bg-gradient-primary text-black">
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
                    <th class="fw-bold">Nombre employés</th>
                    <th class="fw-bold text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr class="align-middle">
                        <td><span class="badge bg-secondary"><?= ($row['dept_no']) ?></span></td>
                        <td class="fw-semibold text-primary"><?= ($row['dept_name']) ?></td>
                        <td><i class="fas fa-user me-1"></i><?= ($row['manager']) ?></td>
                        <td><span class="badge bg-info"><?= $row['nb_employes'] ?></span></td>
                        <td class="text-center">
                            <a href="employees.php?dept=<?= $row['dept_no'] ?>"
                                class="btn btn-outline-primary btn-sm rounded-pill">
                                <i class="fas fa-users me-1"></i>Voir équipe
                            </a>
                        </td>
                        <td>
                            <form action="modulationDept.php" method="post">
                                <input type="hidden" name="dept_no" value="<?= htmlspecialchars($row['dept_no']) ?>">
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Modifier
                                </button>
                            </form>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    <a href="stats_emplois.php" class="btn btn-success rounded-pill">
        <i class="fas fa-chart-bar me-1"></i>Statistiques par emploi
    </a>
</div>

<?php
mysqli_free_result($result);
include 'includes/footer.php';
?>