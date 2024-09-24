<?php
session_start();
include('../class.php');
$db = new global_class();

$acc_id=$_SESSION['acc_id'];

if (isset($_SESSION['acc_id'])) {
    if (isset($_GET['requestType'])) {
        if ($_GET['requestType'] == 'getAllMessages') {



            $getAllMessages = $db->getAllMessages($acc_id);

            if ($getAllMessages->num_rows > 0) {
                while ($messages = $getAllMessages->fetch_assoc()) {
                    
                   
                    


                    if($messages['mess_sender']==$acc_id){
?>
  <!-- Customer message -->
<li class="d-flex justify-content-between mb-4">
    <div class="card mask-custom w-100">
        <div class="card-header d-flex justify-content-between p-3" style="border-bottom: 1px solid rgba(255,255,255,.3);">
            <p class="fw-bold mb-0"><?=$messages['acc_username']?></p>
            <!-- <p class="text-light small mb-0"><i class="far fa-clock"></i> 13 mins ago</p> -->
        </div>
        <div class="card-body">
            <p class="mb-0">
                <?=$messages['mess_content']?>
            </p>
        </div>
    </div>
    <?php if (!empty($messages['emp_image'])): ?>
        <img src="../upload_img/<?=$messages['emp_image']?>" alt="avatar"
            class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" style="width: 60px; height: 60px; object-fit: cover;">
    <?php else: ?>
        <i class="bi bi-person-fill d-flex align-self-start ms-3" style="font-size: 60px; background-color:black; border-radius:50px;"></i>
    <?php endif; ?>
</li>


        

                <?php
                }else{
                    
                    ?>

                    
                    <!--  Admin message  -->
          <li class="d-flex justify-content-between mb-4">
            <img src="../upload_img/<?=$messages['emp_image']?>" alt="avatar"
              class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" style="width: 60px; height: 60px; object-fit: cover;">
            <div class="card mask-custom w-100">
              <div class="card-header d-flex justify-content-between p-3"
                style="border-bottom: 1px solid rgba(255,255,255,.3);">
                <p class="fw-bold mb-0"><?=$messages['acc_fname']?> <?=$messages['acc_lname']?></p>
                <!-- <p class="text-light small mb-0"><i class="far fa-clock"></i> 12 mins ago</p> -->
              </div>
              <div class="card-body">
                <p class="mb-0">
                 <?=$messages['mess_content']?>
                </p>
              </div>
            </div>
          </li>
              
                
                <?php
                }

                }
            } else {
                ?>
                <center class="pt-5 pb-5 mt-5 mb-5 text-primary">No Message Found.</center>

                
<?php
            }
        }
    }
}
