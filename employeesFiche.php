<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';

$emp_no = (int)($_GET['emp_no'] ?? 0);
$dept_no = $_GET['dept'] ?? '';

$employee = mysqli_fetch_assoc(mysqli_query($mysqli, 
    "SELECT * FROM employees WHERE emp_no = $emp_no"));

$salaries = mysqli_query($mysqli,
    "SELECT * FROM salaries WHERE emp_no = $emp_no ORDER BY from_date DESC");

$titles = mysqli_query($mysqli,
    "SELECT * FROM titles WHERE emp_no = $emp_no ORDER BY from_date DESC");

$anci_dept = mysqli_fetch_assoc(mysqli_query($mysqli,
    "SELECT d.dept_name FROM departments d
     JOIN dept_emp de ON d.dept_no = de.dept_no
     WHERE de.emp_no = $emp_no AND de.to_date > CURDATE()"));

$longest_job = mysqli_fetch_assoc(mysqli_query($mysqli,
    "SELECT title, 
     DATEDIFF(CASE WHEN to_date = '9999-01-01' THEN CURDATE() ELSE to_date END, from_date) AS duree_jours,
     from_date, to_date
     FROM titles 
     WHERE emp_no = $emp_no 
     ORDER BY duree_jours DESC 
     LIMIT 1"));
?>

<div class="card shadow-lg mb-4">
    <div class="card-header bg-gradient-primary" style="color: purple;">
        <h2 class="card-title mb-0">
            <i class="fas fa-user-circle me-2"></i><?= htmlspecialchars($employee['first_name'].' '.$employee['last_name']) ?>
        </h2>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <p><strong><i class="fas fa-id-badge me-2 text-primary"></i>ID:</strong> <span class="badge bg-secondary"><?= $employee['emp_no'] ?></span></p>
                <p><strong><i class="fas fa-building me-2 text-primary"></i>Département:</strong> <?= $anci_dept['dept_name'] ?? 'N/A' ?></p>
                <?php if ($longest_job): ?>
                <p><strong><i class="fas fa-clock me-2 text-primary"></i>Emploi le plus long:</strong> 
                   <span class="badge bg-warning text-dark"><?= htmlspecialchars($longest_job['title']) ?></span>
                   <small class="text-muted">(<?= round($longest_job['duree_jours'] / 365, 1) ?> ans)</small>
                </p>
                <?php endif; ?>
            </div>
            <div class="col-6">
                <p><strong><i class="fas fa-venus-mars me-2 text-primary"></i>Genre:</strong> <?= $employee['gender'] ?></p>
                <p><strong><i class="fas fa-birthday-cake me-2 text-primary"></i>Naissance:</strong> <?= $employee['birth_date'] ?></p>
                <p><strong><i class="fas fa-calendar-plus me-2 text-primary"></i>Embauche:</strong> <?= $employee['hire_date'] ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="card shadow h-100">
            <div class="card-header bg-success text-white d-flex align-items-center">
                <i class="fas fa-euro-sign me-2"></i>
                <h5 class="mb-0">Historique des salaires</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-white">Période</th>
                            <th class="text-white text-end">Salaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($s = mysqli_fetch_assoc($salaries)){ ?>
                        <tr>
                            <td><small class="text-muted"><?= $s['from_date'] ?> à <?= $s['to_date'] ?></small></td>
                            <td class="fw-bold text-success text-end"><?= number_format($s['salary'], 0, ',', ' ') ?> €</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card shadow h-100">
            <div class="card-header bg-info text-white d-flex align-items-center">
                <i class="fas fa-briefcase me-2"></i>
                <h5 class="mb-0">Historique des postes</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-white">Période</th>
                            <th class="text-white">Poste</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($title = mysqli_fetch_assoc($titles)){ ?>
                        <tr>
                            <td><small class="text-muted"><?= $title['from_date'] ?> à <?= $title['to_date'] ?></small></td>
                            <td><span class="badge bg-info"><?= $title['title'] ?></span></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <a href="employees.php?dept=<?= $dept_no ?>" class="btn btn-primary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i>Retour équipe
    </a>
    <a href="departments.php" class="btn btn-outline-secondary rounded-pill">
        <i class="fas fa-building me-1"></i>Tous les départements
    </a>
</div>

<?php
mysqli_free_result($salaries);
mysqli_free_result($titles);
include 'includes/footer.php';
?>