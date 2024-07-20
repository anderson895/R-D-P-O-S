<?php
include ('../config/config.php');
?>

<div class="col-12 col-md-8 mt-3 " id="category-section" >
    <div class="container border rounded  pb-2">
        <h5 class="fw-bold mt-3">Manage Categories</h5>
        <div class="row mb-2">
            <div class="col-12 col-md-8">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2">Search</button>
                </div>
            </div>
            <div class="col-12 col-md-4 justify-content-end text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-category">Add Category</button>
            </div>
        </div>
    </div>

    <div class="container border  rounded mt-3">
        <div class="table-div  mt-2">
            <table class="table">
                <thead style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
                    <tr>
                        <th scope="col" class="text-secondary" width="30%">Category Name</th>
                        <th scope="col" class="text-secondary" width="20%">Status</th>
                        <th scope="col" class="text-secondary" width="30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Your database connection code here

                    $sql = "SELECT * FROM category"; // Modify your SQL query
                    // Execute the query and fetch data
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $row_num = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $status = $row['category_status']; 

                            echo '<tr>';
                            echo '<td>' . $row['category_name'] . '</td>';
                             
                            if($status == 0){
                                echo '<td style="color: red">Disable</td>';
                            }else{
                                echo '<td style="color: green">Active</td>';
                            }
                            echo '<td>';
                            echo '<a class="btn border me-1 btn-sm">Edit</a>';
                            echo '<a class="btn border me-1 btn-sm">Delete</a>';
                            if($status == 0){
                                echo '<a class="btn border me-1 btn-sm">Enable</a>';
                            }else{
                                echo '<a class="btn border me-1 btn-sm">Disable</a>';
                            }
                            
                            echo '</td>';
                            echo '</tr>';
                            $row_num++;
                        }
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
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
        <form action="../functions/manage_categories_functions.php" method="POST" enctype="multipart/form-data">
            <input type="text" required name="name" class="form-control" placeholder="Enter category name">
            <input type="number" required name="c_level" class="form-control mt-2" placeholder="Enter critical level">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="add" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
