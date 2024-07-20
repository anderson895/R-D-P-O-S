<div class="cartlist-bottom">
                    <div>
                    <form action="POST">
                        <select class="form-control discount" name="discount" id="discountSelect" onchange="updateDiscountId()">
                            <option value="0" >DISCOUNT</option>
                            <?php 
                            $discount_query = mysqli_query($connections, "SELECT * FROM `discount` where discount_status='1'");
                            while ($d_row = mysqli_fetch_assoc($discount_query)) {
                                $db_discount_id = $d_row["discount_id"];
                                $db_discount_name = $d_row["discount_name"];
                                $db_discount_rate = $d_row["discount_rate"];
                            ?>
                            <option value="<?php echo $db_discount_rate ?>"><?php echo $db_discount_name ?></option>
                            <?php } ?>
                        </select>
                    </form>
                    </div>
                    <div>
                        <table class="computation" style="color:black;">
                            <tr>
                                <td class="description-left">Subtotal: </td>
                                <td class="description-right" id="subtot"><?php echo number_format($totalSum , 2, '.', ',') ?></td>

                               
                            </tr>
                            <tr>
                                <td class="description-left">Discount: </td>
                                <td class="description-right" id="discount">₱ 0.00</td>
                            </tr>
                            <tr>
                                <td class="description-left">Tax: </td>
                                <td class="description-right" id="tax"><?php echo $db_system_tax ?></td>
                            </tr>
                            <tr>
                                <td class="description-left" style="font-size: 25px; color: rgb(59, 59, 59);"><b>TOTAL: </b></td>
                                <td class="description-right" style="font-size: 25px; color: rgb(59, 59, 59);" id="tot"><?php echo number_format($finalTotal, 2, '.', ',') ?> </td>
                            </tr>
                        </table>
                    </div>
                    <div class="purchase-buttons">
                        <div class="button-down1">
                            <button type="button" class="clear" onclick="clearCart()">CLEAR</button>
                        </div>
                        <div class="button-down2">
                            <button class="checkout toglerCheckout" 
                            data-bs-toggle="modal" 
                            data-bs-target="#ModalCheckOut"
                            data-prod_id="<?= $db_prod_id ?>"
                            data-pos_cart_user_id="<?= $pos_cart_user_id ?>"
                            data-unit_name="<?= $unit_name ?>">    
                            PURCHASE</button>
                        </div>
                    </div>
                </div>