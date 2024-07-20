    <?php
    include("../../../../connection.php");
    

    $selectedSupplierId = $_GET['supplier_id'];
    $query = "SELECT *
           FROM purchasedcart 
            LEFT JOIN supplier ON purchasedcart.purchase_sup_id = supplier.spl_id
            LEFT JOIN product ON purchasedcart.purchase_prod_id = product.prod_id
            LEFT JOIN unit ON unit.unit_id = product.prod_unit_id
            WHERE purchase_sup_id = $selectedSupplierId;";




    // Execute the query
    $result = mysqli_query($connections, $query);
    
    echo '<table class="table border">';
    echo '<thead class="border">';
    echo '<tr>';
    echo '<th>Product Name</th>';
    echo '<th>Qty</th>';
    echo '<th>Unit</th>';
    echo '<th>Purchase Price</th>';
    echo '<th>Current price</th>';
    echo '<th>Profit</th>';
    echo '<th>Expiration</th>';
    echo '<th>Tax</th>';
    echo '<th>Tax Amount</th>';
    echo '<th>Discount</th>';
    echo '<th>Total Cost</th>';
    echo '<th>Net Profit</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
   
    $totalEachProfit=0;
    while ($row = mysqli_fetch_assoc($result)) {

        $prod_name=$row["prod_name"];
        $prod_image=$row["prod_image"];
        $purchase_qty=$row["purchase_qty"];
        $purchase_price=$row["purchase_price"];
        $purchase_expiration=$row["purchase_expiration"];
        $unitName=$row['unit_name'];
        $prod_currprice=$row['prod_currprice'];

        $eachProfit=$prod_currprice-$purchase_price;

        $NetProfit=$eachProfit*$purchase_qty+$row['purchased_discount'];

        

        $purchased_Tax=$row['purchased_Tax']*100;

        echo '<tr>';
        echo '<td>' . $row['prod_name'] . '</td>';
        echo '<td>' . $purchase_qty . '</td>';
        echo '<td>' . $row['unit_name'] . '</td>';
        echo '<td>' . $purchase_price . '</td>';
        echo '<td>' . $prod_currprice . '</td>';
        echo '<td>' . $eachProfit . '</td>';
        echo '<td>' . $purchase_expiration . '</td>';
        echo '<td>' . ($purchased_Tax == "0" ? "0" : $purchased_Tax . '%') . '</td>';
        echo '<td>' . $row['purchased_Tax_Amount'].'</td>';
        echo '<td>' . $row['purchased_discount'] . '</td>';
        echo '<td class="text-start">' . $row['purchased_Total_Cost'] . '</td>';
        echo '<td class="text-start">' . $totalEachProfit . '</td>';
        echo '<td hidden>' . $row['prod_id'] . '</td>';
        echo '<td hidden>' .$row['purchased_Tax']. '</td>';
        echo '<td>
        <a class="ToglerRemoveCart" data-prodcart="'.$row['purchase_id'].'"><img src="../../administrator/admin_view/assets/img/icons/delete.svg" alt="svg"></a>
        
        </td>';
        
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';

    // Calculate the grand total
    $grandTotalQuery = "SELECT 
    SUM(purchased_Total_Cost) AS Grandtotal_cost,
    SUM(purchase_qty*purchase_price) AS subtotal,
    SUM(purchased_Tax) AS Grandpurchased_Tax,
    SUM(purchased_Tax_Amount) AS Grandtotal_taxAmount,
    SUM(purchased_discount) AS Grandtotal_Discount
    FROM purchasedcart WHERE purchase_sup_id = $selectedSupplierId";
    $grandTotalResult = mysqli_query($connections, $grandTotalQuery);
    $row_grandatotal = mysqli_fetch_assoc($grandTotalResult);



    $Grandpurchased_Tax=$row_grandatotal['Grandpurchased_Tax']*100;
    $Grandtotal_taxAmount=$row_grandatotal['Grandtotal_taxAmount'];
    $Grandtotal_Discount=$row_grandatotal['Grandtotal_Discount'];
    $subtotal=$row_grandatotal['subtotal'];
    $Grandtotal_cost=$row_grandatotal['Grandtotal_cost'];

    if($Grandtotal_cost ){

        echo '<div class="container">';
        echo '<div class="row">';
            echo '<div class="col-lg-12">';
                echo '<div class="total-order">';
                    
                    echo '<div class="row">';
                        // Subtotal
                        echo '<div class="col-md-3">';
                            echo '<h6>Subtotal</h6>';
                            echo '₱ ' . number_format($subtotal, 2);
                        echo '</div>';
    
                        // Order Tax
                        echo '<div class="col-md-3">';
                            echo '<h6>Order Tax</h6>';
                            echo '₱ ' . number_format($Grandtotal_taxAmount, 2);
                        echo '</div>';
                        
                        // Discount
                        echo '<div class="col-md-3">';
                            echo '<h6>Discount</h6>';
                            echo '₱ ' . number_format($Grandtotal_Discount, 2);
                        echo '</div>';
                        
                        // Grand Total
                        echo '<div class="col-md-3 total">';
                            echo '<h6>Grand Total</h6>';
                            echo '₱ ' . number_format($Grandtotal_cost, 2);
                        echo '</div>';
                        
                    echo '</div>';
                    
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

        
    }

    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    $grandTotalData = array(
        'Grandpurchased_Tax' => $Grandpurchased_Tax * 100,
        'Grandtotal_taxAmount' => $Grandtotal_taxAmount,
        'Grandtotal_Discount' => $Grandtotal_Discount,
        'Grandtotal_cost' => $Grandtotal_cost
    );

    $response = array(
        'purchasedData' => $data,
        'grandTotalData' => $grandTotalData
    );

    header('Content-Type: application/json');
    json_encode($response);
    //  echo json_encode($response);
    //   echo json_encode($response);
    ?>

