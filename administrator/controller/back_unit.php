<?php
include("../../connection.php");

$unit_name = "";
$unit_nameErr = "";

if (isset($_POST["btn_save_category"])) {
    if (empty($_POST["unit_name"])) {
        $unit_nameErr = "Enter Unit Name!";
    } else {
        $unit_name = $_POST["unit_name"];
    }

    if ($unit_name) {
        $check_unit = mysqli_query($connections, "SELECT * FROM unit WHERE unit_name='$unit_name'");
        $check_unit_row = mysqli_num_rows($check_unit);

        if ($check_unit_row > 0) {
            $unit_nameErr = "Unit Name already exists!";
        } else {
            $query = "INSERT INTO unit (unit_name, unit_status) VALUES (?, '1')";
            $stmt = mysqli_prepare($connections, $query);
            mysqli_stmt_bind_param($stmt, "s", $unit_name);
            mysqli_stmt_execute($stmt);

            echo '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "Success!",
                    text: "Add Unit Successful",
                    icon: "success",
                    html: true
                }).then((value) => {
                    if (value) {
                        window.location.href = "manageunit.php";
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

if (isset($_POST["btn_disable_unit"])) {
    $unit_id = $_POST['unit_id'];

    // Perform the database update
    $query = "UPDATE `unit` SET `unit_status` = '0' 
              WHERE `unit_id` = '$unit_id'";

    // Prepare the update statement
    if (mysqli_query($connections, $query)) {
        // Update successful
    } else {
        echo "Error updating record: " . mysqli_error($connections);
    }
}


if (isset($_POST["btn_enable_unit"])) {
    $unit_id = $_POST['unit_id'];

    // Perform the database update
    $query = "UPDATE `unit` SET `unit_status` = '1' 
              WHERE `unit_id` = '$unit_id'";

    // Prepare the update statement
    if (mysqli_query($connections, $query)) {
        // Update successful
    } else {
        echo "Error updating record: " . mysqli_error($connections);
    }
}




if (isset($_POST["btn_remove_unit"])) {
    $unit_id = $_POST['unit_id'];

    $check_prod_unit_id = mysqli_query($connections, "SELECT * FROM product WHERE prod_unit_id='$unit_id'");
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
                text: "Can\'t Remove Unit Because It\'s Currently Connected to the following products: \n' . $products_list . '",
                icon: "error",
                html: true
            }).then((value) => {
                if (value) {
                    window.location.href = "manageunit.php";
                } else {
                    window.location.reload();
                }
            });
        });
        </script>
        ';
    } else {
        // Perform the database update
        $query = "DELETE FROM `unit` WHERE `unit_id` = '$unit_id'";

        // Execute the delete statement
        if (mysqli_query($connections, $query)) {
            // Deletion successful
            echo '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "Success!",
                    text: "Remove Unit Success",
                    icon: "success",
                    html: true
                }).then((value) => {
                    if (value) {
                        window.location.href = "manageunit.php";
                    } else {
                        window.location.reload();
                    }
                });
            });
            </script>
            ';
        } else {
            echo "Error deleting record: " . mysqli_error($connections);
        }
    }
}
if (isset($_POST["btn_update_unit"])) {
    $unit_id = $_POST['unit_id'];
    $unit_name = $_POST['unit_name'];

    // Perform the database update
    $query = "UPDATE `unit` SET `unit_name` = '$unit_name' WHERE `unit_id` = '$unit_id'";

    // Execute the update statement
    if (mysqli_query($connections, $query)) {
        // Update successful
        echo '
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            swal({
                title: "Success!",
                text: "Update Unit Successful",
                icon: "success",
                content: true // Use the "content" option instead of "html"
            }).then((value) => {
                if (value) {
                    window.location.href = "manageunit.php";
                } else {
                    window.location.reload();
                }
            });
        });
        </script>';
    } else {
        // Error occurred while updating
        echo "Error updating record: " . mysqli_error($connections);
    }
}

?>
