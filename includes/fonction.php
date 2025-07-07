<?php
    define('APP_ROOT', true);

    function changerDeDepartement($dept_no_Vaovao, $nouvelle_date , $id_emp, $mysqli){
        mysqli_query($mysqli, "
            UPDATE dept_emp
            SET dept_no = '$dept_no_Vaovao', from_date = '$nouvelle_date'
            WHERE emp_no = '$id_emp';
        ");
    }
?>