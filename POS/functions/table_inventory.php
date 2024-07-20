

<?php
include('../config/config.php');

$sql = "SELECT product.prod_id, product.prod_code, product.prod_added, product.prod_name, product.barcode,
        product.prod_currprice, product.prod_critical, product.prod_description, product.prod_category_id, product.prod_unit_id,
        COALESCE(stock_total.total_stock_amount, 0) AS total_stock_amount
        FROM product
        LEFT JOIN (
            SELECT s_prod_id, SUM(s_amount) AS total_stock_amount
            FROM stocks
            GROUP BY s_prod_id
        ) AS stock_total
        ON product.prod_id = stock_total.s_prod_id
        WHERE product.prod_status = 0
        ORDER BY product.prod_added DESC;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<tr class='clickable-row row-select' data-href='view_product.php?product_code=". $row["prod_id"] ."'>
                    <td>" . $row["prod_code"] . "</td>
                    <td>" . $row["prod_added"] . "</td>
                    <td>" . $row["prod_name"] . "</td>
                    <td>" . $row["total_stock_amount"] . "</td>
                    <td><img src='../../upload_barcode/" . $row["barcode"] . "' style='width: 100%; height: 25px'></td>
                    <td>
                        <button style='background-color: white' class='btn w-25 edit-product btn-sm border' 
                            data-id='" . $row['prod_id'] . "'
                            data-name='" . $row['prod_name'] . "'
                            data-currprice='" . $row['prod_currprice'] . "'
                            data-clevel='" . $row['prod_critical'] . "'
                            data-description='" . $row['prod_description'] . "'
                            data-cat_id='" . $row['prod_category_id'] . "'
                            data-unit_id='" . $row['prod_unit_id'] . "'
                        >Edit</button>


                        
                        <button style='background-color: white' class='btn w-25 delete btn-sm border' data-pcode='" . $row['prod_code'] . "'>Delete</button>
                    </td>
                </tr>";

    }

    //<button style='background-color: white' class='btn w-25 add-product btn-sm border' data-add='" . $row['prod_id'] . "'>Add</button>

    echo "</table>";
} else {
    echo "<tr>
    <td colspan='6'>Empty table please add product.</td>
    </tr>";
}
?>

<!-- Modal Add -->
<div class="modal fade mt-4" id="add_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Add Stocks</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="../functions/add_stocks.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="add" name="prod_id">
            <input type="number" required class="form-control" placeholder="Enter amount" name="amount">
            <input type="date" required class="form-control mt-2" name="date" min="<?php echo date('Y-m-d'); ?>">
              </div>
              <div class="modal-footer justify-content-end">
                  <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary w-25" id="delete-button">Yes</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade mt-4" id="edit_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Edit Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                  <form action="../functions/edit_product.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" id="id" required class="form-control" name="id">
                <input type="text" id="name" required class="form-control" placeholder="Product Name" name="name">
                <input type="text" id="currprice" required class="form-control mt-2" name="r_price" placeholder="Current Price" oninput="validateDecimalInput(this)" min="1">
                <div class="row">
                    <div class="col-12 col-md-6 mt-2">
                        <div class="dropdown">
                          <button class="btn w-100 btn border border-1 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Select Category
                          </button>

                          <ul class="dropdown-menu w-100" style="max-height: 80px; overflow-y: auto;">
                              <?php
                              // Assuming you have a database connection established
                              $sql = "SELECT * FROM `category`";
                              $result = mysqli_query($conn, $sql);

                              if ($result) {
                                  while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<li><a class="dropdown-item" href="#"><input type="radio" name="category" value="' . $row['category_id'] . '">' . $row['category_name'] . '</a></li>';
                                  }
                              } else {
                                  echo 'Error: ' . mysqli_error($conn);
                              }
                              ?>
                          </ul>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                    <div class="dropdown">
                          <button class="btn w-100 btn border border-1 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Select Unit
                          </button>

                          <ul class="dropdown-menu w-100" style="max-height: 80px; overflow-y: auto;">
                              <?php
                              // Assuming you have a database connection established
                              $sql = "SELECT * FROM `unit`";
                              $result = mysqli_query($conn, $sql);

                              if ($result) {
                                  while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<li><a class="dropdown-item" href="#"><input type="radio" name="unit" value="' . $row['unit_id'] . '">' . $row['unit_name'] . '</a></li>';
                                  }
                              } else {
                                  echo 'Error: ' . mysqli_error($conn);
                              }
                              ?>
                          </ul>
                      </div>
                    </div>
                        </div>
                        <input type="number" required class="form-control mt-2" id="clevel" name="c_level" placeholder="Critical Level" min="1">
                        <input class="form-control mt-2" type="file" id="formFile" name="img">
                        <input type="text" required class="form-control mt-2" id="description" placeholder="Description" name="description">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="save" class="btn btn-primary w-25">Save</button>
                        </div>
                    </form>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade mt-4" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Are you sure you want to delete?</h1>
            <form action="../functions/delete_inventory.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="pcode" name="pcode">
              </div>
              <div class="modal-footer justify-content-end">
                  <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary w-25" id="delete-button">Save</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../assets/js/edit_modal.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function validateDecimalInput(input) {
  const value = input.value;
  // Use a regular expression to check for a valid decimal number
  if (/^[0-9]*\.?[0-9]*$/.test(value)) {
    // Input is a valid decimal number
    input.setCustomValidity('');
  } else {
    // Input is not a valid decimal number
    input.setCustomValidity('Please enter a valid decimal number.');
  }
}
</script>

<script>
    $(document).ready(function() {
        $(".clickable-row").click(function(event) {
            // Check which element was clicked within the row
            var clickedElement = event.target;

            // If the clicked element is a button, do not navigate
            if ($(clickedElement).is("button")) {
                return;
            }

            // Otherwise, navigate to the specified URL
            window.location = $(this).data("href");
        });
    });
</script>





