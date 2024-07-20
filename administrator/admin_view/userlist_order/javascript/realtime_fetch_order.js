function view_customer_order(id) {
  
    window.location.href = "view_customer_order.php?view_id=" + id;
  
  }

function messages_customer(id) {
  
    window.location.href = "chat.php?account_id=" + id;
  
  }  
  

  function capitalizeFirstLetter(str) {
    return str.replace(/\b\w/g, function(match) {
        return match.toUpperCase();
    });
}





    function fetchData() {
        
     
        $.ajax({
            url: "userlist_order/controller/fetch_orders.php", 
            method: "GET",
            dataType: "json", 
            success: function (data) {
                updateDOM(data);
            },
            
            
            error: function(xhr, status, error) {
                console.error("Error fetching data:", status, error);
                console.log(xhr.responseText); // Log the response text to the console
              }
        });
    }
    
    

    function updateDOM(data) {
        
        // Assuming your data is an array of orders
        const containerAll = $("#all-content");
        const containerToPay = $("#topay-content");
        const containerToShip = $("#toship-content");
        const containerToReceived = $("#toreceived-content");
        const containerToComplete = $("#completed-content");
        const containerToCancel = $("#canceled-content");
        

        containerAll.empty(); 
        containerToPay.empty(); 
        containerToShip.empty();
        containerToReceived.empty();
        containerToComplete.empty();
        containerToCancel.empty();
        
       
     
        data.forEach((order) => {

  
//console.log(order)


  

   
    const card = $("<div>")
    .addClass("container-fluid")
    .append(

         
        $("<div>").addClass("card mb-3").append(
            $("<div>").addClass("card-body").append(
                $("<div>").addClass("row").append(
                    $("<div>").addClass("col text-end").append(
                        $("<p>")
                            .addClass(order.orders_status === "Completed" ? "text-success" : "text-danger")
                            .text(order.orders_status)
                    )
                ).append($("<hr>"))
            ).append(
                $("<div>").attr("onclick", `view_customer_order('${order.order_transaction_code}')`).addClass("row").append(

                    $("<div>").addClass("col-12 col-md-2").append(
                        $("<div>").addClass("d-flex justify-content-center mt-2").append(
                            order.emp_image ?
                                $("<img>").attr("src", "../../upload_img/" + order.emp_image)
                                .attr("alt", capitalizeFirstLetter(order.full_name))
                                .css({ "width": "75px", "height": "75px", "border-radius": "50px" })
                                    :
                                $("<img>").attr("src", "../../upload_system/empty.png")
                                          .attr("alt", capitalizeFirstLetter(order.full_name))
                                          .css({ "width": "75px", "height": "75px", "border-radius": "50px" })
                                
                        )
                    )

                ).append(
                    $("<div>").addClass("col-12 col-md-8 overflow-auto").append(
                        $("<p>").addClass("text-black").text("Name: "+capitalizeFirstLetter(order.full_name)),
                        $("<p>").addClass("text-black").text("Payment: " + order.orders_paymethod),
                        $("<p>").addClass("text-black").text("Date: " + order.orders_date),
                        $("<p>").addClass("text-black").text("Transaction code: " + order.order_transaction_code),
                        $("<p>").addClass("text-black").text("Address: " + order.orders_address)
                    )
                ).append(
                    $("<div>").addClass("col-12 col-md")
                )

                //order.orders_paymethod
            ).append($("<hr>")).append(

              
                $("<div>").addClass("row").append(
                    $("<div>").addClass("col").append(
                        $("<div>").addClass("d-flex justify-content-end").append(
                            //console.log(order.orders_proof);


                            

                        
                            (order.orders_status === "Pending") ?
                                [
                                    $("<button>").addClass("btn btn-primary btn-sm toglerBtnAccept")
                                        .attr("value", order.orders_prod_id)
                                        .attr("data-customerFullname", order.full_name)
                                        .attr("data-value2", order.order_transaction_code)
                                        .attr("data-orders_proof", order.orders_proof)
                                        .attr("data-orders_status", order.orders_status)
                                        .attr("data-bs-toggle", "modal")
                                        .attr("data-bs-target", ".exampleModal")
                                        .text("Accept").click(function (event) {
                                            event.stopPropagation(); // Stop the event propagation
                                            // Add your accept order logic here
                                        }),
                                        "&nbsp;",
                                        $("<button>").addClass("btn btn-danger btn-sm toglerDecline")
                                        .attr("value", order.orders_prod_id)
                                        .attr("data-customerFullname", order.full_name)
                                        .attr("data-orders_prod_id", order.orders_prod_id)
                                        .attr("data-order_transaction_code", order.order_transaction_code)
                                        .attr("data-customerfull_name", order.full_name)
                                        .attr("data-orders_status", order.orders_status)
                                        .attr("data-bs-toggle", "modal")
                                        .attr("data-bs-target", "#declineModal")
                                        .text("Decline").click(function (event) {
                                            event.stopPropagation(); // Stop the event propagation
                                            // Add your accept order logic here
                                        }),
                                "&nbsp;"
                                ]
                                :
                                (order.orders_status === "Decline") ?
                                    [
                                        $("<button>").addClass("btn btn-primary btn-sm toglerRemove")
                                            .attr("value", order.orders_prod_id)
                                            .attr("data-customerFullname", order.full_name)
                                            .attr("data-orders_prod_id", order.orders_prod_id)
                                            .attr("data-order_transaction_code", order.order_transaction_code)
                                            .attr("data-customerfull_name", order.full_name)
                                            .attr("data-orders_status", order.orders_status)
                                            .attr("data-bs-toggle", "modal")
                                            .attr("data-bs-target", ".removeModal")
                                            .text("Remove").click(function (event) {
                                                event.stopPropagation(); // Stop the event propagation
                                                // Add your remove order logic here
                                            }),
                                        "&nbsp;"
                                    ]
                                    :
                                    (order.orders_status === "To-ship") ?
                                        [
                                            $("<button>").addClass("btn btn-primary btn-sm toglerBtnReceive")
                                                .attr("data-order_transaction_code", order.order_transaction_code)
                                                .attr("data-customerFullname", order.full_name)
                                                .attr("data-orders_status", order.orders_status)
                                                .attr("data-bs-toggle", "modal")
                                                .attr("data-bs-target", ".toRecieveModal")
                                                .text("To-receive").click(function (event) {
                                                    event.stopPropagation(); // Stop the event propagation
                                                    // Add your to-received order logic here
                                                }),
                                            "&nbsp;"
                                        ]
                                        :
                                        (order.orders_status === "To-receive") ?
                                            [
                                                $("<button>").addClass("btn btn-primary btn-sm toglerBtnCompleted")
                                                    .attr("value", order.orders_prod_id)
                                                    .attr("data-customerFullname", order.full_name)
                                                    .attr("data-order_transaction_code", order.order_transaction_code)
                                                    .attr("data-orders_status", order.orders_status)
                                                    .attr("data-bs-toggle", "modal")
                                                    .attr("data-bs-target", ".completeModal")
                                                    .text("Completed").click(function (event) {
                                                        event.stopPropagation(); // Stop the event propagation
                                                        // Add your to-received order logic here
                                                    }),
                                                "&nbsp;"
                                            ]
                                            :

                                            (order.orders_status === "Completed") ?
                                            [
                                                $("<button>").addClass("btn btn-danger btn-sm toglerBtnArchive")
                                                    .attr("value", order.orders_prod_id)
                                                    .attr("data-customerFullname", order.full_name)
                                                    .attr("data-order_transaction_code", order.order_transaction_code)
                                                    .attr("data-orders_status", order.orders_status)
                                                    .attr("data-bs-toggle", "modal")
                                                    .attr("data-bs-target", ".archiveModal")
                                                    .text("Archive").click(function (event) {
                                                        event.stopPropagation(); // Stop the event propagation
                                                        // Add your to-received order logic here
                                                    }),
                                                "&nbsp;"
                                            ]
                                            :
                                           
                                            [], // Use an empty array if no button is needed
                            $("<button>").attr("onclick", `messages_customer('${order.orders_customer_id}')`).addClass("btn btn-outline-secondary btn-sm").text("Messages").click(function (event) {
                                event.stopPropagation(); // Stop the event propagation
                                // Add your contact administrator logic here
                            })
                        )
                    )
                )
                
                
                



            ).append($("<hr>")).append(
                $("<div>").addClass("d-flex justify-content-end").text("Order Total: ₱" + order.subtotal)
            )
        )
    );
    



            
    
            containerAll.append(card);

             // Display only orders with status "Pending" in the "To Pay" tab
            if (order.orders_status === "Pending") {
                containerToPay.append(card.clone());
            }
            if (order.orders_status === "To-ship") {
                containerToShip.append(card.clone());
            }
            if (order.orders_status === "To-receive") {
                containerToReceived.append(card.clone());
            }
            if (order.orders_status === "Completed") {
                containerToComplete.append(card.clone());
            }
            if (order.orders_status === "Decline") {
                containerToCancel.append(card.clone());
            }

            
            $('.toglerBtnAccept').click(function() {
                //customerFullname
                var orders_paymethod = $(this).attr('data-orders_paymethod'); 

                var orderId = $(this).val();
                var orders_proof = $(this).attr('data-orders_proof');
                
                var orders_status = $(this).attr('data-orders_status');
                var orderTransactionCode = $(this).attr('data-value2');
                console.log(orderTransactionCode)
                var customerFullname = $(this).attr('data-customerFullname');
                $('.customerFullname').val(customerFullname);
                $('.orders_status').val(orders_status);
                $('.orders_id').val(orderId);
                $('.order_transaction_code').text(orderTransactionCode);
                $('.order_transaction_code').val(orderTransactionCode);
            
                if (orders_status == "Decline" || orders_status == "Canceled") {
                    $('#warning').text("Remove order from the display?");
                } else {
                    $('#warning').html("<h4>Accept order?</h4>");
                }
                $('#proofImage').hide();
    
                if (orders_proof !== null && orders_proof.trim() !== "") {
                    $('#proofImage').attr('src', '').attr('src', '../../upload_proof/' + orders_proof).show();
                }
            });
            
            


              $('.toglerDecline').click(function() {
                var customerFullname = $(this).attr('data-customerFullname');
                $('.customerFullname').val(customerFullname);


                var order_transaction_code = $(this).attr('data-order_transaction_code'); 
                var customerfull_name = $(this).attr('data-customerfull_name'); 
                var orders_status = $(this).attr('data-orders_status'); 
                
                $('.customerfull_name').text(customerfull_name);
                $('.order_transaction_code').val(order_transaction_code);
                $('.orders_status').val(orders_status);
                
                
              
              
                var orders_status_rem = $(this).attr('data-orders_status'); 
                $('#orders_status_rem').val(orders_status_rem);
              
              });




              $('.toglerBtnReceive').click(function() {
                var orderId = $(this).val();
                var customerFullname = $(this).attr('data-customerFullname');
                var order_transaction_code = $(this).attr('data-order_transaction_code');
                var orders_status = $(this).attr('data-orders_status');
                console.log(order_transaction_code)
                $('.orders_status').val(orders_status);
                $('.order_transaction_code').val(order_transaction_code);
                $('.customerFullname').val(customerFullname);
              
              });


              $('.toglerBtnCompleted').click(function() {
                var orderId = $(this).val();
                var customerFullname = $(this).attr('data-customerFullname');
                var order_transaction_code = $(this).attr('data-order_transaction_code');
                var orders_status = $(this).attr('data-orders_status');
                console.log(order_transaction_code)
                $('.orders_status').val(orders_status);
                $('.order_transaction_code').val(order_transaction_code);
                $('.customerFullname').val(customerFullname);
              
              });

              $('.toglerRemove').click(function() {
                var orderId = $(this).val();
                var customerFullname = $(this).attr('data-customerFullname');
                var order_transaction_code = $(this).attr('data-order_transaction_code');
                var orders_status = $(this).attr('data-orders_status');
                console.log(order_transaction_code)
                $('.orders_status').val(orders_status);
                $('.order_transaction_code').val(order_transaction_code);
                $('.customerFullname').val(customerFullname);
              });

              $('.toglerBtnArchive').click(function() {
                var orderId = $(this).val();
                var customerFullname = $(this).attr('data-customerFullname');
                var order_transaction_code = $(this).attr('data-order_transaction_code');
                var orders_status = $(this).attr('data-orders_status');
                console.log(order_transaction_code)
                $('.orders_status').val(orders_status);
                $('.order_transaction_code').val(order_transaction_code);
                $('.customerFullname').val(customerFullname);
              });
            

        });
    }
    
    //toglerBtnReceive
    fetchData();
    
    setInterval(fetchData, 2000);