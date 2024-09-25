
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<!------for messages --->
<li class="nav-item dropdown">
<a class="dropdown-toggle nav-link togglerSeenMessages" data-bs-toggle="dropdown"><!--temporary tinanggal ko ang togglerSeen ililipat sa view chat messages nasa productlist/toglerAjax.js ang togler-->
<img src="assets/img/icons/mail.svg" alt="img" style="width:25px;"> 
<span style="display:none;"   class="noti_number_messages badge rounded-pill" style="background-color:red;" ></span>
</a>
<div class="dropdown-menu notifications">
<div class="topnav-dropdown-header">
<span class="notification-title">Messages </span><!--- Notifications-->
<!----<a href="javascript:void(0)" class="clear-noti"> Clear All </a>--->
</div>
<div class="noti-content">
<ul class="notification-list">
<div id='loadNotificationAct_message'><!---id=loadNotificationAct--->
</div>
</ul>
</div>
<div class="topnav-dropdown-footer">
<a href="chat.php?account_id=<?=$session_id?>">View all Messages</a>
</div>
</div>
</li>


<!----- end for messages ------>









<?php 
if($acc_type=="administrator"){
    


?>


<li class="nav-item dropdown">

<a class="dropdown-toggle nav-link togglerSeen" data-bs-toggle="dropdown">
<img src="assets/img/icons/notification-bing.svg" alt="img"> <span style="display:none;"  id="noti_number" class="badge rounded-pill" style="background-color:red;" ></span>
</a>


<div class="dropdown-menu notifications">
<div class="topnav-dropdown-header">





<span class="notification-title">Notifications</span>
<!----<a href="javascript:void(0)" class="clear-noti"> Clear All </a>--->
</div>


<div class="noti-content">
<ul class="notification-list">

<div id='loadNotificationAct'>

</div>

</ul>
</div>
<div class="topnav-dropdown-footer">
<a href="activities.php">View all Notifications</a>
</div>
</div>
</li>

<?php } ?>


<script src='productlist/controller/toglerAjax.js'></script>

<script src='productlist/controller/toglerAjaxMessage.js'></script>