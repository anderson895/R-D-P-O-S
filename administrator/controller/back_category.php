<?php
include("../../connection.php");

$category_name = $critical_level = "";
$category_nameErr = $critical_levelErr = "";

if (isset($_POST["btn_save_category"])) {
    if (empty($_POST["category_name"])) {
        $category_nameErr = "Category Name is required!";
    } else {
        $category_name = $_POST["category_name"];
    }

    if (empty($_POST["critical_level"])) {
        $critical_levelErr = "Critical Level is required!";
    } elseif (!is_numeric($_POST["critical_level"])) {
        $critical_levelErr = "Critical Level must be a number!";
    } else {
        $critical_level = $_POST["critical_level"];
    }

    if ($category_name && $critical_level) {

        $check_category = mysqli_query($connections, "SELECT * from category WHERE category_name='$category_name'");
        $check_category_row = mysqli_num_rows($check_category);

        if ($check_category_row > 0) {
            $category_nameErr = "Category Name already exists!";
        } else {
            $query = "INSERT INTO category (category_name, critical_level, category_status) VALUES (?, ?, '1')";
            $stmt = mysqli_prepare($connections, $query);
            mysqli_stmt_bind_param($stmt, "sd", $category_name, $critical_level);
            mysqli_stmt_execute($stmt);

            echo '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "Success!",
                    text: "Add new Category Success",
                    icon: "success",
                    html: true
                })
            });
            </script>
            
            ';
        }
    }
}


if (isset($_POST["btn_disable"])) {
    $category_id = $_POST['category_id'];
  

    // Perform the database update
    $query = "UPDATE `category` SET `category_status` = '0' 
              WHERE `category_id` = '$category_id'";
  
    // Prepare the update statement
    if (mysqli_query($connections, $query)) {
    
     
    } else {
      echo "Error updating record: " . mysqli_error($connections);
    }
}


if (isset($_POST["btn_enable"])) {
    $category_id = $_POST['category_id'];

    // Perform the database update
    $query = "UPDATE `category` SET `category_status` = '1' 
              WHERE `category_id` = '$category_id'";
  
    // Prepare the update statement
    if (mysqli_query($connections, $query)) {
    
     
    } else {
      echo "Error updating record: " . mysqli_error($connections);
    }
}



if (isset($_POST["btn_remove_category"])) {
    $category_id_remove = $_POST['category_id'];

    $check_prod_unit_id = mysqli_query($connections, "SELECT * FROM product WHERE prod_category_id ='$category_id_remove'");
    $products_connected = array();

    while ($check_prod_unit_id_row = mysqli_fetch_assoc($check_prod_unit_id)) {
        $products_connected[] = $check_prod_unit_id_row["prod_name"];
    }

    if (!empty($products_connected)) {
        $products_list = implode(", ", $products_connected);
        echo '
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            swal({
                title: "Error!",
                text: "Can\'t Remove Category Because It\'s Currently Connected to the following products: \n' . $products_list . '",
                icon: "error",
                html: true
            })
        });
        </script>
        ';
    } else {
        // Perform the database update
        $query = "DELETE FROM `category` WHERE `category_id` = '$category_id_remove'";

        // Execute the delete statement
        if (mysqli_query($connections, $query)) {
            // Deletion successful
            echo '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "Success!",
                    text: "Remove Category Success",
                    icon: "success",
                    html: true
                })
            });
            </script>
            
            ';
        } else {
            echo "Error deleting record: " . mysqli_error($connections);
        }
    }
}



?>
