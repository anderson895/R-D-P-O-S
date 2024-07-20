
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Discount Settings in (POS)</h4>
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

<th>Discount name</th>
<th>Description</th>
<th>Rate</th>
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
SELECT * from discount where discount_status='1' OR discount_status='0'
");
       // where account_type='0'
       
       while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
           
           $discount_id = $row["discount_id"];
           $discount_name = $row["discount_name"];
           $discount_description = $row["discount_description"];
           $discount_rate = $row["discount_rate"];
           $discount_added = $row["discount_added"];
           $discount_edited = $row["discount_edited"];
           $discount_status = $row["discount_status"];


           $timestampdiscount_added = strtotime($discount_added); // Convert the date to a Unix timestamp
           $formattedDateAdded = date("d F Y h:i A", $timestampdiscount_added); // Adds time in 12-hour format with AM/PM
           
           $timestampdiscount_edited= strtotime($discount_edited); // Convert the date to a Unix timestamp
           $formatteddiscount_edited= date("d F Y h:i A", $timestampdiscount_edited); // Adds time in 12-hour format with AM/PM
           
           ?>
<tr>

<td><?= ucfirst($discount_name);?></td>
<td ><a class='viewDescription' data-discount_description='<?= $discount_description ?>'><?= strlen($discount_description) > 100 ? substr($discount_description, 0, 100) . '...' : $discount_description; ?>
</a>
</td>

<td><?=$discount_rate?>%</td>
<td><?=$formattedDateAdded?></td>
<td><?php if($discount_edited!=null){ echo $formatteddiscount_edited;}else{ echo 'unchanged';} ?></td>

<td>
<div class="status-toggle d-flex justify-content-between align-items-center">
    <input type="checkbox" <?php if($discount_status==="1"){echo" checked";}?> id="user<?=$i?>" class="check" value="<?=$discount_id?>">
<label for="user<?=$i?>" class="checktoggle">checkbox</label>
</div>
</td>


<td class="text-end">
<a class="me-3 toglerEditDiscount"
data-discount_id="<?= $discount_id?>"
data-discount_name="<?= $discount_name?>"
data-discount_description="<?= $discount_description?>"
data-discount_rate="<?= $discount_rate?>"
data-discount_status="<?= $discount_status?>"
data-bs-toggle="modal" data-bs-target="#editDiscount">
<img src="assets/img/icons/edit.svg" alt="img">
</a>
<a class="deleteConfirmation" data-discount_id="<?= $discount_id?>" data-acc_id="<?=$acc_id?>" data-discount_status="<?= $discount_status ?>">
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