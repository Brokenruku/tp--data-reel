<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/fonction.php';

$emp_no = $_GET['emp_no'] ?? '';
$current_info = getCurrentDeptInfo($mysqli, $emp_no);
$departments = listeDepartement($mysqli);

$min_to_date = $current_info['from_date'] ?? '';
if ($min_to_date) {
    $min_to_date = date('Y-m-d', strtotime($min_to_date . ' +1 day'));
}
?>

<form action="ChangeDeptMethode.php" method="post">
    <input type="hidden" name="id_emp" value="<?= ($emp_no) ?>">
    
    <div class="mb-3">
        <label class="form-label">Département actuel</label>
        <input type="text" class="form-control" 
               value="<?= ($current_info['dept_name'] ?? '') ?>" readonly>
        <input type="hidden" name="current_dept" value="<?= ($current_info['dept_no'] ?? '') ?>">
    </div>
    
    <div class="mb-3">
        <label class="form-label">Période actuelle</label>
        <div class="input-group">
            <input type="date" class="form-control" 
                   value="<?= ($current_info['from_date'] ?? '') ?>" readonly>
            <span class="input-group-text">à</span>
            <input type="date" class="form-control" 
                   value="<?= ($current_info['to_date'] ?? '') ?>" readonly>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="nvDept" class="form-label">Nouveau département</label>
        <select name="nvDept" id="nvDept" class="form-select" required>
            <?php foreach ($departments as $dept_no => $dept_name): ?>
                <option value="<?= ($dept_no) ?>" 
                    <?= ($dept_no === ($current_info['dept_no'] ?? '')) ? 'selected' : '' ?>>
                    <?= ($dept_name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="new_from_date" class="form-label">Nouvelle date de début</label>
        <input type="date" name="new_from_date" id="new_from_date" 
               class="form-control" 
               min="<?= ($current_info['from_date'] ?? '') ?>" 
               required>
    </div>
    
    <div class="mb-3">
        <label for="new_to_date" class="form-label">Nouvelle date de fin</label>
        <input type="date" name="new_to_date" id="new_to_date" 
               class="form-control" 
               min="<?= ($min_to_date) ?>" 
               required>
        <small class="text-muted">Utilisez 9999-01-01 pour une date indéterminée</small>
    </div>
    
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Enregistrer
        </button>
    </div>
</form>

<?php include 'includes/footer.php'; ?>