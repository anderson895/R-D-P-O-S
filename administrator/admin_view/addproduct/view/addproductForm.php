<form id="productForm" method="POST" enctype="multipart/form-data">

  <div class="page-wrapper">
    <div class="content">
      <div class="page-header">
        <div class="page-title">
          <h4>Product Add</h4>
          <h6>Create new product</h6>
        </div>
      </div>
      <input hidden type="text" value="<?= $db_acc_id ?>" name="acc_id" id="acc_id">
      <div class="card">
        <div class="card-body">
          <div class="row">



            <div class="col-lg-4 col-sm-6 col-12=">
              <div class="form-group col-12">
                <label for="pcat">Product name</label>
                <input type="text" placeholder="Product name" name="pname" id="pname">
                <div style="display:none;" class="alert alert-danger" id="errorPname"></div>
              </div>
            </div>









            <div class="col-lg-4 col-sm-6 col-12">
              <div class="text-center">
                <div class="form-group">
                  <label for="pcat">Category</label>
                  <select class="form-control" name="pcat" id="pcat">
                    <option>Choose Category</option>
                    <?php
                    $view_query = mysqli_query($connections, "SELECT * from category where category_status='1' ");

                    while ($row = mysqli_fetch_assoc($view_query)) {
                      $category_id = $row["category_id"];
                      $category_name = $row["category_name"];
                    ?>
                      <option value='<?= $category_id ?>'><?= $category_name ?></option>
                    <?php } ?>
                  </select>
                  <div style="display:none;" class="alert alert-danger" id="categoryError"></div>
                </div>
              </div>
            </div>



            <div class="col-lg-4 col-sm-6 col-12">
              <div class="text-center">
                <div class="form-group">
                  <label for="pcritical">Critical level</label>
                  <input type="text" class="form-control" placeholder="Critical Level" name="pcritical" id="pcritical">
                  <div class="alert alert-danger " id="criticalError"></div>
                </div>
              </div>
            </div>









            <div class="col-lg-12">
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name='pDescript' id="pDescript"></textarea>
                <div style="display:none;" class="alert alert-danger" id="descriptionError"></div>
              </div>
            </div>






            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label>Current price</label>
                <input type="text" placeholder="Current price" name="pCprice" id="pCprice">
                <div style="display:none;" class="alert alert-danger" id="CpriceError"></div>
              </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label>Unit Type</label>
                <select class="form-control" name="unitType" id="unitType">
                  <option>Choose Unit type</option>
                  <option value="kg">Kg</option>
                  <option value="pcs">Pcs</option>
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
              <img id="productImagePreview" src="#" alt="Product Image Preview" style="display: none; max-width: 200px; max-height: 200px;">
            </div>




            <div class="col-lg-12 col-sm-6 col-12 mt-4">
              <div class="row">
               

                <div class="form-group col-4">
                  <label>ml</label>
                  <input type="number" class="form-control" placeholder="0" id="ml" min="0" max="1000">
                  <div style="display:none;" class="alert alert-danger" id="errorMl"></div>
                </div>

                <div class="form-group col-4">
                  <label>g</label>
                  <input type="number" class="form-control" placeholder="0" id="g" min="0" max="1000">
                  <div style="display:none;" class="alert alert-danger" id="errorG"></div>
                </div>

                <div class="form-group col-4">
                  <label>mg</label>
                  <input type="number" class="form-control" placeholder="0" id="mg" min="0" max="1000">
                  <div style="display:none;" class="alert alert-danger" id="errorMg"></div>
                </div>
              </div>
            </div>






            <div class="col-lg-4 col-sm-6 col-12 mt-4">
              <div class="form-group">
                <label>Expiration</label>
                <select class="select" name="expirationStatus" id="expirationStatus">
                  <option value='N/A'>N/A</option>
                  <option value='withExpi'>With Expiration</option>
                </select>
                <div style="display:none;" class="alert alert-danger" id="vouchError"></div>
              </div>
            </div>



            <div class="col-lg-12 col-sm-6 col-12 mb-4">
              <label>Sell Online</label>
              <div class="status-toggle d-flex justify-content-between align-items-center">
                <input checked type="checkbox" id="SellOnlineTogler" class="check">
                <label for="SellOnlineTogler" class="checktoggle">checkbox</label>
              </div>
            </div>





            <div class="col-lg-12 col-sm-6 col-12">
              <canvas id="imageCanvas" style="display: none;"></canvas>
              <br><br>
              <div class="col-lg-12">
                <div id="loadingSpinner"></div>
                <button type="submit" class="btn btn-submit me-2" name="btnSubmit" disabled id='btnSubmit'>Submit</button>
                <button class="btn btn-cancel" id="backBtn" onclick="window.location.href='productlist.php'">Back</button>

              </div>


            </div>

          </div>
        </div>

</form>


<script>
  $("#btnSubmit").on("click", function(event) {
    event.preventDefault(); // Prevent the default form submission

    var acc_id = $("#acc_id").val();
    var pname = $("#pname").val();
    var expirationStatus = $("#expirationStatus").val();

    //expirationStatus

    // var vatableTogler = $("#vatableTogler").prop("checked") ? 1 : 0;

    var SellOnlineTogler = $("#SellOnlineTogler").prop("checked") ? 1 : 0;


    var mg = $("#mg").val();
    var ml = $("#ml").val();
    var g = $("#g").val();

    var unitType = $('#unitType').val();

    var unit = $("#unit").val();
    var pcat = $("#pcat").val();
    var pcritical = $("#pcritical").val();
    var pDescript = $("#pDescript").val();
    var pVouch = $("#pVouch").val();
    var pCprice = $("#pCprice").val();
    var formData = new FormData();
    // formData.append("vatableTogler", vatableTogler);
    formData.append("SellOnlineTogler", SellOnlineTogler);
    formData.append("pname", pname);
    formData.append("unitType", unitType);
    formData.append("mg", mg);
    formData.append("ml", ml);
    formData.append("g", g);
    formData.append("pcat", pcat);
    formData.append("pcritical", pcritical);
    formData.append("pDescript", pDescript);
    formData.append("pVouch", pVouch);
    formData.append("pCprice", pCprice);
    formData.append("acc_id", acc_id);
    formData.append("expirationStatus", expirationStatus);
    formData.append("pImg", $("#pImg")[0].files[0]); // Append the image file


    $("#backBtn").css("display", "none");
    $("#btnSubmit").css("display", "none");
    // Send the AJAX request only if the form is valid
    $.ajax({
      url: "addproduct/controller/insertProduct.php", // Replace with the actual PHP script URL
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        // Handle the success response here
        alertify.success("Form successfully submitted.");
        console.log(response);

      },

      beforeSend: function() {
        $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
      },


      error: function(xhr, status, error) {
        // Handle the error here
        alertify.error("An error occurred: " + error);
        console.log(response);
      },
      complete: function() {

        $("#loadingSpinner").hide();
        $("#btnSubmit").css("display", "block");
        $("#backBtn").css("display", "block");
        window.location.href = "productlist.php";
      }
    });
  });
</script>

<script src='addproduct/controller/validation.js'></script>