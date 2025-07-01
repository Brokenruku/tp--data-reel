<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';

$query = "SELECT t.title,
          COUNT(CASE WHEN e.gender = 'M' THEN 1 END) AS nb_hommes,
          COUNT(CASE WHEN e.gender = 'F' THEN 1 END) AS nb_femmes,
          COUNT(*) AS total_employes,
          AVG(s.salary) AS salaire_moyen
          FROM titles t
          JOIN employees e ON t.emp_no = e.emp_no
          JOIN salaries s ON e.emp_no = s.emp_no
          WHERE t.to_date > CURDATE() AND s.to_date > CURDATE()
          GROUP BY t.title
          ORDER BY t.title";

$result = mysqli_query($mysqli, $query);
if (!$result) {
    die('Erreur requête: ' . mysqli_error($mysqli));
}
?>

<div class="card shadow">
    <div class="card-header bg-gradient-success text-black">
        <h2 class="card-title mb-0">
            <i class="fas fa-chart-bar me-2"></i>Statistiques par emploi
        </h2>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="fw-bold">Emploi</th>
                    <th class="fw-bold text-center">Hommes</th>
                    <th class="fw-bold text-center">Femmes</th>
                    <th class="fw-bold text-center">Total</th>
                    <th class="fw-bold text-end">Salaire moyen</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)){ ?>
                <tr class="align-middle">
                    <td class="fw-semibold text-primary"><?= htmlspecialchars($row['title']) ?></td>
                    <td class="text-center"><span class="badge bg-primary"><?= $row['nb_hommes'] ?></span></td>
                    <td class="text-center"><span class="badge bg-pink"><?= $row['nb_femmes'] ?></span></td>
                    <td class="text-center"><span class="badge bg-secondary"><?= $row['total_employes'] ?></span></td>
                    <td class="text-end fw-bold text-success"><?= number_format($row['salaire_moyen'], 0, ',', ' ') ?> €</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    <a href="departments.php" class="btn btn-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i>Retour aux départements
    </a>
</div>

<?php 
mysqli_free_result($result);
include 'includes/footer.php'; 
?>