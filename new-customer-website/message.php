<?php
include('components/header.php');
?>
<link rel="stylesheet" href="css/chat.css">
<link rel="stylesheet" href="../administrator/admin_view/assets/plugins/alertify/alertify.min.css">






<div class="container" >

<section class="gradient-custom" >
  <div class="container py-2">

    <div class="row">

     

      <div class="col-md-6 col-lg-7 col-xl-12 shadow" >

      <h2 class="mt-3"><i class="bi bi-chat-right-text"></i> Message</h2>


        <ul class="list-unstyled text-white" >
       
       
        <div class="container mt-4 " id="allMessagesContainer" style="height: 650px; overflow-y: auto;">
   
        </div>


         

          <hr>
        <li class="mb-3 mt-3 ">
  <div data-mdb-input-init class="form-outline form-white">
    <input hidden type="text" name="mess_sender_id" id="mess_sender_id" value="<?=$_SESSION['acc_id']?>">
    
    <div class="d-flex align-items-start">
      <textarea class="form-control me-2" id="sender_Messages" name="sender_Messages" rows="3" style="flex: 1;"></textarea>
      <button type="button" id="btnSentMessage" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-rounded">
        Send
      </button>
    </div>
    
    <label class="form-label mt-2" for="sender_Messages">Message</label>
    <div id="spinner" class="spinner-border text-primary" role="status" style="display: none;">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
</li>


         
        </ul>

      </div>

    </div>

  </div>
</section>

</div>

<?php
include('components/footer.php');
?>
<script src="../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>
