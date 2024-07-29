<?php 



include "../config/config.php";


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $acc_id = $_POST['acc_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $contact = $_POST['contact'];

    // Handle file upload
    $imageName = "";
    if (!empty($_FILES["file-input"]["name"])) {
        $target_dir = "../../upload_img/";
        $imageName = basename($_FILES["file-input"]["name"]);
        $target_file = $target_dir . $imageName;

        // Move the uploaded file
        if (!move_uploaded_file($_FILES["file-input"]["tmp_name"], $target_file)) {
            die("Sorry, there was an error uploading your file.");
        }
    }

    // Update query
    $sql = "UPDATE account SET acc_fname='$fname', acc_lname='$lname', acc_username='$uname', acc_contact='$contact'";
    if ($imageName != "") {
        $sql .= ", emp_image='$imageName'";
    }
    $sql .= " WHERE acc_id=$acc_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
