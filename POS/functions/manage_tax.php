<?php
include ('../config/config.php');
?>

<div class="col-12 col-md-8 mt-3 " id="tax-section" style="display: none;">
    <div class="container border rounded pb-2 h-25">
        <h5 class="fw-bold mt-3 mb-3">Manage Tax</h5>
        <div class="row mb-2">

        <?php
                    // Your database connection code here

                    $sql = "SELECT maintinance.system_tax FROM maintinance WHERE system_id = 1;"; // Modify your SQL query
                    // Execute the query and fetch data
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $row_num = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tax = $row["system_tax"];
                            $tax = $tax * 100;
                            $taxPercentage = $tax;

                        }
                    }

                    // Close the database connection
                    mysqli_close($conn);
        ?>
        <div class="col-12 col-md-12">
            <div id="edit-section">
                <div class="input-group mb-3 ">
                    <label for="inputField" class="form-control" id="taxLabel"><?php echo $taxPercentage . "%"; ?></label>
                    <button class="btn border" type="button" id="edit">Edit</button>
                </div>
            </div>
            <div id="save-section" style="display: none;">
            <div class="input-group mb-3"  >
                <input type="text" class="form-control" id="taxInput" placeholder="<?php echo $tax; ?>">
                <button class="btn border btn-success" type="button" id="save">Save</button>
            </div>
            </div>
        </div>

        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="add-category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog mt-5">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>