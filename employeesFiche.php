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
?>

<section class="employee-detail">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><?= htmlspecialchars($employee['first_name'].' '.$employee['last_name']) ?></h2>
            <p><strong>ID:</strong> <?= $employee['emp_no'] ?></p>
            <p><strong>Département:</strong> <?= $anci_dept['dept_name'] ?? 'N/A' ?></p>
        </div>
        <div class="col-md-6">
            <p><strong>Genre:</strong> <?= $employee['gender'] ?></p>
            <p><strong>Naissance:</strong> <?= $employee['birth_date'] ?></p>
            <p><strong>Embauche:</strong> <?= $employee['hire_date'] ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Historique des salaires
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <?php while ($s = mysqli_fetch_assoc($salaries)){ ?>
                        <tr>
                            <td><?= $s['from_date'] ?> à <?= $s['to_date'] ?></td>
                            <td><?= number_format($s['salary'], 0, ',', ' ') ?> €</td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Historique des postes
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <?php while ($title = mysqli_fetch_assoc($titles)){ ?>
                        <tr>
                            <td><?= $title['from_date'] ?> à <?= $title['to_date'] ?></td>
                            <td><?= $title['title'] ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="employees.php?dept=<?= $dept_no ?>" class="btn btn-secondary">
            Retour équipe
        </a>
        <a href="departments.php" class="btn btn-outline-secondary">
            Tous les départements
        </a>
    </div>
</section>

<?php
mysqli_free_result($salaries);
mysqli_free_result($titles);
include 'includes/footer.php';
?>