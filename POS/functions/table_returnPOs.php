

<?php
include('../config/config.php');

    $sql = "SELECT
    t.*,
    CONCAT(a.acc_fname, ' ', a.acc_lname) as cashier
    FROM (
    SELECT
    t.*,
    a.*,
    SUM(t.ret_qty*ret_prod_price) as subtotal
    FROM
    returns_pos AS t
    JOIN
    product AS p ON t.ret_product_id = p.prod_id
    JOIN
    account AS a ON t.ret_cashier_id = a.acc_id
    GROUP BY t.ret_transaction_code
    ) AS t
    JOIN
    product AS p ON t.ret_product_id = p.prod_id
    JOIN
    account AS a ON t.ret_cashier_id = a.acc_id
    LIMIT 0, 25;


;";



$result = $conn->query($sql);

if ($result->num_rows > 0) {

 $tax=0;


 
    while ($row = $result->fetch_assoc()) {
        $fullname=ucfirst($row["acc_fname"])." ".$row["acc_lname"];
        $ret_id=$row["ret_id"];
        $subtotal=$row["subtotal"];
        $ret_transaction_code=$row["ret_transaction_code"];
        $ret_datepurchase=$row["ret_datepurchase"];
        $ret_date=$row["ret_date"];
        
        
  
      
        echo "<tr class='clickable-row row-select' data-href='view_product.php?product_code=" . $row["ret_transaction_code"] . "'>
        <td></td>
        <td id='tcode'>" . $ret_transaction_code   . "</td>
        <td>₱" . $subtotal. "</td>
   
        
       
     
        <td>" . $fullname . "</td>
        <td class='right'>" . date('Y F j h:i A', strtotime($ret_datepurchase)) . "</td>
        <td class='right'>" . date('Y F j h:i A', strtotime($ret_date)) . "</td>

    </tr>";


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
