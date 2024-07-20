<div class="card mb-0">
    <div class="card-body">
        <h4 class="card-title">Stocks Critical Level</h4>
        <div class="table-responsive dataview">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th><input class="checkAll" type="checkbox" >&nbsp;&nbsp;All</th>
                        <th>Stock level</th>
                        <th>Critical level</th>
                        <th>Product</th>
                        <th>Product code</th>
                        
                        <th>Status</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $current_date = date("Y-m-d");
                    $view_query = mysqli_query($connections, "SELECT *,
                        SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', b.s_amount, 0)) AS prod_stocks
                        FROM product AS a
                        LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
                        WHERE prod_status = '0'
                        GROUP BY a.prod_id
                        ORDER BY `prod_added` DESC");

                    if (mysqli_num_rows($view_query) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($view_query)) {

                            $s_expiration = $row["s_expiration"];
                            $db_prod_id = $row["prod_id"];
                            $db_prod_code = $row["prod_code"];
                            $db_prod_name = $row["prod_name"];
                            $db_prod_currprice = $row["prod_currprice"];
                            $db_prod_stocks = $row["prod_stocks"];
                            $db_prod_code = $row["prod_code"];
                            $db_prod_category_id = $row["prod_category_id"];
                            $db_prod_description = $row["prod_description"];
                            $db_prod_image = $row["prod_image"];
                            $db_prod_added = $row["prod_added"];
                            $db_prod_edit = $row["prod_edit"];
                            $db_prod_status = $row["prod_status"];
                            $db_prod_critical = $row["prod_critical"];



                            

                            $get_recordCategory = mysqli_query($connections, "SELECT * FROM category where category_id='$db_prod_category_id'");
                            $category_row = mysqli_fetch_assoc($get_recordCategory);
                            $db_category_name = $category_row["category_name"];

                            if ($db_prod_stocks >= $db_prod_critical) {
                                $stockstatus = "Normal";
                            } else if ($db_prod_stocks <=$db_prod_critical && $db_prod_stocks >= ($db_prod_critical/2) ) {
                                $stockstatus = "Low";
                            } else if ($db_prod_stocks < ($db_prod_critical/2) && $db_prod_stocks >=1) {
                                $stockstatus = "Critical";
                            } else if ($db_prod_stocks <1) {
                                $stockstatus = "No stocks";
                            }
                            
                            

                            ?>
                            <tr>  
                                 <td><input type="checkbox" class="checked_checkbox" value="<?=$db_prod_name?>"></td>
                                <td><?= $db_prod_stocks ?></td>
                                <td><?= $db_prod_critical ?></td>
                                <td class="productimgname">

                                <a class="product-img" href="product-details.php?target_id=<?=$db_prod_code?>">
                                <img src="../../upload_prodImg/<?= $db_prod_image ?>" alt="product">
                                
                                 <?= $db_prod_name ?></a>
                                </td>
                                <td><?= $db_prod_code ?></td>
                               
                                <td>

                                <?php
                                if($stockstatus=="No stocks"){
                                    echo '<span class="badges bg-lightred">No stocks</span>';
                                }else if($stockstatus=="Critical"){
                                    echo '<span class="badges bg-lightred">Critical</span>';
                                }else if($stockstatus=="Low"){
                                    echo '<span class="badges bg-lightyellow">Low</span>';
                                }else{
                                    echo '<span class="badges bg-lightgreen">Normal</span>';
                                }
                                ?>

                                </td>

                                
                            </tr>
                            <?php
                            $i += 1;
                        }
                    }
                    ?>
                </tbody>
            </table>

           
  <button disabled id="btnAddstocks" class="btn btn-primary mt-4 addStockModalTogler"  data-bs-toggle="modal"  data-bs-target="#requestModal" data-prod_name="<?=$db_prod_name?>">Request stocks </button>
          
                               <!-- <a class="me-3 addStockModalTogler" data-bs-toggle="modal"  data-bs-target="#requestModal" data-prod_name="<?=$db_prod_name?>">
                                <img src="https://ssl.gstatic.com/ui/v1/icons/mail/rfr/logo_gmail_lockup_default_1x_r5.png" alt="img">
                                </a>--->
                           
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".viewDate").on("click", function () {
            var formattedDate = $(this).data("originalDate");
            Swal.fire({
                title: 'Purchase date',
                text: formattedDate
            });
        });
    });
</script>
