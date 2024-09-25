<div class="header-left active" style="background-color: rgb(113,0,0);">
    <a href="<?php if($acc_type === 'administrator'){ echo 'index.php ';}else{ echo '#';} ?>"
       class="d-flex flex-column flex-md-row align-items-center justify-content-center text-center w-100">
        <img src="../../upload_system/<?= $db_system_logo ?>" class="img-fluid" alt="Logo" style="max-width:30px; height: auto;">
        <span class="fs-3 fw-bold text-light mt-2 mt-md-0 ms-md-3"><?= $db_system_name ?></span>
    </a>
</div>

<a id="mobile_btn" class="mobile_btn d-md-none" href="#sidebar">
    <span class="bar-icon">
        <span></span>
        <span></span>
        <span></span>
    </span>
</a>
