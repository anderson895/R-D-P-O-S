-- cashier count
SELECT COUNT(acc_type) AS count 
FROM `account` 
WHERE acc_type = 'cashier';

-- supplier count
SELECT COUNT(spl_id) AS count 
FROM `supplier` 
WHERE spl_status = 0;

-- customer count
SELECT COUNT(acc_type) AS count 
FROM `account` 
WHERE acc_type = 'customer';

-- rider count
SELECT COUNT(acc_type) AS count 
FROM `account` 
WHERE acc_type = 'deliveryStaff';
