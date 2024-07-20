
$(document).ready(function() {


    //const today = new Date().toISOString().split('T')[0];
    //const expirationDateDateInput = document.getElementById('expirationDate');
    //expirationDateDateInput.setAttribute('min', today);
    //expirationDateDateInput.value = today;  // Set default value to today

    const today = new Date();
    today.setDate(today.getDate() + 1); // Set to tomorrow

    const tomorrow = today.toISOString().split('T')[0];

    const expirationDateDateInput = document.getElementById('expirationDate');
    expirationDateDateInput.setAttribute('min', tomorrow);
    expirationDateDateInput.value = tomorrow;  // Set default value to tomorrow



  var tempStorage = []; // Temporary storage array

  // Event handler for plus icon click
  $('.toglerAddPurchase').on('click', function(event) {
    event.preventDefault();

    // Get the values from the corresponding fields
    var supplierName = $('#supplier').val();
  
    var productName = $('#productName').val();

    var selectedProductName = $('#productName option:selected').text();

 

    $("#productnameLabeled").text(selectedProductName);
  
    $('#supplierNameModal').val(supplierName);
 
    $('#productNameModal').val(productName);


    var selectedOption = $("#productName").find(":selected");
    var unitName = selectedOption.attr("data-unitname");

    var prod_currprice = selectedOption.attr("data-prod_currprice");
    var prod_stocks = selectedOption.attr("data-prod_stocks");
    var prod_image = selectedOption.attr("data-prod_image");


    

    //console.log(prod_currprice)
    //console.log(prod_stocks)

    console.log(unitName);
    
    unitName = unitName.charAt(0).toUpperCase() + unitName.slice(1);

    
    $("#unit").text(unitName);
    $("#currentprice").text(prod_currprice);
    $("#stocks").text(prod_stocks);
 
    $("#productImage").attr("src", "../../upload_prodImg/" + prod_image);
    

    
  
  });
});