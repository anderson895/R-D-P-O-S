
 <!--VIEW ORDERS-->
   
 <div class="modal fade" id="ModalView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                  <div class="modal-body">
                                        
                                                         <div class="container">
                                                            <div class="row">
                                                                <div class="col">
                                                                <div class="container">
                                                                Transaction: <h4 id="orders_tcode"></h4><strong id="customer_id_grp"></strong>

                                                                    <div class="container-fluid mb-3">
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="col">
                                                                <div class="container d-flex justify-content-end">
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">BACK</button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                          <div class="table-responsive">
                                                              <table class="table">
                                                                  <thead>
                                                                      <tr>
                                                                       
                                                                        <th scope="col">Product Name</th>
                                                                        <th scope="col">Quantity</th>
                                                                        <th scope="col">Price</th>
                                                                        <th scope="col">Total Amount</th>
                                                                      
                                                                      </tr>
                                                                    </thead>
                                                                    <tbody id="tbody">
                                                                      <tr >
                                                                       
                                                                       
                                            
                                                                      
                                                                      </tr>
                                                                    </tbody>
                                                              </table>
                                                          </div>
                                                          <div class="container">
                                                              <div class="row">
                                                                  <div class="col">
                                                                      <div class="container">
                                                                          
                                                                      </div>
                                                                  </div>
                                                                  <div class="col">
                                                                      <div class="container d-flex justify-content-end">
                                                                          <div class="card" style="width: 25rem;">
                                                                              <div class="card-body">
                                                                                <div class="container">
                                                                                  <div class="row">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Sub Total:</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" id="subtowtal">1,000.00</p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                 
                                                                                  <div class="row mb-2">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">VAT:&nbsp;</p>(<p class="card-text" ><span id="taxPercent"></span>%)</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" ><span id="formattedsubtax"></span></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="row mb-2">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Shipfee:&nbsp;</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" ><span id="orders_ship_fee"></span></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>

                                                                            <div class="row mb-2" id="voucher_row">
                                                                                <div class="col">
                                                                                    <div class="container d-flex justify-content-end">
                                                                                        <p class="card-text">Voucher&nbsp;</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <div class="container d-flex justify-content-left">
                                                                                        <p class="card-text"><span id="orders_voucher_name"></span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                                  <div class="container border"></div>
                                                                                  <div class="row">
                                                                                      <div class="container d-flex justify-content-center">
                                                                                          Total Due:<span id="finalDue"> </span>
                                                                                      </div>
                                                                                 
                                                                                  </div>

                                                                                  <div class="row">
                                                                                  <div class="container border"></div>
                                                                                  <div class="row">
                                                                                      <div class="container d-flex justify-content-center">
                                                                                      <button class="form-control btn btn-secondary" onclick="redirectToReceiptPage()">PRINT RECEIPT</button>
                                                                                            <span id="transaction_archive" hidden></span>

                                                                                            <script>
                                                                                              function redirectToReceiptPage() {
                                                                                                var transaction_archive = document.getElementById('orders_tcode').innerHTML;
                                                                                                var url = 'order_receipt.php?RDcode=' + encodeURIComponent(transaction_archive);
                                                                                                window.location.href = url;
                                                                                              }
                                                                                            </script>

                                                                                          </div>
                                                                                 
                                                                                  </div>
                                                                                </div>
                                                                                 
                                                                                  </div>
                                                                         
                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                            
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                              </div>
                                          </div>