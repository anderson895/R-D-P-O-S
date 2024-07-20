<div class="card mb-0">
<div class="card-body">
<h4 class="card-title">Stocks Expiration List</h4>
<div class="table-responsive dataview">
<table class="table datatable">
<thead>
<tr>
    
<th>Expiry Date</th>
<th>Date purchase</th>
<th>Stocks</th>
<th>Stock #</th>
<th>Product</th>
<th>Supplier</th>
<th>Category</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php
$query = "SELECT DISTINCT sd.ns_stockin_date, spl.spl_name, s.s_id, p.prod_code, p.prod_name, p.prod_description, p.prod_image, s.s_expiration, c.category_name, s.s_amount
FROM stocks s
JOIN product p ON s.s_prod_id = p.prod_id
JOIN category c ON p.prod_category_id = c.category_id
JOIN supplier spl ON spl.spl_id = s.s_spl_id
LEFT JOIN stocks_details as sd ON sd.ns_invoice = s.s_invoice
WHERE s.s_expiration != '0000-00-00' AND s.s_expiration <= DATE_ADD(NOW(), INTERVAL 30 DAY)  -- Only select products expiring within 30 days
ORDER BY s.s_expiration ASC;
";


$result = mysqli_query($connections, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}


// Check if there are any products close to expiration
if (mysqli_num_rows($result) > 0) {
  
  $i=1;
  while ($row = mysqli_fetch_assoc($result)) {
    $originalDate = $row['ns_stockin_date'];
    $timestamp = strtotime($originalDate);
    $formattedDate = date("d F Y", $timestamp);
    
    $expirationDate = strtotime($row['s_expiration']);
    $status = ($expirationDate > time()) ? "Maeexpire" : "Expired";
     
?>
<tr>
    
<td><?= $row['s_expiration']?></td>
<td><a class="viewDate" data-originalDate='<?=$formattedDate?>'><?= $formattedDate?></a></td>


<td><?= $row['s_amount'] ?></td>
<td><a href="javascript:void(0);"><?= $row['s_id']?></a></td>
<td class="productimgname">
<a class="product-img" href="productlist.html">
<img src="../../upload_prodImg/<?= $row['prod_image'] ?>" alt="product">
</a>
<a href="productlist.html"><?= $row['prod_name'] ?></a>
</td>
<td><?= $row['spl_name']?></td>
<td><?= $row['category_name'] ?></td>
 <td>

 <?php
 if($status=="Maeexpire"){
    echo '<span class="badges bg-lightyellow">Expiring Soon</span>';
 }else if($status=="Expired"){
    echo '<span class="badges bg-lightred">Expired</span>';
 }
 ?>
 </td>
<td> <button class='btn badges bg-lightred'>Remove</button></td>
</tr>
<?php 

$i+=1;
    }
    }
?>
</tbody>
</table>
</div>
</div>
</div>

<script>
    $(document).ready(function() {
        $(".viewDate").on("click", function() {
            
            var formattedDate = $(this).data("originalDate"); 


            Swal.fire({
                title: 'Purchase date',
                text: formattedDate
            });
        });
    });
</script>
