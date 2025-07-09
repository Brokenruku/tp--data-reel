<?php

function changerDeDepartement($dept_no, $new_from_date, $new_to_date, $emp_no, $mysqli) {

    $emp_check = mysqli_query($mysqli, "SELECT birth_date FROM employees WHERE emp_no = '$emp_no'");
    if (mysqli_num_rows($emp_check) === 0) return false;
    
    $emp_data = mysqli_fetch_assoc($emp_check);
    $birth_date = $emp_data['birth_date'];
    
    if ($new_from_date < $birth_date) return false;
    if ($new_to_date <= $new_from_date) return false;
    
    $update = "UPDATE dept_emp 
              SET to_date = DATE_SUB('$new_from_date', INTERVAL 1 DAY)
              WHERE emp_no = '$emp_no' AND to_date > CURDATE()";
    
    $insert = "INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date)
              VALUES ('$emp_no', '$dept_no', '$new_from_date', '$new_to_date')";
    
    return mysqli_query($mysqli, $update) && mysqli_query($mysqli, $insert);
}

function getCurrentDeptInfo($mysqli, $emp_no) {
    $query = "SELECT de.dept_no, d.dept_name, de.from_date, de.to_date 
              FROM dept_emp de
              JOIN departments d ON de.dept_no = d.dept_no
              WHERE de.emp_no = '$emp_no' AND de.to_date > CURDATE()";
    return mysqli_fetch_assoc(mysqli_query($mysqli, $query));
}

function listeDepartement($mysqli) {
    $result = mysqli_query($mysqli, "SELECT dept_name FROM departments");
    $departments = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = $row['dept_name'];
    }
    
    return $departments;
}

function transformation_enDeptNo($mysqli, $departmentName) {
    $query = "SELECT dept_no FROM departments WHERE dept_name = '" . 
             mysqli_real_escape_string($mysqli, $departmentName) . "'";
    $result = mysqli_query($mysqli, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['dept_no'];
    }
    
    return false;
}
?>