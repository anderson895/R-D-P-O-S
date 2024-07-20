
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Payment Settings</h4>
<h6>Bank payment list</h6>
</div>
<div class="page-btn">
<a class="btn btn-added"  href='addnewpayment_bank.php'><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New payment</a>
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
 No.
</th>
<th>Payment code</th>
<th>Payment name</th>
<th>Payment number</th>

<th>Status</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
    
<?php
    

    $current_date = date("Y-m-d"); // Get the current date
    $i=1;
$view_query = mysqli_query($connections, "
SELECT * FROM mode_of_payment WHERE (payment_status = '0' OR payment_status = '1') AND payment_type = 'bank';
");
       // where account_type='0'
       
       while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
           
           $payment_id = $row["payment_id"];
           $payment_name = $row["payment_name"];
           $payment_code = $row["payment_code"];
           $payment_number = $row["payment_number"];
           $payment_image = $row["payment_image"];
           $payment_status = $row["payment_status"];
           $payment_type = $row["payment_type"];
           $payment_status = $row["payment_status"];
           $payment_date_added = $row["payment_date_added"];
           $payment_date_added = $row["payment_date_added"];
           ?>
<tr>
<td><?= $i?></td>
<td><?= $payment_code?></td>
<td><?= ucfirst($payment_name)?></td>
<td ><?= $payment_number?></td>

<td>
<div class="status-toggle d-flex justify-content-between align-items-center">
    <input type="checkbox" <?php if($payment_status=="0"){echo" checked";}?> id="user<?=$i?>" class="check" value="<?=$payment_id?>">
<label for="user<?=$i?>" class="checktoggle">checkbox</label>
</div>
</td>


<td class="text-end">
<a class="me-3" href="edit_Bankpayment.php?payment_id=<?=$payment_id?>">
<img src="assets/img/icons/edit.svg" alt="img">
</a>
<a class="RemoveToDisplayPayment" data-payment_id="<?= $payment_id?>" data-acc_id="<?=$acc_id?>">
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