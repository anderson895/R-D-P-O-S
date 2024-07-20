
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Discount Settings in (Ordering)</h4>
<h6>View/search Discount</h6>
</div>
<div class="page-btn">
<a class="btn btn-added"  data-bs-toggle="modal" data-bs-target="#addpayment"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New Discount</a>
</div>
</div>

<div class="card">
<div class="card-body">
<div class="table-top">
<div class="search-set">
<div class="search-input">
<a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
</div>
</div>
<div class="wordset">
<ul>
<li>
<a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
</li>
<li>
<a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
</li>
<li>
<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
</li>
</ul>
</div>
</div>
<input hidden type="text" id="acc_id" name="acc_id" value="<?= $db_acc_id?>">
<div class="table-responsive">
<table class="table  datanew">
<thead>
<tr>
<th>Discount ID</th>
<th>Discount name</th>
<th>Description</th>
<th>MaximumLimit</th>
<th>Rate</th>
<th>Expiration</th>
<th>Date added</th>


<th>Date edited</th>
<th>Status</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
    
<?php
    

    $current_date = date("Y-m-d"); // Get the current date
    $i=1;
$view_query = mysqli_query($connections, "
SELECT * from voucher where voucher_status='1' OR voucher_status='0'
Order by voucher_id DESC
");
       // where account_type='0'
       
       while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
           
           $voucher_id = $row["voucher_id"];
           $voucher_name = $row["voucher_name"];
           $voucher_discount = $row["voucher_discount"];
           $voucher_desciption = $row["voucher_desciption"];
           $voucher_created = $row["voucher_created"];
           $voucher_expiration = $row["voucher_expiration"];
           $voucher_maximumLimit = $row["voucher_maximumLimit"];
       
           $voucher_date_edit = $row["voucher_date_edit"];
           $voucher_status = $row["voucher_status"];


           $timestampdiscount_expiration = strtotime($voucher_expiration); // Convert the date to a Unix timestamp
           $formattedDate_expiration = date("d F Y h:i A", $timestampdiscount_expiration); // Adds time in 12-hour format with AM/PM

           $timestampdiscount_added = strtotime($voucher_created); // Convert the date to a Unix timestamp
           $formattedDateAdded = date("d F Y h:i A", $timestampdiscount_added); // Adds time in 12-hour format with AM/PM
           
           $timestampdiscount_edited= strtotime($voucher_date_edit); // Convert the date to a Unix timestamp
           $formatteddiscount_edited= date("d F Y h:i A", $timestampdiscount_edited); // Adds time in 12-hour format with AM/PM
           
           ?>
<tr>
<td>00<?= $voucher_id;?></td>
<td><?= ucfirst($voucher_name);?></td>
<td ><a class='viewDescription' data-voucher_desciption='<?= $voucher_desciption ?>'><?= strlen($voucher_desciption) > 100 ? substr($voucher_desciption, 0, 100) . '...' : $voucher_desciption; ?>      
<td><?= $voucher_maximumLimit;?></td>
<td><?= $voucher_discount;?>%</td>
<td><?= $formattedDate_expiration;?></td>
<td><?=$formattedDateAdded?></td>






<td><?php if($voucher_date_edit!=null){ echo $formatteddiscount_edited;}else{ echo 'unchanged';} ?></td>
</a>
</td>

<td>
<div class="status-toggle d-flex justify-content-between align-items-center">
    <input type="checkbox" <?php if($voucher_status==="1"){echo" checked";}?> id="user<?=$i?>" class="check" value="<?=$voucher_id?>">
<label for="user<?=$i?>" class="checktoggle">checkbox</label>
</div>
</td>


<td class="text-end">
<a class="me-3 toglerEditDiscount"
data-voucher_id_update="<?= $voucher_id?>"
data-voucher_name_update="<?= $voucher_name?>"
data-voucher_desciption_update="<?= $voucher_desciption?>"
data-voucher_discount_update="<?= $voucher_discount?>"
data-voucher_maximumLimit_update="<?= $voucher_maximumLimit?>"
data-voucher_expiration="<?= $voucher_expiration?>"
data-voucher_status="<?= $voucher_status?>"
data-bs-toggle="modal" data-bs-target="#editDiscount">
<img src="assets/img/icons/edit.svg" alt="img">
</a>

<a class="deleteConfirmation" data-voucher_id="<?= $voucher_id?>" data-acc_id="<?=$acc_id?>" data-voucher_status="<?= $voucher_status ?>">
<img src="assets/img/icons/delete.svg" alt="img">
</a>
</td>
</tr>

<?php 
$i++;
} ?>



</tbody>
</table>
</div>
</div>
</div>