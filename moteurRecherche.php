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

// Total count
$total = mysqli_fetch_assoc(mysqli_query($mysqli,
    "SELECT COUNT(*) AS total FROM employees e 
     JOIN dept_emp de ON e.emp_no = de.emp_no $where_sql"))['total'];
$pages = ceil($total / $limit);

// Employee data
$employees = mysqli_query($mysqli,
    "SELECT e.emp_no, e.first_name, e.last_name, e.gender, e.hire_date 
     FROM employees e 
     JOIN dept_emp de ON e.emp_no = de.emp_no 
     $where_sql ORDER BY e.last_name LIMIT $limit OFFSET $offset");

// Departement
$depts = mysqli_query($mysqli, "SELECT dept_no, dept_name FROM departments ORDER BY dept_name");
?>

<h2>Moteur de recherche employés</h2>
<form method="GET">
    <select name="dept">
        <option value="">Tous</option>
        <?php while ($d = mysqli_fetch_assoc($depts)): ?>
            <option value="<?= $d['dept_no'] ?>" <?= $dept === $d['dept_no'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($d['dept_name']) ?>
            </option>
        <?php endwhile; ?>
    </select>
    <input type="text" name="name" placeholder="Nom" value="<?= htmlspecialchars($name) ?>">
    <input type="number" name="age_min" placeholder="Âge min" value="<?= $age_min ?>">
    <input type="number" name="age_max" placeholder="Âge max" value="<?= $age_max ?>">
    <button type="submit">Rechercher</button>
    <a href="moteurRecherche.php">Reset</a>
</form>

<p><strong><?= $total ?></strong> résultat(s) – Page <?= $page ?>/<?= $pages ?></p>

<?php include 'includes/employees_table.php'; ?>

<?php if ($pages > 1): ?>
<nav>


    <?php if ($page > 1): ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>">← Précédent</a>
    <?php endif; ?>

    <?php if ($page < $pages): ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>">Suivant →</a>
    <?php endif; ?>
    
</nav>
<?php endif; ?>

<a href="departments.php">← Retour</a>

<?php
mysqli_free_result($employees);
mysqli_free_result($depts);
include 'includes/footer.php';
?>
