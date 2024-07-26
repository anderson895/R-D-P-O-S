
<li class="nav-item dropdown has-arrow main-drop">
<a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
<span class="user-img"><img src="../../upload_img/<?= $db_emp_image?>" alt="">
<span class="status online"></span></span>
</a>
<div class="dropdown-menu menu-drop-user">
<div class="profilename" >
<div class="profileset" onclick="window.location.href='profile.php?account_id=<?=$db_acc_id?>';">
<span class="user-img"><img src="../../upload_img/<?= $db_emp_image?>" alt="">
<span class="status online"></span></span>
<div class="profilesets">
<h6><?= $fullname?></h6>
<h5><?= $db_acc_type?></h5>
</div>
</div>
<hr class="m-0">
<a class="dropdown-item" onclick="window.location.href='profile.php?account_id=<?=$db_acc_id?>';"> <i class="me-2" data-feather="user"></i> My Profile</a>
<a class="dropdown-item" onclick="window.location.href='generalsettings.php?account_id=<?=$db_acc_id?>';"><i class="me-2" data-feather="settings"></i>Settings</a>
<a class="dropdown-item" onclick="window.location.href='privacysettings.php?account_id=<?=$db_acc_id?>';"><i class="me-2" data-feather="lock"></i>Privacy</a>

<hr class="m-0">
<a class="dropdown-item logout pb-0" href="backend/logout.php"><img src="assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
</div>
</div>
</li>