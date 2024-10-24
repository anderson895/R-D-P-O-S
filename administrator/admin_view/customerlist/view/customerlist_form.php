
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Customer List</h4>
<h6>View/Search Customer</h6>
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

<div class="card" id="filter_inputs">
<div class="card-body pb-0">
<div class="row">
<div class="col-lg-2 col-sm-6 col-12">
<div class="form-group">
<input type="text" placeholder="Enter Customer Code">
</div>
</div>
<div class="col-lg-2 col-sm-6 col-12">
<div class="form-group">
<input type="text" placeholder="Enter Customer Name">
</div>
</div>
<div class="col-lg-2 col-sm-6 col-12">
<div class="form-group">
<input type="text" placeholder="Enter Phone Number">
</div>
</div>
<div class="col-lg-2 col-sm-6 col-12">
<div class="form-group">
<input type="text" placeholder="Enter Email">
</div>
</div>
<div class="col-lg-1 col-sm-6 col-12  ms-auto">
<div class="form-group">
<a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
</div>
</div>
</div>
</div>
</div>

<div class="table-responsive">
<table class="table  datanew">
<thead>
<tr>
<!----<th>
<label class="checkboxs">
   <input type="checkbox" id="select-all">
<span class="checkmarks"></span>
</label>
</th>--->
<th>No.</th>
<th>Customer Name</th>
<th>Code</th>

<th>Phone</th>
<th>Email</th>
<th>Default Address</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<input hidden type="text" id="session_id" value="<?= $db_acc_id?>">




<?php
$full_name="";
$i=1;
$view_query = mysqli_query($connections,"SELECT *
FROM account
LEFT JOIN user_address
ON account.acc_code = user_address.user_acc_code
WHERE account.acc_type = 'customer' 
AND account.acc_display_status = '0' 
 AND (user_address.user_add_Default_status = '1' OR user_address.user_add_Default_status IS NULL)
"); 
// where account_type='0'
while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
    $acc_id = $row["acc_id"];
    $acc_code = $row["acc_code"];
    $acc_fname = $row["acc_fname"];
    $acc_lname = $row["acc_lname"];
    $acc_username = $row["acc_username"];
    $acc_contact = $row["acc_contact"];
    $acc_type = $row["acc_type"];
    $acc_status = $row["acc_status"];
    $acc_email = $row["acc_email"];
    $emp_image = $row["emp_image"];
    $user_complete_address = $row["user_complete_address"];


    $email_parts = explode('@', $acc_email); // Ihiwalay ang email address sa pamamagitan ng '@'
    $username = $email_parts[0]; // Kunin ang username
    $domain = $email_parts[1]; // Kunin ang domain
    $username_length = strlen($username); // Kunin ang haba ng username
    $hidden_username = substr_replace($username, '******', 1, $username_length - 2); // Palitan ang mga random na titik sa asterisk
    $masked_email = $hidden_username . '@' . $domain; // Isama ang domain upang mabuo ang natatakpan na email

    $full_name=ucfirst($acc_fname)." ".$acc_lname;

?>
<tr>
<!---<td>
<label class="checkboxs">
<input type="checkbox">
<span class="checkmarks"></span>
</label>
</td>-->

<td><?=$i?></td>
<td class="productimgname">
<a href="profile_customer.php?target_id=<?=$acc_id?>" class="product-img">
<img class="avatar-img rounded-circle" src="<?php if($emp_image){ echo "../../upload_img/$emp_image";}else{ echo "../../upload_system/empty.png";} ?>" alt="product">
</a>
<a href="profile_customer.php?target_id=<?=$acc_id?>"><?=$full_name?></a>
</td>
<td><?=$acc_code?></td>

<td><?= $acc_contact?></td>
<td><?=$masked_email?></td>
<td>
  <?php 
  if($user_complete_address){
    echo "
      <a class='viewAddress' data-user_complete_address='<?= $user_complete_address ?>'><?= strlen($user_complete_address) > 100 ? substr($user_complete_address, 0, 100) . '...' : 
  $user_complete_address; ?></a>
    ";
  }else{
      echo "No Selected Address";
  }
  ?>

</td>


<td><div class="status-toggle d-flex justify-content-between align-items-center">
          <input type="checkbox" id="user<?= $i ?>" name="accountID" class="check" <?php if($acc_status==0){ echo "checked";}?> value='<?= $acc_id?>'>
          <label for="user<?= $i ?>" class="checktoggle"  data-toggle="modal" >checkbox</label>
        </div>

</td>
<td>
<a class="me-3" href="profile_customer.php?target_id=<?=$acc_id?>">
<img src="assets/img/icons/eye.svg" alt="img">
</a>
<a class="me-3 RemoveToDisplayUser" data-acc-id="<?= $acc_id ?>">
<img src="assets/img/icons/delete.svg" alt="img" >
</a>
</td>
</tr>
<?php 
$i++;
}
?>

</tbody>
</table>
</div>
</div>
</div>