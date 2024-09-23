<?php 
$currentURL = $_SERVER['REQUEST_URI'];
?>


<div class="sidebar" id="sidebar">
<div style="background-color:#600000;" class="sidebar-inner slimscroll">
<div  id="sidebar-menu" class="sidebar-menu">
<ul>
<li class="active">
<a href="#"><i data-feather="edit"></i><span>Account information</span> </a>
</li>



<li class="submenu">
<a href="javascript:void(0);"><i data-feather="lock" style="color:rgb(99, 115, 129);"></i><span> Privacy</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="#">Update Email</a></li>
<li><a href="#">Update Password </a></li>
<li><a href="#">Blocking </a></li>

</ul>




<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/expense1.svg" alt="img"><span>Payment Settings</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="ewalletlist.php" <?php if (strpos($currentURL, 'ewalletlist.php') !== false || strpos($currentURL, 'edit_payment.php') !== false) echo 'class="active"'; ?>>E-wallet</a></li>
<li><a href="banklist.php" <?php if (strpos($currentURL, 'banklist.php') !== false || strpos($currentURL, 'edit_Bankpayment.php') !== false) echo 'class="active"'; ?>>Bank payment</a></li>

</ul>
</li>



<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/settings.svg" alt="img"><span>Maintenance</span> <span class="menu-arrow"></span></a>
<ul>

<li><a href="managesystem_settings.php" <?php if (strpos($currentURL, 'managesystem_settings.php') !== false) echo 'class="active"'; ?>>Manage system</a></li>
<li><a href="categorylist.php" <?php if (strpos($currentURL, 'categorylist.php') !== false) echo 'class="active"'; ?> >Category List</a></li>
<!-- <li><a href="manageunit.php" <?php if (strpos($currentURL, 'manageunit.php') !== false) echo 'class="active"'; ?>>Manage unit</a></li> -->
</ul>
</li>



<li class="submenu">
<a href="javascript:void(0);"><i data-feather="chevrons-up" style="color:rgb(99, 115, 129);"></i><span>Charges</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="deliveryPlace.php" <?php if (strpos($currentURL, 'deliveryPlace.php') !== false) echo 'class="active"'; ?>>Shipping fee</a></li>
</ul>
</li>



<li class="submenu">
<a href="javascript:void(0);"><i data-feather="chevrons-down" style="color:rgb(99, 115, 129);"></i><span>Special Offers</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="managediscountPos.php" <?php if (strpos($currentURL, 'managediscountPos.php') !== false) echo 'class="active"'; ?>>Discount (Store)</a></li>   
<!--<li><a href="managediscountOrder.php" <?php if (strpos($currentURL, 'managediscountOrder.php') !== false) echo 'class="active"'; ?>>Discount (Online)</a></li>   -->
<!---<li><a href="saleslist.php">Promo voucher (Online)</a></li>--->
<!---<li><a href="saleslist.php">Interuption discount (Interupt order)</a></li>--->
</ul>
</li>



</ul>
</div>
</div>
</div>




