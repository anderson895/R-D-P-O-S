<?php

include('../../config/config.php');
// Include the PhpSpreadsheet autoloader
require 'vendor/autoload.php';

// Replace 'your_query_here' with your actual SQL query
$sql_query = "
SELECT 
    *
FROM
    pos_orders AS t
JOIN
    product AS p
ON
    t.orders_prod_id = p.prod_id
JOIN
    account AS a
ON
    t.orders_user_id = a.acc_id;
";
$result = $conn->query($sql_query);

if ($result->num_rows > 0) {
    // Create a new PhpSpreadsheet object
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Fetch column names and populate the first row of the spreadsheet
    $col = 1;
    while ($column = $result->fetch_field()) {
        $sheet->setCellValueByColumnAndRow($col, 1, $column->name);
        $col++;
    }

    // Fetch data and populate the subsequent rows of the spreadsheet
    $row = 2;
    while ($row_data = $result->fetch_assoc()) {
        $col = 1;
        foreach ($row_data as $value) {
            $sheet->setCellValueByColumnAndRow($col, $row, $value);
            $col++;
        }
        $row++;
    }

    // Set headers to force download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="export.xlsx"');
    header('Cache-Control: max-age=0');

    // Clear the output buffer before sending the file
    ob_end_clean();

    // Save the spreadsheet to a PHP output object (in-memory)
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');

    // Flush the output buffer and send the Excel file to the browser
    flush();
} else {
    echo "No results found";
}

// Close the database connection
$conn->close();
?>
