<?php
$prod_code = $_GET["editTarget"];


$get_record = mysqli_query($connections, "SELECT *
FROM product
LEFT JOIN category ON category.category_id = product.prod_category_id
LEFT JOIN voucher ON voucher.voucher_id = product.prod_voucher_id
WHERE prod_code = '$prod_code' ");
$row = mysqli_fetch_assoc($get_record);
$db_prod_id = $row["prod_id"];
$db_prod_code = $row["prod_code"];
$db_prod_name = $row["prod_name"];
$db_prod_orgprice = $row["prod_orgprice"];
$db_prod_currprice = $row["prod_currprice"];
$db_prod_critical = $row["prod_critical"];
$db_prod_description = $row["prod_description"];
$db_prod_image = $row["prod_image"];
$db_prod_added = $row["prod_added"];
$db_prod_mg = $row["prod_mg"];
$db_prod_ml = $row["prod_ml"];
$db_prod_g = $row["prod_g"];
$db_unit_type = $row['unit_type'];

$db_prod_sell_onlline = $row["prod_sell_onlline"];
$db_prod_vatable = $row["prod_vatable"];



$db_prod_category_id = $row["prod_category_id"];
$db_prod_voucher_id = $row["prod_voucher_id"];


$db_category_name = $row["category_name"];
$db_voucher_name = $row["voucher_name"];

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d g:i:s A');
?>

<form method="POST" enctype="multipart/form-data">
  <div class="page-wrapper">
    <div class="content">
      <div class="page-header">
        <div class="page-title">
          <h4>Product Edit</h4>
          <h6>Update your product</h6>
        </div>
      </div>
      <input hidden type="text" id="acc_id" name="acc_id" value="<?= $db_acc_id ?>">
      <input hidden type="text" id="prod_code" name="prod_code" value="<?= $prod_code ?>">

      <div class="card">
        <div class="card-body">
          <div class="row">



            <div class="col-lg-4 col-sm-6 col-12=">
              <div class="form-group col-12"> <!-- Adjusted the width to col-8 -->
                <label>Product Name</label>
                <input type="text" placeholder="Product name" value="<?= $db_prod_name ?>" name="pname" id="pname">
                <div style="display:none;" class="alert alert-danger" id="errorPname"></div>
              </div>
            </div>









            <div class="col-lg-4 col-sm-6 col-12">
              <div class="text-center">
                <div class="form-group">
                  <label for="pcat">Category</label>
                  <select class="select" name="pcat" id="pcat">
                    <option>Choose Category</option>
                    <?php
                    $view_query = mysqli_query($connections, "SELECT * from category where category_status='1' ");

                    while ($row = mysqli_fetch_assoc($view_query)) {

                      $category_id = $row["category_id"];
                      $category_name = $row["category_name"];
                    ?>
                      <option <?php if ($db_prod_category_id == $category_id) {
                                echo "selected";
                              } ?> value='<?= $category_id ?>'><?= $category_name ?></option>
                    <?php } ?>
                  </select>
                  <div style="display:none;" class="alert alert-danger" id="categoryError"></div>
                </div>
              </div>
            </div>



            <div class="col-lg-4 col-sm-6 col-12">
              <div class="text-center">
                <div class="form-group">
                  <label>Critical level</label>
                  <input type="text" placeholder="Critical Level" name='pcritical' id="pcritical" value="<?= $db_prod_critical ?>">
                  <div style="display:none;" class="alert alert-danger " id="criticalError"></div>
                </div>
              </div>
            </div>



            <div class="col-lg-12">
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name='pDescript' id="pDescript"><?= $db_prod_description ?></textarea>
                <div style="display:none;" class="alert alert-danger" id="descriptionError"></div>
              </div>
            </div>




            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label>Current price</label>
                <input type="text" placeholder="Current price" name="pCprice" id="pCprice" value="<?= $db_prod_currprice ?>">
                <div style="display:none;" class="alert alert-danger" id="CpriceError"></div>
              </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label>Unit Type</label>
                <select class="form-control" name="unitType" id="unitType">
                  <option>Choose Unit type</option>

<!-- 
                  <option value="kg" <?= ($db_unit_type == 'kg') ? 'selected' : '' ?>>Kg</option>
                  <option value="pcs" <?= ($db_unit_type == 'pcs') ? 'selected' : '' ?>>Pcs</option> -->
                  <?php
                    $view_query = mysqli_query($connections, "SELECT * from unit where unit_status='2' ");

                    while ($row = mysqli_fetch_assoc($view_query)) {
                      $unit_id = $row["unit_id"];
                      $unit_name = $row["unit_name"];
                    ?>
                      <option <?= ($db_unit_type == $unit_name) ? 'selected' : '' ?> value='<?= $unit_name ?>'><?= $unit_name ?></option>
                    <?php } ?>

                </select>
                <div style="display:none;" class="alert alert-danger" id="unitTypeError"></div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label style="text-align: left;"> Product Image</label>
                <div class="image-upload">
                  <input type="file" name="pImg" id="pImg">
                  <div class="image-uploads">
                    <img src="assets/img/icons/upload.svg" alt="img">
                    <h4 style="text-align: left;">Drag and drop a file to upload</h4>
                    <div style="display:none; text-align: left;" class="alert alert-danger" id="pImgError"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="product-list">
                <ul class="row">
                  <li>
                    <div class="productviews">
                      <div class="productviewsimg">
                        <?php
                        if ($db_prod_image) {
                          echo '<img id="productImagePreview" src="../../upload_prodImg/' . $db_prod_image . '" alt="img">';
                        } else {
                          echo '<img id="productImagePreview" src="#" alt="img">';
                        } ?>

                      </div>

                      <div class="productviewscontent">
                        <div class="productviewsname">
                          <h2><?= $db_prod_image ?></h2>

                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>






            <div class="col-lg-4 col-sm-6 col-12 mt-4">
              <div class="row">
                <div class="form-group col-4">
                  <label>mg</label>
                  <input type="number" class="form-control" value="<?= $db_prod_mg ?>" id="mg" min="0" max="1000">
                  <div style="display:none;" class="alert alert-danger" id="errorMg"></div>
                </div>

                <div class="form-group col-4">
                  <label>ml</label>
                  <input type="number" class="form-control" value="<?= $db_prod_ml ?>" id="ml" min="0" max="1000">
                  <div style="display:none;" class="alert alert-danger" id="errorMl"></div>
                </div>

                <div class="form-group col-4">
                  <label>g</label>
                  <input type="number" class="form-control" value="<?= $db_prod_g ?>" id="g" min="0" max="1000">
                  <div style="display:none;" class="alert alert-danger" id="errorG"></div>
                </div>
              </div>
            </div>






            <div class="col-lg-12 col-sm-6 col-12 mb-4">
              <label>Sell Online</label>
              <div class="status-toggle d-flex justify-content-between align-items-center">
                <input type="checkbox" id="SellOnlineTogler" class="check" <?php if ($db_prod_sell_onlline == "1") {
                                                                              echo "checked";
                                                                            } ?>>
                <label for="SellOnlineTogler" class="checktoggle">checkbox</label>
              </div>
            </div>


            <div class="d-flex justify-content-center" >
              <div class="spinner-border" role="status" style="display:none;">
                <span class="sr-only" >Loading...</span>
              </div>
            </div>


            <div class="col-lg-12">
              <button type="submit" class="btn btn-submit me-2" name="btnSubmit" disabled id='btnSubmit'>Save</button>
              <a href="productlist.php" class="btn btn-cancel">Back</a>
            </div>
          </div>
        </div>
      </div>
</form>

<script>
  $(document).ready(function() {
    $("#btnSubmit").on("click", function(event) {
      event.preventDefault(); // Prevent the default form submission

      // Show loading spinner
      $(".spinner-border").css("display", "block"); // Use flex for centering
      $(".btn-submit").prop("disabled", true); // Correct way to disable the button

      // All validations passed, send an AJAX request
      var acc_id = $("#acc_id").val();
      var prod_code = $("#prod_code").val();
      var pname = $("#pname").val();
      var pcat = $("#pcat").val();
      var pcritical = $("#pcritical").val();
      var pDescript = $("#pDescript").val();
      var pCprice = $("#pCprice").val();

      var discountableTogler = $("#discountableTogler").prop("checked") ? 1 : 0;
      var SellOnlineTogler = $("#SellOnlineTogler").prop("checked") ? 1 : 0;

      var mg = $("#mg").val();
      var ml = $("#ml").val();
      var g = $("#g").val();
      var unitType = $('#unitType').val();

      var formData = new FormData();

      formData.append("acc_id", acc_id);
      formData.append("prod_code", prod_code);
      formData.append("pname", pname);
      formData.append("pcat", pcat);
      formData.append("pcritical", pcritical);
      formData.append("pDescript", pDescript);
      formData.append("pCprice", pCprice);
      formData.append("discountableTogler", discountableTogler);
      formData.append("SellOnlineTogler", SellOnlineTogler);
      formData.append("mg", mg);
      formData.append("ml", ml);
      formData.append("g", g);
      formData.append("unitType", unitType);
      formData.append("pImg", $("#pImg")[0].files[0]); // Append the image file

      // Send the AJAX request only if the form is valid
      $.ajax({
        url: "editproduct/controller/updateproduct.php", // Replace with the actual PHP script URL
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          console.log(response);
          alertify.success("Product successfully saved.");
        },
        error: function(xhr, status, error) {
          console.log("Error:", error);
        },
        complete: function() {
          // Hide loading spinner after the request completes
          $(".spinner-border").css("display", "none");
          $(".btn-submit").prop("disabled", false); // Re-enable the button
        }
      });
    });
  });
</script>





<script src='editproduct/controller/validation.js'></script>