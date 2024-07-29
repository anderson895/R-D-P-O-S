<?php
include('../config/config.php');

// Updated SQL query to retrieve data from return_pos_table
$sql = "SELECT
        r.id,
        r.rdate,
        r.rcode,
        r.rreason,
        r.rtype,
        r.selected_items,
        SUM(t.orders_prodQty * t.orders_prod_price) as Allsubtotal
    FROM
        return_pos_table AS r
    JOIN
        pos_orders AS t
    ON
        r.rcode = t.orders_tcode
    JOIN
        account AS a
    ON
        t.orders_user_id = a.acc_id
    GROUP BY
        r.rcode";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        if ($row["rcode"] !== null) {
            echo "<tr class='clickable-row row-select' data-href='view_transactions?id=". $row["rcode"] ."'>
                <td></td>
                <td id='tcode'>" . $row["rcode"] . "</td>
                <td>" . $row["rdate"] . "</td>
                <td>" . $row["rreason"] . "</td>
                <td>" . $row["rtype"] . "</td>
            </tr>";
        } else {
            echo "<tr>
                <td colspan='14'>Empty transactions.</td>
            </tr>";
        }
    }

    echo "</table>";
} else {
    echo "<tr>
        <td colspan='14'>Empty transactions.</td>
    </tr>";
}
?>


<!-- Modal Add -->
<div class="modal fade mt-4" id="add_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Add Stocks</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="../functions/add_stocks.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="add" name="prod_id">
            <input type="number" required class="form-control" placeholder="Enter amount" name="amount">
            <input type="date" required class="form-control mt-2" name="date" min="<?php echo date('Y-m-d'); ?>">
              </div>
              <div class="modal-footer justify-content-end">
                  <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary w-25" id="delete-button">Yes</button>
            </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="../assets/js/edit_modal.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
