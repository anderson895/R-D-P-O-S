<?php

include('../config/config.php');
// Include the PhpSpreadsheet autoloader
require '../library/phpoffice/vendor/autoload.php';

// Replace 'your_query_here' with your actual SQL query
$sql_query = "
SELECT YEAR(order_date) AS order_year, SUM(total) AS yearly_total
FROM new_tbl_orders
GROUP BY YEAR(order_date)
ORDER BY order_year
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

    // Get today's date
    $todaydate = date('Y-m-d'); // Format as desired

    // Set headers to force download with the desired filename
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="yearly_sales_online_' . $todaydate . '.xlsx"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Pragma: public');

    // Clear the output buffer before sending the file
    if (ob_get_length()) {
        ob_end_clean();
    }

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
