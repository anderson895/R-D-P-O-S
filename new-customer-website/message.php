<?php
include('components/header.php');
?>
<link rel="stylesheet" href="css/chat.css">
<link rel="stylesheet" href="../administrator/admin_view/assets/plugins/alertify/alertify.min.css">






<div class="container" >

<section class="gradient-custom" >
  <div class="container py-5">

    <div class="row">

     

      <div class="col-md-6 col-lg-7 col-xl-12 shadow" >

      <h2><i class="bi bi-chat-right-text"></i> Message</h2>

      
        <ul class="list-unstyled text-white" >
       
       
        <div class="container mt-4" id="allMessagesContainer" style="height: 650px; overflow-y: auto;">
   
        </div>


         

          
        <li class="mb-3 mt-3">
          <div data-mdb-input-init class="form-outline form-white">
            <input hidden type="text" name="mess_sender_id" id="mess_sender_id" value="<?=$_SESSION['acc_id']?>">
            <textarea class="form-control" id="sender_Messages" name="sender_Messages" rows="4"></textarea>
            <label class="form-label" for="sender_Messages">Message</label>
            
            <div class="d-flex align-items-center mt-2">
              <button type="button" id="btnSentMessage" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-rounded me-2">
                Send
              </button>
              <div id="spinner" class="spinner-border text-primary" role="status" style="display: none;">
                <span class="visually-hidden">Loading...</span>
              </div>
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
