<?php
include('../config/config.php');

$sql = "SELECT
t.orders_tcode,
t.orders_subtotal,
t.orders_discount,
t.orders_tax,
t.orders_final,
t.orders_payment,
t.orders_change,
a.acc_type,
CONCAT(a.acc_fname, ' ', a.acc_lname) as cashier,
SUM(t.orders_prodQty * t.orders_prod_price) as Allsubtotal
FROM
pos_orders AS t
JOIN
product AS p
ON
t.orders_prod_id = p.prod_id
JOIN
account AS a
ON
t.orders_user_id = a.acc_id
GROUP BY
t.orders_tcode;


";


$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        if($row["orders_tcode"]!==Null){
            echo "<tr class='clickable-row row-select' data-href='view_transactions?id=". $row["orders_tcode"] ."'>
            <td></td>
            <td id='tcode'>" . $row["orders_tcode"] . "</td>
            <td>₱" . number_format($row["orders_subtotal"],2) . "</td>
            <td>₱" . number_format($row["orders_discount"],2) . "</td>
            <td>₱" . number_format($row["orders_tax"],2) . "</td>
            <td>₱" . number_format($row["orders_final"],2) . "</td>
            <td>₱" . number_format($row["orders_payment"],2) . "</td>
            <td>₱" . number_format($row["orders_change"],2) . "</td>
            <td>" .ucfirst( $row["cashier"]). "</td>
            <td>".ucfirst($row["acc_type"])."</td>
            
        </tr>";

        }else{
            echo "<tr>
            <td colspan='10'>Empty transactions.</td>
            </tr>";
        }
       

    }

    echo "</table>";
} else {
    echo "<tr>
    <td colspan='10'>Empty transactions.</td>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var rows = document.querySelectorAll('.clickable-row');

        rows.forEach(function (row) {
            row.addEventListener('click', function () {
                var url = row.getAttribute('data-href');
                window.location.href = url;
            });
        });
    });
</script>
