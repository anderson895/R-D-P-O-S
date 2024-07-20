<div class="border shadow rounded p-3" style="height: 530px">
    <h5 class="fw-bold m-0"> Shopping Cart</h5>
    <div class="mb-2" style="overflow-y:scroll; height:250px; margin-right: -10px">
        <table class="table">
            <thead>
                <tr style="font-size: 12px;">
                    <th width="10%"></th>
                    <th width="50%"></th>
                    <th width="30%"></th>
                    <th width="10%"></th>

                </tr>
            </thead>
            <tbody class='cartContent'>

                <?php
                $sql = "SELECT *,
                                                    SUM(pos_cart.cart_prodQty) as groupQty        
                                                    FROM pos_cart
                                                    INNER JOIN product ON pos_cart.pos_cart_prod_id = product.prod_id
                                                    WHERE pos_cart_user_id = $acc_id
                                                    Group by product.prod_id
                                                    ORDER BY `pos_cart_id` DESC";

                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    die("Query failed: " . mysqli_error($conn));
                }

                if (mysqli_num_rows($result) == 0) {
                    echo '<tr><td colspan="4" class="py-4 "><div class=" d-flex flex-column justify-content-center "><div class="d-flex mt-2 justify-content-center"><img src="../assets/images/empty.png" style="width: 100px; margin-right: 15px;"></div><p class="text-center mt-2 text-secondary">Empty Cart</p></div></td></tr>';
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $prod_id = $row['prod_id'];

                        $get_record = mysqli_query($connections, "SELECT *,SUM(s_amount) as totalStocks
                                                    FROM stocks where s_prod_id='$prod_id' ");
                        $rowStocks = mysqli_fetch_assoc($get_record);
                        $totalStocks = $rowStocks["totalStocks"];

                        echo '

                                                    
                                                    <input hidden type="text" name="prod_id[]" value="' . $row['prod_id'] . '">
                                                  
                                                    <tr>
                                                    <td width="10%">
                                                    <div style="width: 60px; height: 60px;">
                                                    <img class="rounded border" src="../../upload_prodImg/' . $row['prod_image'] . '" style="width: 100%; height: 100%; object-fit: contain;" alt="' . $row['prod_name'] . '">
                                                    </div>
                                                    </td>
                                                    <td width="50%">
                                                    
                                                    <div class="d-block" style="font-size: 14px">
                                                    <p class="p-0 m-0 fw-bold">' . $row['prod_name'] . '</p>
                                                    <p class="p-0 m-0">₱ ' . $row['prod_currprice'] . '</p>
                                                    </div>
                                                    </td>
                                                    <td width="30%">

                                                    <div class="input-group input-group-sm" id="data" data-pos_cart_user_id="' . $row['pos_cart_user_id'] . '" data-cart_prodQty="' . $row['cart_prodQty'] . '" data-subtotal="' . $row['subtotal'] . '" data-cart-id="' . $row['pos_cart_id'] . '" data-price="' . $row['prod_currprice'] . '" data-qty="' . $row['cart_prodQty'] . '">
                                                        <button class="btn border btn-decrement">-</button>
                                                            <input type="number" class="form-control p-1 text-center" name="quantity[]" data-stocklimit="' . $totalStocks . '" max="' . $totalStocks . '" min="1" value="' . $row['groupQty'] . '" style="background-color: white" disabled>
                                                        <button class="btn border btn-increment">+</button>
                                                    </div>
                                                
                                                
                                                    </td>
                                                    <td width="10%">
                                                    <form action="../functions/delete_cart_item.php" method="POST">
                                                    <input type="hidden" name="pos_cart_id" value="' . $row['pos_cart_id'] . '">
                                                    <input hidden type="text" name="pos_cart_prod_id[]" value="' . $row['pos_cart_prod_id'] . '">
                                                    
                                                    <input hidden  type="text" name="prod_currprice[]" value="' . $row['prod_currprice'] . '">
                                                    <button class="btn btn-sm border-none rounded rounded-5" type="submit" style="background-color: red;">
                                                    <img src="../assets/images/trash.png" style="width: 18px;" class="mb-1" onclick="deleteCartItem(event)">
                                                    </button>
                                                    </form>
                                                    </td>
                                                    </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div>
        <select class="form-select" aria-label="Default select example" id="discountSelect">
            <option selected>Select Discount</option>
            <?php
            $sql = "SELECT * 
                                    FROM discount 
                                    WHERE discount_status = 1
                                    ";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['discount_rate'] . '" data-discount_name="' . $row['discount_name'] . '">' . $row['discount_name'] . '</option>';
            }
            ?>
        </select>


        <div class=" rounded p-0 my-2 p-2 border">
            <table class="w-100 ">
                <tbody>
                    <tr>
                        <td class="pb-0">Subtotal</td>
                        <td class="d-flex pb-0 justify-content-end" id="subtotal">₱ 0.00</td>
                    </tr>
                    <tr>
                        <td class="pb-0">Discount</td>
                        <td class="d-flex pb-0 justify-content-end" id="discount_rate">₱ 0.00</td>
                    </tr>
                    <tr>
                        <?php
                        $sql = "SELECT system_tax FROM maintinance WHERE system_id = 1";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Fetch the result
                            $row = $result->fetch_assoc();
                            $systemTax = $row["system_tax"];
                            $systemTaxPercentage = $systemTax * 100;
                        }
                        ?>
                        <td class="pb-0">VAT(<?php echo $systemTaxPercentage / 100 ?>%)</td>
                        <td class="d-flex pb-0 justify-content-end" id="tax">₱ 0.00</td>
                    </tr>
                    <tr style="font-size: 15px;">
                        <td class="pb-0 fw-bold">Total</td>
                        <td class="d-flex pb-0 fw-bold justify-content-end" id="total">₱ 0.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex">
            <button class="btn me-2 w-50 " style="background-color: red; color: white">CLEAR</button>
            <button class="btn ms-2 w-50 " style="background-color: green; color: white" id="payment_id" data-bs-toggle="modal" data-bs-target="#payment">PURCHASE</button>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade mt-4" id="payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class=" rounded p-0 my-2 p-2 border">
                    <!---   <form action="../functions/purchase.php" class="p-0 m-0" method="POST">--->

                    <!---from me---->
                    <input hidden type="text" name="discountRateVal" id="discountRateVal" class="form-control">
                    <input hidden type="text" name="discount_name" id="discount_name" class="form-control">
                    <input hidden type="text" name="amount_change" id="amount_changeVal" class="form-control">

                    <!---from fyke--->
                    <input type="hidden" name="subtotal" id="modal_subtotal" class="form-control" placeholder="0">
                    <input type="hidden" name="discount" id="modal_discount" class="form-control" placeholder="0">
                    <input type="hidden" name="tax" id="modal_tax" class="form-control" placeholder="0">
                    <input type="hidden" name="total" id="modal_total" class="form-control" placeholder="0">
                    <table class="w-100 ">
                        <tbody>
                            <tr>
                                <td class="pb-0">Subtotal</td>
                                <td class="d-flex pb-0 justify-content-end" id="subtotal">₱ 0.00</td>
                            </tr>
                            <tr>
                                <td class="pb-0">Discount</td>
                                <td class="d-flex pb-0 justify-content-end" id="discount_rate">₱ 0.00</td>
                            </tr>
                            <tr>

                                <td class="pb-0">VAT(<?php echo $systemTaxPercentage / 100 ?>%)</td>
                                <td class="d-flex pb-0 justify-content-end" id="tax">₱ 0.00</td>
                            </tr>
                            <tr style="font-size: 15px;">
                                <td class="pb-0 fw-bold">Total</td>
                                <td class="d-flex pb-0 fw-bold justify-content-end" id="total">₱ 0.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <input type="number" name="payment" required class="form-control" id="amount_payment" placeholder="Enter payment here">
                <div class="input-group mt-2">
                    <label for="" class="form-control fw-bold">Change:</label>
                    <input type="text" class="form-control text-end fw-bold" name="change" value="₱ 0.00" id="amount_change" disabled style="background-color: white">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" disabled class="btn " style="background-color: green; color: white" id="purchase">Purchase</button>
                <!---</form>--->



            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/update_pos_cart_qty_realtime.js"></script>


<script>
    function updateCartSubtotal() {
        var subtotal = 0;

        // Loop through all cart items
        $('[data-cart-id]').each(function() {
            var price = parseFloat($(this).data('price'));
            var qty = parseFloat($(this).find('input[name="quantity[]"]').val());
            var productTotal = price * qty;

            // Add the product total to the subtotal
            subtotal += productTotal;
        });

        return subtotal;
    }

    function updateCartTotal() {
        var subtotal = updateCartSubtotal();

        // Get the selected discount rate
        var discountRate = parseFloat($('#discountSelect').val()) || 0;

        // Calculate the discount amount
        var discountAmount = subtotal * (discountRate / 100);

        // Calculate the subtotal after applying the discount
        var subtotalAfterDiscount = subtotal - discountAmount;

        // Calculate the tax
        var taxRate = <?php echo $systemTax ?>;
        var taxAmount = subtotalAfterDiscount * (taxRate / 100);

        // Calculate the total
        var total = subtotalAfterDiscount;
        //-taxAmount

        // Update the elements in the HTML
        $('#subtotal').text('₱ ' + subtotal.toFixed(2));
        $('#discount_rate').text('₱ ' + discountAmount.toFixed(2));
        $('#tax').text('₱ ' + taxAmount.toFixed(2));
        $('#total').text('₱ ' + total.toFixed(2));

        // Update the elements in the "payment" modal
        $('#payment #subtotal').text('₱ ' + subtotal.toFixed(2));
        $('#payment #discount_rate').text('₱ ' + discountAmount.toFixed(2));
        $('#payment #tax').text('₱ ' + taxAmount.toFixed(2));
        $('#payment #total').text('₱ ' + total.toFixed(2));

        // Update the input fields in the "payment" modal
        $('#payment #modal_subtotal').val(subtotal.toFixed(2));
        $('#payment #modal_discount').val(discountAmount.toFixed(2));
        $('#payment #modal_tax').val(taxAmount.toFixed(2));
        $('#payment #modal_total').val(total.toFixed(2));

        // Call the function to enable/disable elements based on the subtotal value
        enableDisableElements(subtotal);
    }

    function enableDisableElements(subtotal) {
        if (subtotal === 0) {
            $('#payment_id').prop('disabled', true);
            $('#discountSelect').prop('disabled', true);
        } else {
            $('#payment_id').prop('disabled', false);
            $('#discountSelect').prop('disabled', false);
        }
    }

    $(document).ready(function() {
        // Call the updateCartTotal function when the document is ready
        updateCartTotal();

        // Add event listeners to quantity input elements for dynamic calculation
        $('[data-cart-id] input[name="quantity[]"]').on('input', function() {
            updateCartTotal();
        });

        // Add event listener to the discount select
        $('#discountSelect').on('change', function() {

            var selectedOption = $(this).find('option:selected');
            var discountName = selectedOption.data('discount_name');

            var discountRateVal = selectedOption.val();
            console.log('Selected Discount rate:', discountRateVal);

            $("#discount_name").val(discountName);
            $("#discountRateVal").val(discountRateVal);

            updateCartTotal();
        });

        // Add event listeners to the plus and minus buttons for quantity
        $('[data-cart-id] button').on('click', function() {
            updateCartTotal();
        });
    });
</script>


<script>
    const totalInput = document.getElementById("modal_total");
    const amountPaymentInput = document.getElementById("amount_payment");
    const amountChangeInput = document.getElementById("amount_change");
    const purchaseButton = document.getElementById("purchase");

    totalInput.addEventListener("input", updateAmountChange);
    amountPaymentInput.addEventListener("input", updateAmountChange);

    function updateAmountChange() {
        const total = parseFloat(totalInput.value);
        const amountPayment = parseFloat(amountPaymentInput.value);

        if (isNaN(total) || isNaN(amountPayment)) {
            amountChangeInput.value = "0.00";
        } else if (total > amountPayment) {
            amountChangeInput.value = "Insufficient amount";
            purchaseButton.disabled = true; // Disable the "purchase" button
        } else {

            const amountChange = amountPayment - total;
            amountChangeInput.value = amountChange.toFixed(2);
            purchaseButton.disabled = false; // Enable the "purchase" button

        }

        // Update the actual value of id="amount_change" element
        $('#amount_change').val(amountChangeInput.value);
        $('#amount_changeVal').val(amountChangeInput.value);
    }


    $("#purchase").on("click", function(event) {

        var discountRateVal = $("#discountRateVal").val();
        var discount_name = $("#discount_name").val();
        var amount_changeVal = $("#amount_changeVal").val();
        var modal_subtotal = $("#modal_subtotal").val();
        var modal_discount = $("#modal_discount").val();
        var modal_tax = $("#modal_tax").val();
        var modal_total = $("#modal_total").val();
        var amount_payment = $("#amount_payment").val();


        var prodIds = [];
        var quantities = [];
        var prod_cprices = [];


        $("input[name='prod_currprice[]']").each(function() {
            var prod_cprice = $(this).val();
            prod_cprices.push(prod_cprice);
        });

        $("input[name='pos_cart_prod_id[]']").each(function() {
            var prodId = $(this).val();
            prodIds.push(prodId);
        });


        $("input[name='quantity[]']").each(function() {
            var quantity = $(this).val();
            quantities.push(quantity);
        });

        console.log(prodIds)

        var formData = new FormData();
        formData.append("prodIds", prodIds);
        formData.append("prod_cprices", prod_cprices);
        formData.append("quantities", quantities);
        formData.append("discountRateVal", discountRateVal);
        formData.append("discount_name", discount_name);
        formData.append("amount_changeVal", amount_changeVal);
        formData.append("modal_subtotal", modal_subtotal);
        formData.append("modal_discount", modal_discount);
        formData.append("modal_tax", modal_tax);
        formData.append("modal_total", modal_total);
        formData.append("amount_payment", amount_payment);




        // Include additional data attributes


        /*
        var cartProdQtyArray = [];
        $('[data-cart-id]').each(function () {
            formData.append("pos_cart_prod_id[]", $(this).data('pos_cart_prod_id'));
            formData.append("pos_cart_user_id[]", $(this).data('pos_cart_user_id'));

            // Use the quantity values from the logged array
            var quantity = $(this).find('input[name="quantity[]"]').val();
            formData.append("cart_prodQty[]", quantity);

            formData.append("subtotal[]", $(this).data('subtotal'));

            // Add quantity to the array for reference
            cartProdQtyArray.push(quantity);
        });*/

        console.log(formData)
        // console.log("Cart Prod Qty Array:", cartProdQtyArray);

        $('#purchase').prop('disabled', true);

        $.ajax({
            url: "../functions/purchase.php",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                // You can add additional logic here based on the server 
                window.location.href = "../pages/print_reciept?id=" + response;

                // $('#purchase').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });


    });
</script>