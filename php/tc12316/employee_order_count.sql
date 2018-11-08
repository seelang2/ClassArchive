# 
#
#
#
SELECT 
	employees.last_name as employeeln,
    employees.first_name as employeefn,
    count(orders.order_date) as ordercount
FROM
	employees
LEFT JOIN
	orders
ON employees.id = orders.employee_id
GROUP BY employees.id

