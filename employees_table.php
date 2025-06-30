<table class="table table-hover">
    <thead>
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
        <?php if ($employees && mysqli_num_rows($employees) > 0) {  ?>
            <?php while ($employee = mysqli_fetch_assoc($employees)): ?>
            <tr>
                <td><?= $employee['emp_no'] ?></td>
                <td>
                    <a href="employeesFiche.php?emp_no=<?= $employee['emp_no'] ?>&dept=<?= $ancien_dept ?? '' ?>">
                        <?= ($employee['first_name']) ?>
                    </a>
                </td>
                <td>
                    <a href="employeesFiche.php?emp_no=<?= $employee['emp_no'] ?>&dept=<?= $ancien_dept ?? '' ?>">
                        <?= ($employee['last_name']) ?>
                    </a>
                </td>
                <td><?= $employee['gender'] ?></td>
                <td><?= $employee['hire_date'] ?></td>
                <td>
                    <a href="employeesFiche.php?emp_no=<?= $employee['emp_no'] ?>&dept=<?= $ancien_dept ?? '' ?>"
                       class="btn btn-sm btn-info">
                        Fiche complète
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php } else { ?>
            <tr>
                <td colspan="6" class="text-center">Aucun employé trouvé dans ce département</td>
            </tr>
        <?php } ?>
    </tbody>
</table>