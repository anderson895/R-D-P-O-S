<?php
$prod_name = $prod_orgprice = $prod_currprice = $prod_unit = $prod_category = $prod_description = $prod_image =$prod_expiration= "";
$prod_nameErr = $prod_orgpriceErr = $prod_currpriceErr = $prod_unitErr = $prod_categoryErr = $prod_descriptionErr = $prod_imageErr = $prod_expiration="";

if (isset($_POST["btnAddProduct"])) {

  
    // Product name
    if (empty($_POST["prod_name"])) {
        $prod_nameErr = "Product name is required!";
    } else {
        
        if (strlen($_POST["prod_name"]) < 3) {
            $prod_nameErr = "Product name is too short!";
        }else{
            $prod_name = $_POST["prod_name"];
        }
    }

    // Product original price
    if (empty($_POST["prod_orgprice"])) {
        $prod_orgpriceErr = "Product original price is required!";
    } else {
        $prod_orgprice = $_POST["prod_orgprice"];
    }

    // Product current price
    if (empty($_POST["prod_currprice"])) {
        $prod_currpriceErr = "Product current price is required!";
    } else {
        $prod_currprice = $_POST["prod_currprice"];
    }

   

    // Product unit
    if (empty($_POST["prod_unit"])) {
        $prod_unitErr = "Product unit is required!";
    } else {
        $prod_unit = $_POST["prod_unit"];
    }

    // Product category
    if (empty($_POST["prod_category"])) {
        $prod_categoryErr = "Product category is required!";
    } else {
        $prod_category = $_POST["prod_category"];
    }

    // Prod_description
    $prod_description = mysqli_real_escape_string($connections, $_POST["prod_description"]);

    // File upload handling
 
        $targetDirectory = "../../upload_prodImg/"; // Specify the directory where you want to save the uploaded image
        $filename = basename($_FILES["prod_image"]["name"]);
        $targetFile = $targetDirectory . $filename;

        if($prod_name&&$prod_orgprice&&$prod_currprice&&$prod_unit&&$prod_category ){
        // Move the uploaded file to the desired location
        if (move_uploaded_file($_FILES["prod_image"]["tmp_name"], $targetFile)) {
            $prod_image = $filename;
        } else {
            $prod_imageErr = "Failed to upload the image!";
        }
        
    

    // Insert the data into the database
    // Check if the product name already exists in the database
$checkQuery = mysqli_query($connections, "SELECT * FROM product WHERE prod_name='$prod_name'");
if (mysqli_num_rows($checkQuery) > 0) {
  // Product name already exists, handle accordingly (e.g., display an error message)
    $prod_nameErr="Product name not available";



} else {
    // Regular expression pattern to validate the price format (allows only numbers and a decimal point)
    $pricePattern = '/^\d+(\.\d+)?$/';
  // Product name doesn't exist, proceed with the insertion
                    if (!preg_match($pricePattern, $prod_orgprice) ) {
                        $prod_orgpriceErr= "Invalid format. Please enter a valid price.";
                    } else {

                                if (!preg_match($pricePattern, $prod_currprice)) {
                                    $prod_currpriceErr= "Invalid format. Please enter a valid price.";
                                } else {
                                  
                                                date_default_timezone_set('Asia/Manila');
                                                $currentDateTime = date('Y-m-d g:i:s A');

                                               // echo "Current Manila Time: " . $currentDateTime;
                                            //generate Transaction Code
                                            $length = 5; // Desired length of the code
                                            $code = '';
                                            
                                            for ($i = 0; $i < $length; $i++) {
                                                $code .= mt_rand(0, 9); // Append a random number between 0 and 9
                                            }

                                    
                                            mysqli_query($connections, "INSERT INTO product(prod_code,prod_name, prod_orgprice, prod_currprice, prod_unit_id, prod_category_id, prod_description, prod_image,prod_added)
                                            VALUES('PROD$code','$prod_name', '$prod_orgprice', '$prod_currprice', '$prod_unit', '$prod_category', '$prod_description', '$prod_image','$currentDateTime')");
                                            echo '
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                                            <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                swal({
                                                    title: "Success!",
                                                    text: "Add Product Successful",
                                                    icon: "success",
                                                    html: true
                                                }).then((value) => {
                                                    if (value) {
                                                        window.location.href = "inventory.php";
                                                        // Display the print receipt code here
                                                       
                                                    } else {
                                                        window.location.reload();
                                                    }
                                                });
                                            });
                                            </script>
                                        ';


                                        }
      }
    }
}
       
       // "<script>window.location.href='../';</script>
    
}









//function for edit product

if (isset($_POST["btnEditProduct"])) {
    // Product ID//prod_code

     $local_accid=$_POST["accid"];
     $product_code=$_POST["prod_code"];
    $prod_id = $_REQUEST["item_code"];
  
    // Product name
    if (empty($_POST["prod_name"])) {
        $prod_nameErr = "Product name is required!";
    } else {
        if (strlen($_POST["prod_name"]) < 3) {
            $prod_nameErr = "Product name is too short!";
        } else {
            $prod_name = $_POST["prod_name"];
        }
    }

    // Product original price
    if (empty($_POST["prod_orgprice"])) {
        $prod_orgpriceErr = "Product original price is required!";
    } else {
        $prod_orgprice = $_POST["prod_orgprice"];
    }

    // Product current price
    if (empty($_POST["prod_currprice"])) {
        $prod_currpriceErr = "Product current price is required!";
    } else {
        $prod_currprice = $_POST["prod_currprice"];
    }

   

    // Product unit
    if (empty($_POST["prod_unit"])) {
        $prod_unitErr = "Product unit is required!";
    } else {
        $prod_unit = $_POST["prod_unit"];
    }

    // Product category
    if (empty($_POST["prod_category"])) {
        $prod_categoryErr = "Product category is required!";
    } else {
        $prod_category = $_POST["prod_category"];
    }

    // Prod_description
    $prod_description = $_POST["prod_description"];

    // File upload handling
    $targetDirectory = "../../upload_prodImg/"; // Specify the directory where you want to save the uploaded image

    if ($_FILES["prod_image"]["size"] > 0) {
        $filename = basename($_FILES["prod_image"]["name"]);
        $targetFile = $targetDirectory . $filename;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($_FILES["prod_image"]["tmp_name"], $targetFile))
        {
            $prod_image = $filename;
        } else 
        {
            $prod_imageErr = "Failed to upload the image!";
        }
    }

    if ($prod_name && $prod_orgprice && $prod_currprice && $prod_unit && $prod_category) {
        // Update the data in the database
        // Check if the product name already exists in the database (excluding the current product)
        $checkQuery = mysqli_query($connections, "SELECT * FROM product WHERE prod_name='$prod_name' AND prod_id != '$prod_id'");
        if (mysqli_num_rows($checkQuery) > 0) {
            // Product name already exists, handle accordingly (e.g., display an error message)
            $prod_nameErr = "Product name not available";
            echo '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "Success!",
                    text: "Add product succesfully",
                    icon: "success",
                    html: true
                }).then((value) => {
                    if (value) {
                        window.location.href = "inventory.php";
                    } else {
                        window.location.reload();
                    }
                });
            });
            </script>
            ';
        } else {
            // Regular expression pattern to validate the price format (allows only numbers and a decimal point)
            $pricePattern = '/^\d+(\.\d+)?$/';
            if (!preg_match($pricePattern, $prod_orgprice)) {
                $prod_orgpriceErr = "Invalid format. Please enter a valid price.";
            } elseif (!preg_match($pricePattern, $prod_currprice)) {
                $prod_currpriceErr = "Invalid format. Please enter a valid price.";
            } else {
                date_default_timezone_set('Asia/Manila');
                $currentDateTime = date('Y-m-d g:i:s A');

                // Check if an image was uploaded
                // Check if an image was uploaded
if (isset($prod_image) && $_FILES["prod_image"]["size"] > 0) {
    // Include prod_image in the update query
    mysqli_query($connections, "UPDATE product SET prod_name='$prod_name', prod_orgprice='$prod_orgprice', prod_currprice='$prod_currprice', prod_unit_id='$prod_unit', prod_category_id='$prod_category', prod_description='$prod_description', prod_image='$prod_image', prod_edit='$currentDateTime' WHERE prod_id='$prod_id'");
} else {
    // Exclude prod_image from the update query
   
// Assuming you have already established the $connections variable for the database connection

// Prepare the SQL statement with parameter placeholders
$query = "UPDATE product SET prod_name=?, prod_orgprice=?, prod_currprice=?, prod_unit_id=?, prod_category_id=?, prod_description=?, prod_edit=? WHERE prod_id=?";

// Prepare the statement
$stmt = mysqli_prepare($connections, $query);

// Bind the parameters
mysqli_stmt_bind_param($stmt, "ssssssss", $prod_name, $prod_orgprice, $prod_currprice, $prod_unit, $prod_category, $prod_description, $currentDateTime, $prod_id);

// Execute the statement
mysqli_stmt_execute($stmt);

// Check for any errors
if (mysqli_stmt_errno($stmt)) {
    echo "Error: " . mysqli_stmt_error($stmt);
} else {
    $Errmessage= "Update successful";
}

// Close the statement and database connection
mysqli_stmt_close($stmt);


}


                    echo '
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                    <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success!",
                            text: "Update product succesfully",
                            icon: "success",
                            html: true
                        }).then((value) => {
                            if (value) {
                                window.location.href = "inventory.php";
                            } else {
                                window.location.reload();
                            }
                        });
                    });
                    </script>
                    ';
                        ////log
                date_default_timezone_set('Asia/Manila');
                $currentDateTime = date('Y-m-d g:i A');


                mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
                VALUES('$local_accid', 'UPDATE PRODUCT CODE :$product_code', '$currentDateTime')");
                ///end log
                }
        }
    }
}

$s_id="";
/**
 * <?= $acc_id_stock?>
 * 
 */
if(isset($_POST['btnArchiveStocks'])){
    $acc_id=$_POST["acc_id"];
    $s_id=$_POST["s_id"];
    $db_prod_name_val=$_POST["db_prod_name_val"];



    if($s_id){
    mysqli_query($connections, "DELETE from stocks  WHERE s_id='$s_id'");

        ////log
        //date_default_timezone_set('Asia/Manila');
        //$currentDateTime = date('Y-m-d g:i A');

      //  mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
       // VALUES('$acc_id', 'REMOVE STOCKS in $db_prod_name_val', '$currentDateTime')");
        //log
    }else{
    echo "<script>alert('Error')</script>";
    }
}


$db_prod_id=$db_prod_name="";

if(isset($_POST['btnRestore'])){
    
        $acc_id=$_POST["acc_id"];
        $db_prod_id=$_POST["db_prod_id"];
        $db_prod_name=$_POST["db_prod_name"];

    if($acc_id && $db_prod_id && $db_prod_name){
    $sql = "UPDATE product SET prod_status = 0 WHERE prod_id = '$db_prod_id'";

    ////log
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d g:i A');


    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
    VALUES('$acc_id', 'RESTORE PRODUCT:$db_prod_name', '$currentDateTime')");
    ///end log
   if (mysqli_query($connections, $sql)) {
    echo '
   
    <script>
    
                window.location.href = "archive_lis.php";
           
    </script>
';
} else {
    echo "Error updating prod_status: " . mysqli_error($connections);
}
exit;


    }else{
        echo "Error";
    }
}



?>
