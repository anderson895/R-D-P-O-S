<?php
include("../.../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s'); // Use 'H' instead of 'g' for 24-hour format

$query = "SELECT *,
    TIMESTAMPDIFF(YEAR, act_date, '$currentDateTime') AS years_ago,
    TIMESTAMPDIFF(DAY, act_date, '$currentDateTime') AS days_ago,
    TIMESTAMPDIFF(HOUR, act_date, '$currentDateTime') AS hours_ago,
    TIMESTAMPDIFF(MINUTE, act_date, '$currentDateTime') AS minutes_ago
    FROM users_log
    LEFT JOIN account ON account.acc_id = users_log.act_account_id
    ORDER BY act_date DESC";



$view_query = mysqli_query($connections, $query);

if (!$view_query) {
    die("Query failed: " . mysqli_error($connections));
}

while ($row = mysqli_fetch_assoc($view_query)) {
    $act_id = $row["act_id"];
    $act_account_id = $row["act_account_id"];
    $act_activity = $row["act_activity"];
    $act_date = $row["act_date"];
    $act_seen = $row["act_seen"];
    $act_table_changed = $row["act_table"];
    $act_collumn_id = $row["act_collumn_id"];

    $profile_acc_fname = $row["acc_fname"];
    $profile_acc_lname = $row["acc_lname"];
    $profile_emp_image = $row["emp_image"];

    // Calculate time difference
    $years_ago = $row["years_ago"];
    $days_ago = $row["days_ago"];
    $hours_ago = $row["hours_ago"];
    $minutes_ago = $row["minutes_ago"];

    // Determine the appropriate time format
    if ($years_ago > 0) {
        $time_ago = $years_ago . " year" . ($years_ago > 1 ? "s" : "") . " ago";
    } elseif ($days_ago > 0) {
        $time_ago = $days_ago . " day" . ($days_ago > 1 ? "s" : "") . " ago";
    } elseif ($hours_ago > 0) {
        $time_ago = $hours_ago . " hour" . ($hours_ago > 1 ? "s" : "") . " ago";
    } elseif ($minutes_ago > 0) {
        $time_ago = $minutes_ago . " minute" . ($minutes_ago > 1 ? "s" : "") . " ago";
    } else {
        $time_ago = "Just now";
    }

    // Use $time_ago, $act_activity, $profile_acc_fname, and $profile_emp_image in your output
    echo "<li class='notification-message'>";
    echo "<a>";
    
    echo "<div class='media d-flex'>";
    

    echo "<span class='avatar flex-shrink-0' onclick=\"window.location.href='profile.php?account_id=$act_account_id';\">";
    if ($profile_emp_image) {
        echo "<img alt='' src='../../upload_img/$profile_emp_image'>";
    } else {
        echo "<img alt='' src='../../upload_system/empty.png'>"; // Provide a default image path
    }
    echo "</span>";

    if($act_table_changed=="category"){
        echo "<div class='media-body flex-grow-1' onclick=\"window.location.href='editcategory.php?category_id=$act_collumn_id';\" style='cursor: pointer;'>";
  
    }else if($act_table_changed=="product"){
        echo "<div class='media-body flex-grow-1' onclick=\"window.location.href='product-details.php?target_id=$act_collumn_id';\" style='cursor: pointer;'>";
  

    }else if($act_table_changed=="Feedback"){
        echo "<div class='media-body flex-grow-1' onclick=\"window.location.href='managefeedback.php?target_id=$act_collumn_id';\" style='cursor: pointer;'>";
  

    }else if($act_table_changed=="account"){

        $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id ='$act_collumn_id' ");
		$row = mysqli_fetch_assoc($get_record);
		 $fetch_acc_type = $row["acc_type"];

         if($fetch_acc_type==="customer"){
            echo "<div class='media-body flex-grow-1' onclick=\"window.location.href='profile_customer.php?target_id=$act_collumn_id';\" style='cursor: pointer;'>";
            
         }else{
            echo "<div class='media-body flex-grow-1' onclick=\"window.location.href='profile.php?account_id=$act_collumn_id';\" style='cursor: pointer;'>";
         }

      
  
    }else{
        echo "<div class='media-body flex-grow-1'>";
    }
    $get_fullname=ucfirst($profile_acc_fname." ".$profile_acc_lname);
    $act_activity = (strlen($act_activity) > 150) ? substr($act_activity, 0, 150) . '...' : $act_activity;
    echo "<p class='noti-details'><span class='noti-title'>$get_fullname</span> added new task <span class='noti-title'><br>$act_activity</span></p>";
    echo "<p class 'noti-time'><span class='notification-time'>$time_ago</span></p>";
    echo "</div>";
    echo "</div>";
    echo "</a>";
    echo "</li>";


}
?>
