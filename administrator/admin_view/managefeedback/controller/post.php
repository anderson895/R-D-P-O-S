<?php
include('../../../new-orders-view/backend/class.php');
$db = new global_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['SubmitType'])) {


        if ($_POST['SubmitType'] == 'deleteReviews') {
             $db->deleteRevs($_POST['id']);
        }else if($_POST['SubmitType'] == 'AllowedReviews'){


            $db->AllowedRevs($_POST['r_id']);

        }else if($_POST['SubmitType'] == 'RestrictRevs'){

            print_r($_POST);

            $db->RestrictRevs($_POST['r_id']);

        }


    }
}

        
        
        ?>