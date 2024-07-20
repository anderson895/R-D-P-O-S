<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["address_id"])) {
    $address_id = $_POST["address_id"];
    $user_acc_code = $_POST["user_acc_code"];

    
    include "../../../connection.php";
    // Gawing "0" ang user_address_status para sa lahat ng record maliban sa nakuha na address_id
    $sqlUpdateAll = "UPDATE user_address SET user_active_status = '0' WHERE id != ? AND user_acc_code = ?";
    $stmtUpdateAll = $connections->prepare($sqlUpdateAll);
    $stmtUpdateAll->bind_param("ii", $address_id, $user_acc_code);
    if ($stmtUpdateAll->execute()) {
        // I-update ang user_address_status para sa na-select na address_id

        $sqlUpdateSelected = "UPDATE user_address SET user_active_status = '1' WHERE id = ? AND user_acc_code = ?";
        $stmtUpdateSelected = $connections->prepare($sqlUpdateSelected);
        $stmtUpdateSelected->bind_param("ii", $address_id, $user_acc_code);

        if ($stmtUpdateSelected->execute()) {
            echo $user_acc_code;
        } else {
            echo "error";
        }

        $stmtUpdateSelected->close();
    } else {
        echo "error";
    }

    $stmtUpdateAll->close();
} else {
    echo "Invalid request.";
}
?>
