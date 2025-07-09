<?php

function changerDeDepartement($dept_no_Vaovao, $nouvelle_date, $id_emp, $mysqli) {
    
    if (empty($dept_no_Vaovao) || empty($nouvelle_date) || empty($id_emp)) {
        return false;
    }

    $update_query = "UPDATE dept_emp 
                    SET to_date = DATE_SUB('$nouvelle_date', INTERVAL 1 DAY)
                    WHERE emp_no = '$id_emp' AND to_date > CURDATE()";
    
    if (!mysqli_query($mysqli, $update_query)) {
        return false;
    }

    $insert_query = "INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date)
                    VALUES ('$id_emp', '$dept_no_Vaovao', '$nouvelle_date', '9999-01-01')";
    
    return mysqli_query($mysqli, $insert_query);
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