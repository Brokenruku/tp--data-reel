<?php

if (!defined('APP_ROOT')) {
    die('Accès direct interdit');
}
?>

<?php if (isset($dept_name) && !empty($dept_name)): ?>
<h2 id="team-heading" class="h3 mb-4">
    Équipe du département : 
    <span class="text-primary"><?= htmlspecialchars($dept_name) ?></span>
</h2>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Genre</th>
                <th>Date embauche</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($employees) > 0): ?>
                <?php while ($employee = mysqli_fetch_assoc($employees)): ?>
                <tr>
                    <td><?= htmlspecialchars($employee['emp_no']) ?></td>
                    <td><?= htmlspecialchars($employee['first_name']) ?></td>
                    <td><?= htmlspecialchars($employee['last_name']) ?></td>
                    <td><?= htmlspecialchars($employee['gender']) ?></td>
                    <td><?= htmlspecialchars($employee['hire_date']) ?></td>
                    <td><a href="employeesFiche.php?emp_no=<?= $employee['emp_no'] ?>" class="btn btn-secondary">voir la fiche</a></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Aucun employé trouvé.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>