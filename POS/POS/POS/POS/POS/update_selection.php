<?php
if(isset($_POST['selected_option'])) {
    $selected_option = $_POST['selected_option'];
    echo "You selected: " . $selected_option;
}
?>
