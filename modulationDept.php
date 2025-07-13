<?php
    define('APP_ROOT', true);
    require_once 'includes/config.php';
    require_once 'includes/header.php';
    require_once 'includes/fonction.php';

    if (!isset($_POST['dept_no'])) {
        die("Paramètre dept_no manquant");
    }

    $dept_no = mysqli_real_escape_string($mysqli, $_POST['dept_no']);
    $dept_name = getDepartement($mysqli, $dept_no);

    if (!$dept_name) {
        die("Département non trouvé");
    }
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Modification du département</h3>
        </div>
        <div class="card-body">
            <form action="modulationDeptMethod.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Code département</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($dept_no) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ancien Nom du département</label>
                    <input type="text" class="form-control" name="dept_name" 
                           value="<?= htmlspecialchars($dept_name) ?>">
                </div>
                <input type="hidden" name="dept_no" value="<?= htmlspecialchars($dept_no) ?>">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>