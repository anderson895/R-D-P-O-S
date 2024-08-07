<?php

include('../config/config.php');
// Include the PhpSpreadsheet autoloader
require '../library/phpoffice/vendor/autoload.php';

// Get the start and end months from the POST request
$startMonth = isset($_POST['startMonth']) ? $_POST['startMonth'] : null;
$endMonth = isset($_POST['endMonth']) ? $_POST['endMonth'] : null;

// Check if startMonth and endMonth are set
if (!$startMonth || !$endMonth) {
    echo "Start month and end month are required.";
    exit;
}

// Convert 'YYYY-M' format to 'YYYY-MM' format for SQL query
$startDate = date('Y-m-01', strtotime($startMonth . '-01'));
$endDate = date('Y-m-t', strtotime($endMonth . '-01'));

// SQL query with BETWEEN clause for date filtering
$sql_query = "
SELECT DATE_FORMAT(order_date, '%Y-%m') AS order_month, SUM(total) AS monthly_total
FROM new_tbl_orders
WHERE order_date BETWEEN ? AND ?
GROUP BY DATE_FORMAT(order_date, '%Y-%m')
ORDER BY order_month;
";

// Prepare the statement
if ($stmt = $conn->prepare($sql_query)) {
    $stmt->bind_param('ss', $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();

    // Define month names
    $monthNames = [
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December'
    ];

    if ($result->num_rows > 0) {
        // Create a new PhpSpreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header title for the Excel file
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Monthly Sales Report');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14)->getColor()->setARGB('FFFFFF'); // White color font
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Apply dark blue background color to the header
        $headerTitleStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '00008B'] // Dark blue color
            ]
        ];
        $sheet->getStyle('A1:B1')->applyFromArray($headerTitleStyle);

        // Set the date range below the title
        $sheet->setCellValue('A2', 'From:');
        $sheet->setCellValue('B2', $startMonth);
        $sheet->setCellValue('A3', 'To:');
        $sheet->setCellValue('B3', $endMonth);

        // Apply blue background color to cells A2, B2, A3, B3
        $blueStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'C6DAF6'] // Light blue color
            ],
            'font' => [
                'bold' => false
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Black color for borders
                ],
            ],
        ];
        $sheet->getStyle('A2:B3')->applyFromArray($blueStyle);

        // Set column headers
        $sheet->setCellValue('A4', 'Month');
        $sheet->setCellValue('B4', 'Monthly Sales');

        // Apply blue background color to headers
        $headerStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'C6DAF6'] // Blue color
            ],
            'font' => [
                'bold' => true
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Black color for borders
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ];
        $sheet->getStyle('A4:B4')->applyFromArray($headerStyle);

        // Initialize total sales for summary
        $total_sales = 0;

        // Define blue style for monthly sales rows with borders and left alignment
        $monthlySalesStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'C6DAF6'] // Blue color
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Black color for borders
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ];

        // Fetch data and populate the spreadsheet
        $row = 5; // Start from row 5 to avoid empty row issues
        while ($row_data = $result->fetch_assoc()) {
            $monthNumber = date('m', strtotime($row_data['order_month'] . '-01'));
            $monthName = $monthNames[$monthNumber];
            $sheet->setCellValue('A' . $row, $monthName . ' ' . date('Y', strtotime($row_data['order_month'] . '-01')));
            $sheet->setCellValue('B' . $row, $row_data['monthly_total']);
            $total_sales += $row_data['monthly_total'];
            
            // Apply blue background color with borders and left alignment to the current row
            $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray($monthlySalesStyle);
            
            $row++;
        }

        // Add a summary row
        $summaryRow = $row;
        $sheet->setCellValue('A' . $summaryRow, 'Total Sales');
        $sheet->setCellValue('B' . $summaryRow, $total_sales);

        // Apply dark blue background color to the summary row and set font color to white
        $summaryStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '00008B'] // Dark blue color
            ],
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'] // White color
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Black color for borders
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ];
        $sheet->getStyle('A' . $summaryRow . ':B' . $summaryRow)->applyFromArray($summaryStyle);

        // Auto size columns to fit content
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Get today's date
        $todaydate = date('Y-m-d'); // Format as desired

        // Set headers to force download with the desired filename
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="monthly_sales_online_' . $todaydate . '.xlsx"');
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
        echo "No sales within the date range!";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Failed to prepare the SQL statement.";
}

// Close the database connection
$conn->close();
?>
