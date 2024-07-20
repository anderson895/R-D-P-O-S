<?php



if(isset($_SESSION["acc_id"])){

    
session_start();

    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id ='$acc_id' AND acc_status ='0' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    
    
    if($acc_type =="customer"){
                //redirect user
                echo "<script>window.location.href='../new-customer-website/index.php'</script>";	
            }
}?>