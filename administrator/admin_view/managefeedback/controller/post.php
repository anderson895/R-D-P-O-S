<?php
include('../../../new-orders-view/backend/class.php');
$db = new global_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['SubmitType'])) {


        if ($_POST['SubmitType'] == 'deleteReviews') {
            echo $db->deleteRevs($_POST['id']);
        }else if($_POST['SubmitType'] == 'AllowedReviews'){

        }


    }
}

        
        
        ?>