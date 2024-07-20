<div  class="mb-5 position-fixed bottom-0 d-flex justify-content-center align-items-center">
    
<div class="position-fixed d-flex justify-content-center align-items-center footer" >
    <div id="totalBillCOntainer" class="checkout-container" style="background-color: #600000;  ">
        <center>
            <div class="total-bill text-black">
                <font style="color:white;" id="totalBill">0.00</font>
            </div>

        <button id="checkDeliveryOrPick" type="button" class="form-control btn btn-success" style="width:100%;" data-bs-toggle="modal" data-bs-target="#PickUpOrDelivery">CheckOut
        <i class="fas fa-check fs-4"></i>
                    <i class="fas fa-shopping-cart"></i>
    </button>
         
    
    <!--start PickUp or Deliver Modal -->
<div class="modal fade" id="PickUpOrDelivery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment Options</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="#" method="post">
            <div class="mb-3">
            <!-- Row for horizontal arrangement -->
            <div class="row">
              <div class="col">
            <button type="submit" id="checkoutButton" name="btnCheckOut" class="form-control btn btn-primary">
            <i class="fa fa-truck"></i>
                    Delivery
                    
                </button>
                </div>
              <div class="col">
              <button
  type="submit"
  class="form-control btn btn-primary"
  style="width:100%;"
  onclick="setPickupAction()"
>
  <i class="fa fa-store"></i>
  Pick-up
</button>
            </div>
          </div>
            </form>
            </div>
    </div>
  </div>
</div>   <!--end PickUp or Deliver Modal -->
        </center>
    </div>
</div>
</div>
<!---style="background-color:#600000;"--->

<style>
    .modal-backdrop.show {
    display:none;
}



    .footer {
    position: fixed;
    bottom: 0;
    right: 0; /* Updated to position it on the right corner */
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: flex-end;
}

.checkout-container {
    background-color: gray;
    border: 2px solid white;
    padding: 10px; /* Optional: Add padding if needed */
    text-align: center;
    border-radius:15px; 
}



@media (max-width: 767px) {
    .checkout-container {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        margin: 0 auto;
        transform: none;
        border-radius:0px; 
        border: none;
        
    }
}

@media (min-width: 768px) {
    .checkout-container {
        position: fixed;
        bottom: 0;
        right: 0; /* Updated to position it on the right corner */
        transform: none;
        border-radius:15px; 
        border: 2px solid white;
    }
}

</style>



