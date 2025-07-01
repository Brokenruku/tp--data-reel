-- Create a view for current employees with their job and salary info
CREATE VIEW current_employees AS
SELECT 
    e.emp_no,
    e.first_name,
    e.last_name,
    e.gender,
    e.hire_date,
    e.birth_date,
    t.title,
    s.salary,
    d.dept_no,
    d.dept_name
FROM employees e
JOIN titles t ON e.emp_no = t.emp_no AND t.to_date > CURDATE()
JOIN salaries s ON e.emp_no = s.emp_no AND s.to_date > CURDATE()
JOIN dept_emp de ON e.emp_no = de.emp_no AND de.to_date > CURDATE()
JOIN departments d ON de.dept_no = d.dept_no;