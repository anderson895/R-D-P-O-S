<?php 
include("../../connection.php");

$get_record = mysqli_query($connections, "SELECT * FROM maintinance");
$row = mysqli_fetch_assoc($get_record);
$db_system_id = $row["system_id"];
$db_system_name = $row["system_name"];
$db_system_banner = $row["system_banner"];
$db_system_logo = $row["system_logo"];
$db_system_address = $row["system_address"];
$db_system_contact = $row["system_contact"];
$db_system_tax = $row["system_tax"];

//btnStore_address
//store_address
$SystemName = $SystemBanner = $SystemLogo = $SystemContent = $SystemAddress = $SystemContact = $SystemTax = "";
$SystemNameErr = $SystemBannerErr = $SystemLogoErr = $SystemContentErr = $SystemAddressErr = $SystemContactErr = $SystemTaxErr = $SystemShipfeeErr = "";

if (isset($_POST["btn_save_system"])) {
    $SystemName = $_POST["SystemName"];
    $SystemContent = $_POST["SystemContent"];
    $SystemAddress = $_POST["SystemAddress"];
    $SystemContact = $_POST["SystemContact"];
    $SystemTax = $_POST["SystemTax"]/100;

   
    
    
    // Process System Banner
    if ($_FILES["SystemBanner"]["name"] !== "") {
        $SystemBanner = $_FILES["SystemBanner"]["name"];
        $tempBanner = $_FILES["SystemBanner"]["tmp_name"];
        move_uploaded_file($tempBanner, "../../upload_system/" . $SystemBanner);
    } else {
        $SystemBanner = $db_system_banner;
    }

    // Process System Logo
    if ($_FILES["SystemLogo"]["name"] !== "") {
        $SystemLogo = $_FILES["SystemLogo"]["name"];
        $tempLogo = $_FILES["SystemLogo"]["tmp_name"];
        move_uploaded_file($tempLogo, "../../upload_system/" . $SystemLogo);
    } else {
        $SystemLogo = $db_system_logo;
    }

    mysqli_query($connections, "UPDATE `maintinance` SET 
        `system_name` = '$SystemName', 
        `system_banner` = '$SystemBanner', 
        `system_logo` = '$SystemLogo', 
        `system_content` = '$SystemContent', 
        `system_address` = '$SystemAddress', 
        `system_contact` = '$SystemContact', 
        `system_tax` = '$SystemTax'
      
        WHERE `maintinance`.`system_id` = 1");



echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>';
echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
echo '
<script>
$(document).ready(function() {
    swal({
        title: "Success!",
        text: "Voucher Updated",
        icon: "success",
        html: true
    }).then((value) => {
        if (value) {
            window.location.href = "systemsetting.php";
        } else {
            window.location.reload();
        }
    });
});
</script>
';

}


?>
