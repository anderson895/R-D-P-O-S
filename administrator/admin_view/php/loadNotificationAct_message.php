<?php

date_default_timezone_set('Asia/Manila');

include("../.../../../../connection.php");

session_start();
$currentDateTime = date('Y-m-d H:i:s');

$session_acc_id = $_SESSION["acc_id"];

$query = "SELECT m.*, a.*, 
    TIMESTAMPDIFF(YEAR, m.mess_date, '$currentDateTime') AS years_ago,
    TIMESTAMPDIFF(DAY, m.mess_date, '$currentDateTime') AS days_ago,
    TIMESTAMPDIFF(HOUR, m.mess_date, '$currentDateTime') AS hours_ago,
    TIMESTAMPDIFF(MINUTE, m.mess_date, '$currentDateTime') AS minutes_ago
FROM messages m
LEFT JOIN account a ON a.acc_id = m.mess_reciever
WHERE 
    (m.mess_reciever = '$session_acc_id' OR m.mess_sender = '$session_acc_id' OR m.mess_reciever ='Admin') 
    AND (m.mess_sender, m.mess_date) IN (
        SELECT m2.mess_sender, MAX(m2.mess_date) AS max_date
        FROM messages m2
        WHERE (m2.mess_reciever = '$session_acc_id' OR m2.mess_sender != '$session_acc_id' OR m2.mess_reciever ='Admin')
        GROUP BY m2.mess_sender
    )
GROUP BY m.mess_sender
ORDER BY m.mess_date DESC";



$view_query = mysqli_query($connections, $query);

if (!$view_query) {
    die("Query failed: " . mysqli_error($connections));
}

while ($row = mysqli_fetch_assoc($view_query)) {
    $mess_id = $row["mess_id"];
    $mess_sender = $row["mess_sender"];
    $mess_content = $row["mess_content"];
    $mess_reciever = $row["mess_reciever"];
    $mess_date = $row["mess_date"];

    $mess_seen = $row["mess_seen"];
    
    $acc_type = $row["acc_type"];
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



 //   if($mess_sender==$session_acc_id){
        $get_senderDetails = mysqli_query ($connections,"SELECT * FROM account where acc_id='$mess_sender' ");//session_acc_id
//
  //  }else{

      //  $get_senderDetails = mysqli_query ($connections,"SELECT * FROM account where acc_id='$mess_sender' ");//mess_sender
 //   }
   
	$row_sender = mysqli_fetch_assoc($get_senderDetails);


    $sender_acc_fname = $row_sender["acc_fname"];
    $sender_acc_lname = $row_sender["acc_lname"];
    $sender_emp_image = $row_sender["emp_image"];
    $sender_acc_type = $row_sender["acc_type"];


    echo "<li class='notification-message'>";
    echo "<a>";
    echo "<div class='media d-flex'>";
    echo "<span class='avatar flex-shrink-0' onclick=\"window.location.href='chat.php?account_id=$mess_sender';\">";

    if ($sender_emp_image) {
        echo "<img alt='' src='../../upload_img/$sender_emp_image'>";
    } else {
        echo "<img alt='' src='../../upload_system/empty.png'>"; // Provide a default image path
    }
    echo "</span>";

    // Check user type and set appropriate link
    if ($acc_type == "customer") {
        echo "<div class='media-body flex-grow-1' onclick=\"window.location.href='chat.php?account_id=$mess_sender';\" style='cursor: pointer;'>";
    } else if ($acc_type == "admin" || $acc_type == "delivery") {
        echo "<div class='media-body flex-grow-1' onclick=\"window.location.href='chat.php?account_id=$mess_sender';\" style='cursor: pointer;'>";
    } else {
        echo "<div class='media-body flex-grow-1' onclick=\"window.location.href='chat.php?account_id=$mess_sender';\" style='cursor: pointer;'>";
    }

    $get_fullname = ucfirst($sender_acc_fname . " " . $sender_acc_lname);
    $act_activity = "";

    // Set the activity based on available message content
    if ($mess_content) {
        $act_activity = (strlen($mess_content) > 150) ? substr($mess_content, 0, 150) . '...' : $mess_content;
    }else{
        $act_activity = "Sent Attachment";
       
    }

 $mess_seen;


    if($mess_seen == 2){

        $messages_log = "<span class='noti-details'><br>";
        if ($mess_sender == $session_acc_id) {
            $messages_log .= '(You) ';
        } else {
            $messages_log .= '';
        }
        $messages_log .= $act_activity;
        $messages_log .= "</span>"; // ordinary
        
    }else{
        if($mess_sender == $session_acc_id){
            $messages_log = "<span class='noti-details'><br>";
        }else{
            $messages_log = "<span class='noti-title' style='font-weight: bold;'><br>";
        }
      


        if ($mess_sender == $session_acc_id) {
            $messages_log .= '(You) ';
        } else {
            $messages_log .= '';
        }
        $messages_log .= $act_activity;
        $messages_log .= "</span>";

                
        //highlights
    }
    $position= ucfirst($sender_acc_type);

    echo "<p class='noti-details'><span class='noti-title'><span style='font-weight: bold;'>$get_fullname</span> ($position)</span> $messages_log</p>";

    echo "<p class='noti-time'><span class='notification-time'>$time_ago</span></p>";
    echo "</div>";
    echo "</div>";
    echo "</a>";
    echo "</li>";
}

?>
