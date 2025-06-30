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
        <?php while ($employee = mysqli_fetch_assoc($employees_result)){ ?>
        <tr>
            <td><?= $employee['emp_no'] ?></td>
            <td>
                <a href="employeesFiche.php?emp_no=<?= $employee['emp_no'] ?>&dept=<?= $dept_no ?? '' ?>">
                    <?= htmlspecialchars($employee['first_name']) ?>
                </a>
            </td>
            <td>
                <a href="employeesFiche.php?emp_no=<?= $employee['emp_no'] ?>&dept=<?= $dept_no ?? '' ?>">
                    <?= $employee['last_name'] ?>
                </a>
            </td>
            <td><?= $employee['gender'] ?></td>
            <td><?= $employee['hire_date'] ?></td>
            <td>
                <a href="employeesFiche.php?emp_no=<?= $employee['emp_no'] ?>&dept=<?= $dept_no ?? '' ?>"
                   class="btn btn-sm btn-info">
                    Fiche complète
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>