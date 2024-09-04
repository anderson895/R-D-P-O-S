<?php 
include('../class.php');
$db = new global_class();

    if ($_POST['requestType'] == 'MarkAs_Collected') {

        echo $db->MarkAs_Collected($_POST['riderId']);
       
    }

?>
