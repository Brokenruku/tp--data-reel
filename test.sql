UPDATE dept_emp
SET dept_no = '$dept_no_Vaovao' , from_date = 'nouvele_date'
WHERE emp_no = '$id_emp';

SELECT dept_name FROM departments WHERE dept_no == '$dept_no';
//mbola tsisy anl date de fin