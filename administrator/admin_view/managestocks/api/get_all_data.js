document.addEventListener("DOMContentLoaded", function() {
    const purchasedButton = document.getElementById("purchasedButton");
  
    purchasedButton.addEventListener("click", function() {
      // Collect data from form fields

      const supplier = $("#supplier").val();
      const referenceNo = $("#referenceNo").val();
      const acc_id = $("#acc_id").val();

      const purchase_id=$("#purchase_id").val();

      var flag = true;

      const tableData = collectTableData();
  
      const dataToSend = {
        supplier,
        referenceNo,
        acc_id,
        tableData,
        purchase_id
      };
;

if(referenceNo.length ===0){
  alertify.error("Reference number is required .");
  $('#referenceNo').attr('placeholder', 'Enter your Reference number here');
  $('#referenceNo').css('background-color', 'rgb(255, 204, 153)');

  
  return ;
}





if (Array.isArray(tableData) && tableData.length <=0) {
  alertify.error("Purchase table is empty. Insert products before purchased.");
  flag=false;
  return ;
} 



var formData = new FormData();

formData.append("referenceNo", referenceNo);




                          $.ajax({
                            type: "POST",
                            url: "managestocks/api/check_reference.php",
                            data: formData,
                            processData: false, // Prevent jQuery from automatically processing the data
                            contentType: false, // Ensure that the content type is set to false
                                  success: function (response) {
                                    console.log(response)
                                  if (response !== "match") {

                                  
                                      
                                    
                                      var message = "You cannot edit this after you purchase .";
                                    
                                      // Show the initial SweetAlert with "Yes" and "Cancel" options
                                      Swal.fire({
                                        title: "Are you sure?",
                                        text: message,
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Yes",
                                        cancelButtonText: "Cancel",
                                        confirmButtonClass: "btn btn-primary",
                                        cancelButtonClass: "btn btn-danger ml-1",
                                        buttonsStyling: false,
                                      }).then(function (result) {
                                        if (result.value) {
                                          // If the user clicks "Yes," proceed with the AJAX request
                                    
                                  // Send the data via AJAX to a PHP script for processing
                                          $.ajax({
                                              url: 'managestocks/controller/Purchased_process_data.php',  // Update with your PHP script URL
                                              method: 'POST',
                                              data: dataToSend,
                                              success: function(response) {
                                                console.log('Data successfully sent to the server:', response);
                                               alertify.success("Stocks successfully added.");
                                              window.location.href = 'purchaselist.php';
                                              },
                                              error: function(xhr, status, error) {
                                                console.error('Error sending data:', error);

                                              }
                                            });

                                            } else {
                                              // If the user clicks "Cancel," handle any necessary actions (e.g., toggle the checkbox state)
                                              // You might want to perform some action here
                                            }
                                          });
                                      
                                             //ajax end
                                          } else {
                                            // if reference number is already exist
                                            console.log(response);
                                            alertify.error("Reference number is already exist.");
                                            
                                        }
                                    }
                                });

                               
    });
  });
  

  
  
  function collectTableData() {
    
    const tableData = [];
  
    // Get the table
    const table = document.querySelector("#purchasedcartTable table");
  
    // Get all table rows (excluding the header row)
    const rows = table.querySelectorAll("tbody tr");
  
    // Iterate through the rows and collect the data
    rows.forEach(function(row) {
      const rowData = {};
  
      // Get all the cells in the current row
      const cells = row.querySelectorAll("td");
  
      // Extract data from each cell
      rowData.productName = cells[0].textContent;
      rowData.qty = cells[1].textContent;
      rowData.unit = cells[2].textContent;
      rowData.price = cells[3].textContent;
      rowData.Expiration = cells[6].textContent;
      rowData.Tax = cells[7].textContent;
      rowData.TaxAmount	 = cells[8].textContent;
      rowData.Discount	 = cells[9].textContent;
      rowData.TotalCost = cells[10].textContent;
      rowData.prod_id = cells[12].textContent;
      

      /*
      rowData.purchasePrice = cells[2].textContent;
      rowData.expiration = cells[3].textContent;//
      rowData.tax = cells[4].textContent;//prod id
      rowData.discount = cells[5].textContent;//tax check
      rowData.taxAmount = cells[6].textContent;//
      
      rowData.totalCost = cells[7].textContent;//discount check
      rowData.prod_id = cells[8].textContent;//total cost
      */
     
     
  
      // Add this row's data to the array
      tableData.push(rowData);


      console.log(rowData)
    });
  
    return tableData;
  }
  
  