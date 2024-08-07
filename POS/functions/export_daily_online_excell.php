<?php

include('../config/config.php');
// Include the PhpSpreadsheet autoloader
require '../library/phpoffice/vendor/autoload.php';

// Get the start and end dates from the POST request
$start_date = isset($_POST['startDate']) ? $_POST['startDate'] : null;
$end_date = isset($_POST['endDate']) ? $_POST['endDate'] : null;

// Check if start_date and end_date are set
if (!$start_date || !$end_date) {
    echo "Start date and end date are required.";
    exit;
}

// SQL query with BETWEEN clause for date filtering
$sql_query = "
SELECT DATE(order_date) AS order_date, SUM(total) AS daily_total
FROM new_tbl_orders
WHERE DATE(order_date) BETWEEN ? AND ?
GROUP BY DATE(order_date)
ORDER BY order_date
";

// Prepare the statement
if ($stmt = $conn->prepare($sql_query)) {
    $stmt->bind_param('ss', $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Create a new PhpSpreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header title for the Excel file
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Daily Sales Report');
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
        $sheet->setCellValue('B2', $start_date);
        $sheet->setCellValue('A3', 'To:');
        $sheet->setCellValue('B3', $end_date);

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
        $sheet->setCellValue('A4', 'Date');
        $sheet->setCellValue('B4', 'Daily Sales');

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

        // Define blue style for daily sales rows with borders and left alignment
        $dailySalesStyle = [
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
            $sheet->setCellValue('A' . $row, $row_data['order_date']);
            $sheet->setCellValue('B' . $row, $row_data['daily_total']);
            $total_sales += $row_data['daily_total'];
            
            // Apply blue background color with borders and left alignment to the current row
            $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray($dailySalesStyle);
            
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
        header('Content-Disposition: attachment;filename="daily_sales_online_' . $todaydate . '.xlsx"');
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
