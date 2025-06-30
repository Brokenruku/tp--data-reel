<?php

if (!defined('APP_ROOT')) {
    die('Accès direct interdit');
}
?>

<table class="table table-hover mb-0">
    <thead class="table-dark">
        <tr>
            <th class="fw-bold">ID</th>
            <th class="fw-bold">Prénom</th>
            <th class="fw-bold">Nom</th>
            <th class="fw-bold text-center">Genre</th>
            <th class="fw-bold">Date embauche</th>
            <th class="fw-bold text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($employees) > 0): ?>
            <?php while ($employee = mysqli_fetch_assoc($employees)): ?>
            <tr class="align-middle">
                <td><span class="badge bg-secondary"><?= htmlspecialchars($employee['emp_no']) ?></span></td>
                <td class="fw-semibold text-primary"><?= htmlspecialchars($employee['first_name']) ?></td>
                <td class="fw-semibold"><?= htmlspecialchars($employee['last_name']) ?></td>
                <td class="text-center">
                    <span class="badge <?= $employee['gender'] == 'M' ? 'bg-info' : 'bg-warning' ?>">
                        <?= htmlspecialchars($employee['gender']) ?>
                    </span>
                </td>
                <td><small class="text-muted"><?= htmlspecialchars($employee['hire_date']) ?></small></td>
                <td class="text-center">
                    <a href="employeesFiche.php?emp_no=<?= $employee['emp_no'] ?>" class="btn btn-outline-primary btn-sm rounded-pill">
                        <i class="fas fa-eye me-1"></i>Voir fiche
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center text-muted py-4">
                    <i class="fas fa-users-slash fs-1 mb-2 d-block"></i>
                    Aucun employé trouvé.
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>