
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Currency Settings</h4>
<h6>Manage Currency Settings</h6>
</div>
<div class="page-btn">
<a class="btn btn-added"  data-bs-toggle="modal" data-bs-target="#addpayment"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New Unit</a>
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
<th>
Unit No.
</th>
<th>Unit name</th>
<th>Description</th>
<th>Status</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
    
<?php
    

    $current_date = date("Y-m-d"); // Get the current date
    $i=1;
$view_query = mysqli_query($connections, "
SELECT * from unit where unit_status='1' OR unit_status='0'
");
       // where account_type='0'
       
       while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
           
           $unit_id  = $row["unit_id"];
           $unit_name = $row["unit_name"];
           $unit_description = $row["unit_description"];
           $unit_date_added = $row["unit_date_added"];
           $unit_date_added = $row["unit_date_added"];
           $unit_date_edited = $row["unit_date_edited"];
           $unit_status = $row["unit_status"];
           ?>
<tr>
<td>
<?= $i?>
</td>
<td><?= ucfirst($unit_name);?></td>
<td ><a class='viewDescription' data-unit_description='<?= $unit_description ?>'><?= strlen($unit_description) > 100 ? substr($unit_description, 0, 100) . '...' : $unit_description; ?>
</a></td>

<td>
<div class="status-toggle d-flex justify-content-between align-items-center">
    <input type="checkbox" <?php if($unit_status==="1"){echo" checked";}?> id="user<?=$i?>" class="check" value="<?=$unit_id?>">
<label for="user<?=$i?>" class="checktoggle">checkbox</label>
</div>
</td>


<td class="text-end">
<a class="me-3 toglerEditUnit"
data-unit_id="<?= $unit_id?>"
data-unit_name="<?= $unit_name?>"
data-unit_description="<?= $unit_description?>"
data-unit_status="<?= $unit_status?>"
data-bs-toggle="modal" data-bs-target="#editUnit">
<img src="assets/img/icons/edit.svg" alt="img">
</a>
<a class="deleteConfirmation" data-unit_id="<?= $unit_id?>" data-acc_id="<?=$acc_id?>" data-unit_status="<?= $unit_status ?>">
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