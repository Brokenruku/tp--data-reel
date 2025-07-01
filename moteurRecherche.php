<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';

$limit = 20;
$page = max(1, intval($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

$dept = mysqli_real_escape_string($mysqli, $_GET['dept'] ?? '');
$name = mysqli_real_escape_string($mysqli, $_GET['name'] ?? '');
$age_min = intval($_GET['age_min'] ?? 0);
$age_max = intval($_GET['age_max'] ?? 0);

$where = ["de.to_date > CURDATE()"];
if ($dept) $where[] = "de.dept_no = '$dept'";
if ($name) $where[] = "(e.first_name LIKE '%$name%' OR e.last_name LIKE '%$name%')";
if ($age_min) $where[] = "TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) >= $age_min";
if ($age_max) $where[] = "TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) <= $age_max";

$where_sql = "WHERE " . implode(" AND ", $where);

$total = mysqli_fetch_assoc(mysqli_query($mysqli,
    "SELECT COUNT(*) AS total FROM employees e 
     JOIN dept_emp de ON e.emp_no = de.emp_no $where_sql"))['total'];
$pages = ceil($total / $limit);

$employees = mysqli_query($mysqli,
    "SELECT e.emp_no, e.first_name, e.last_name, e.gender, e.hire_date 
     FROM employees e 
     JOIN dept_emp de ON e.emp_no = de.emp_no 
     $where_sql ORDER BY e.last_name LIMIT $limit OFFSET $offset");

$depts = mysqli_query($mysqli, "SELECT dept_no, dept_name FROM departments ORDER BY dept_name");
?>

<div class="card shadow mb-4">
    <div class="card-header bg-gradient-success text-black">
        <h2 class="card-title mb-0">
            <i class="fas fa-search me-2"></i>Moteur de recherche employés
        </h2>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-3">
                <label class="form-label fw-bold">Département</label>
                <select name="dept" class="form-select">
                    <option value="">Tous les départements</option>
                    <?php while ($d = mysqli_fetch_assoc($depts)): ?>
                        <option value="<?= $d['dept_no'] ?>" <?= $dept === $d['dept_no'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($d['dept_name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-3">
                <label class="form-label fw-bold">Nom</label>
                <input type="text" name="name" class="form-control" placeholder="Rechercher par nom" value="<?= htmlspecialchars($name) ?>">
            </div>
            <div class="col-2">
                <label class="form-label fw-bold">Âge minimum</label>
                <input type="number" name="age_min" class="form-control" placeholder="Min" value="<?= $age_min ?>">
            </div>
            <div class="col-2">
                <label class="form-label fw-bold">Âge maximum</label>
                <input type="number" name="age_max" class="form-control" placeholder="Max" value="<?= $age_max ?>">
            </div>
            <div class="col-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-search me-1"></i>Rechercher
                </button>
                <a href="moteurRecherche.php" class="btn btn-outline-secondary">
                    <i class="fas fa-redo me-1"></i>Reset
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow">
    <div class="card-body p-0">
        <?php include 'includes/employees_table.php'; ?>
    </div>
</div>

<?php if ($pages > 1): ?>
<nav class="mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <?php if ($page > 1): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-1"></i>Précédent
            </a>
        <?php else: ?>
            <span></span>
        <?php endif; ?>

        <span class="badge bg-primary fs-6">Page <?= $page ?> / <?= $pages ?></span>

        <?php if ($page < $pages): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" class="btn btn-outline-primary">
                Suivant<i class="fas fa-arrow-right ms-1"></i>
            </a>
        <?php else: ?>
            <span></span>
        <?php endif; ?>
    </div>
</nav>
<?php endif; ?>

<div class="mt-4">
    <a href="departments.php" class="btn btn-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i>Retour aux départements
    </a>
</div>

<?php
mysqli_free_result($employees);
mysqli_free_result($depts);
include 'includes/footer.php';
?>