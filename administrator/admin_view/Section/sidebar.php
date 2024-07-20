<?php
$currentURL = $_SERVER['REQUEST_URI'];
?>


<div class="sidebar" id="sidebar">
    <div style="background-color:rgb(113,0,0);" class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>



                <li class="<?php if (strpos($currentURL, 'index.php') !== false) echo 'active'; ?>">
                    <a href="index.php"><img src="assets/img/dashboard.png" alt="img"><span class="text-white"> Dashboard</span> </a>
                </li>



                <li>
                    <a href="../../POS/index.php"><img src="assets/img/point-of-sale.png" alt="img"><span class="text-white"> POS</span> </a>
                </li>





                <li class="<?= (strpos($currentURL, 'sales.php')) ? 'active' : '' ?>">
                    <a href="sales.php"><img src="assets/img/increasing.png" alt="img"><span class="text-white"> Sales</span> </a>
                </li>


                <li>
                    <a href="../new-orders-view/orders.php"><img src="assets/img/truck.png" alt="img"><span class="text-white"> Order</span> </a>
                </li>




                <?php
                if ($acc_type == "administrator") {
                ?>
                    <li class="submenu ">
                        <a href="javascript:void(0);"><img src="assets/img/user.png" alt="img"><span class="text-white"> Accounts</span> <span class="menu-arrow"></span></a>
                        <ul>

                            <li><a href="userlist.php" <?php if (strpos($currentURL, 'userlist.php') !== false) echo 'class="active"'; ?>>Employee</a></li>
                            <li><a href="customerlist.php" <?php if (strpos($currentURL, 'customerlist.php') !== false) echo 'class="active"'; ?>>Customer</a></li>
                            <li><a href="supplierlist.php" <?php if (strpos($currentURL, 'supplierlist.php') !== false) echo 'class="active"'; ?>>Supplier</a></li>

                        </ul>








                    <li class="submenu ">
                        <a href="javascript:void(0);"><img src="assets/img/box.png" alt="img"><span class="text-white"> Product</span> <span class="menu-arrow"></span></a>
                        <ul>

                            <li><a href="productlist.php" <?php if (strpos($currentURL, 'productlist.php') !== false) echo 'class="active"'; ?>>All product</a></li>
                            <li><a href="Inventory.php" <?php if (strpos($currentURL, 'Inventory.php') !== false) echo 'class="active"'; ?>>Inventory</a></li>
                            <li><a href="stock_in.php" <?php if (strpos($currentURL, 'stock_in.php') !== false || strpos($currentURL, 'add_stock.php') !== false) echo 'class="active"'; ?>>Stock in</a></li>

                        </ul>


                    <li class="submenu ">
                        <a href="javascript:void(0);"><img src="assets/img/report.png" alt="img"><span class="text-white"> Reports</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="#" <?php if (strpos($currentURL, '#') !== false) echo 'class="active"'; ?>>Daily Report</a></li>
                            <li><a href="#" <?php if (strpos($currentURL, '#') !== false) echo 'class="active"'; ?>>Monthly Report</a></li>
                            <li><a href="#" <?php if (strpos($currentURL, '#') !== false) echo 'class="active"'; ?>>Annual Report</a></li>
                        </ul>






                    <li class="submenu ">
                        <a href="javascript:void(0);"><img src="assets/img/settings.png" alt="img"><span class="text-white"> Maintenance</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <!--<li><a href="#" <?php if (strpos($currentURL, '#') !== false) echo 'class="active"'; ?>>Payment</a></li>-->
                            
                                <li><a href="ewalletlist.php" <?php if (strpos($currentURL, 'ewalletlist.php') !== false || strpos($currentURL, 'edit_payment.php') !== false) echo 'class="active"'; ?>>E-wallet</a></li>
                              
                            
                            <li><a href="deliveryPlace.php" <?php if (strpos($currentURL, 'deliveryPlace.php') !== false) echo 'class="active"'; ?>>Shipping Fee</a></li>
                          
                            <li><a href="categorylist.php" <?php if (strpos($currentURL, 'categorylist.php') !== false) echo 'class="active"'; ?>>Category</a></li>
                            <li><a href="manageunit.php" <?php if (strpos($currentURL, 'manageunit.php') !== false) echo 'class="active"'; ?>>Unit</a></li>
                            <li><a href="managesystem_settings.php" <?php if (strpos($currentURL, 'managesystem_settings.php') !== false) echo 'class="active"'; ?>>System</a></li>
                            
                            
                            
                            <li><a href="#" <?php if (strpos($currentURL, '#') !== false) echo 'class="active"'; ?>>Restore</a></li>
                            
                            
                            
                            <li class="submenu">
                                <a href="javascript:void(0);"><span>Special Offers</span></a>
                                <ul>
                                <li><a href="managediscountPos.php" <?php if (strpos($currentURL, 'managediscountPos.php') !== false) echo 'class="active"'; ?>>Discount (Store)</a></li>   
                                <li><a href="managediscountOrder.php" <?php if (strpos($currentURL, 'managediscountOrder.php') !== false) echo 'class="active"'; ?>>Discount (Online)</a>
                            </li>   
                              
                            </ul>
                        </ul>


                    <li>
                        <a href="index.php"><img src="assets/img/restore.png" alt="img"><span class="text-white"> Restore</span> </a>
                    </li>


                <?php } ?>






            </ul>
        </div>
    </div>
</div>