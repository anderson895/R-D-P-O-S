<?php
include ('../config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $pcode = $_GET["product_code"];

    // Construct the SQL query to fetch updated stock data
    $sql = "SELECT * FROM stocks WHERE s_prod_id = '$pcode'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Generate updated HTML content for the stock table
    $html = '';
    while ($row = mysqli_fetch_assoc($result)) {
        // You can access the result data here
        $s_created = $row['s_created'];
        $s_expiration = $row['s_expiration'];
        $amount = $row['s_amount'];
        $a_number = $row['s_amount_number'];

        $html .= '
            <tr>
                <td>' . $s_created . '</td>
                <td>' . $s_expiration . '</td>
                <td>' . $a_number . '</td>
                <td>' . $amount . '</td>
                <td><button class="btn border btn-sm">Delete</button></td>
            </tr>';
    }

    // Return the HTML content for the stock table
    echo $html;
}
?>
