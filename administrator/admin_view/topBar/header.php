<div class="header-left active" style="background-color:rgb(113,0,0);">
        <a href="<?php if($acc_type==="administrator"){ echo "index.php ";}else{ echo "#";} ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="../../upload_system/<?= $db_system_logo ?>" style="width: 45px; ">
            <span class="fs-3 fw-bold text-light ms-3"><?= $db_system_name?></span>
        </a>
       
        
        
        <a hidden id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
        <span></span>
        <span></span>
        <span></span>
        </span>
    </a>