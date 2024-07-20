
<div class="table-responsive">
<table class="table datanew">
<thead>
<tr>

<th>Supplier Name</th>
<th>code</th>
<th>Phone</th>
<th>email</th>
<th>Address</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<input hidden type="text" id="session_id" value="<?= $db_acc_id?>">

<?php
$full_name="";
$i=1;
$view_query = mysqli_query($connections,"SELECT * from supplier where spl_status='0' "); 
// where account_type='0'
while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
    $spl_id = $row["spl_id"];
    $spl_code = $row["spl_code"];
    $spl_name = $row["spl_name"];
    $spl_email = $row["spl_email"];
    $spl_date_added = $row["spl_date_added"];
    $spl_date_edited = $row["spl_date_edited"];
    $spl_address = $row["spl_address"];
    $spl_status = $row["spl_status"];
    $spl_contact = $row["spl_contact"];

 
    $email_parts = explode('@', $spl_email);
    $username = $email_parts[0];
    $domain = $email_parts[1];
    $email_length = strlen($username);
    $hidden_username = substr_replace($username, '******', 1, $email_length - 2);
    $masked_email = $hidden_username . '@' . $domain;

    //echo $masked_email; // Output ang masked email address


?>

<tr>
<td class="productimgname">
<br><br><br>
<a href="javascript:void(0);"><?= ucfirst($spl_name)?></a>
</td>
<td><?=$spl_code?></td>
<td><?= $spl_contact?></td>
<td><?= $masked_email;?></td>
<td ><a class='viewAddress' data-completeAddress='<?= $spl_address ?>'><?= strlen($spl_address) > 80 ? substr($spl_address, 0, 80) . '...' : $spl_address; ?></a></td>
<td>
<a class="me-3" href="editsupplier.php?spl_id=<?=$spl_id?>">
<img src="assets/img/icons/edit.svg" alt="img">
</a>
<a class="me-3 toglerDeleteSupplier" data-db_acc_id=<?= $db_acc_id?> data-spl_id="<?= $spl_id ?>">
<img src="assets/img/icons/delete.svg" alt="img">
</a>
</td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>




