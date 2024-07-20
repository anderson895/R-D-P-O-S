
$(document).ready(function() {
    function view_product(id) {
  
    window.location.href = "view_product.php?view_id=" + id;
  
  }

$('.togler').click(function(){
    id = $(this).attr('data-id')
    $('#id').val(id).hide()
    
})

$(document).ready(function () {
    const prodSlider = document.getElementById('prodSlider');
    var generalLabel = $('#generalLabel');
   
    
    $("#load-more").show();
    $("#load-morefilter").hide();


  $('#saveFilters').on('click', function () {

    prodSlider.style.display = "none";
    

    $('#generalLabel').text("Filtered Result")
    $(".btn-close").click();
    $("#VoucherBannerSection").hide();
    




  // console.log(generalLabel.text());
    $('html, body').animate({
            scrollTop: $('#productContainer').offset().top
        }, 'slow');





    $("#load-more").hide();
    $("#load-morefilter").show();
    
    // Get the selected sorting option (by date, name, or price)
    var sortByDate = $('#sortByDate').prop('checked');
    var sortByName = $('#sortByName').prop('checked');
    var sortByPrice = $('#sortByPrice').prop('checked'); // Added for sorting by price

    // Get the selected order option (ascending or descending)
    var ascendingOrder = $('#ascendingOrder').prop('checked');
    var descendingOrder = $('#descendingOrder').prop('checked');

    // Get the selected category checkboxes
    var selectedCategories = [];
    $('.category-checkbox:checked').each(function () {
      selectedCategories.push($(this).val());
    });

    // Apply filtering based on selected categories
    var filteredProducts = All_product.filter(function (product) {
      if (selectedCategories.length > 0 && !selectedCategories.includes(product.prod_category)) {
        return false;
      }
      return true;
    });

    // Sort the filtered products based on the selected sorting and order
    if (sortByDate) {
      filteredProducts.sort(function (a, b) {
        var dateA = new Date(a.prod_added);
        var dateB = new Date(b.prod_added);
        return ascendingOrder ? dateA - dateB : dateB - dateA;
      });
    } else if (sortByName) {
      filteredProducts.sort(function (a, b) {
        var nameA = a.prod_name.toLowerCase();
        var nameB = b.prod_name.toLowerCase();
        return ascendingOrder ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
      });
    } else if (sortByPrice) {
      filteredProducts.sort(function (a, b) {
        var priceA = parseFloat(a.prod_currprice);
        var priceB = parseFloat(b.prod_currprice);
        return ascendingOrder ? priceA - priceB : priceB - priceA;
      });
    }

    // Now you have the filtered and sorted products, you can update your UI here
    updateProductList(filteredProducts);
  });

  $('#saveDefault').on('click', function () {
    window.location.reload(); // Corrected the function name
    });



});

// Define a variable to keep track of the number of initially displayed products
var initialDisplayCount = 8;

// Function to update the product list in the UI
function updateProductList(products) {

  // Get the product container element where you want to display products
  var productContainer = $('#productContainer');

  // Clear the existing products from the container
  productContainer.empty();

  // Loop through the filtered and sorted products and create HTML elements
  for (var i = 0; i < Math.min(products.length, initialDisplayCount); i++) {
    var product = products[i];

    
    var old_price = product.prod_currprice;
          var get_discount_value = product.prod_currprice * product.db_voucher_discount;
          var new_price = old_price - get_discount_value;

          var old_price = parseFloat(old_price);

          
          var productHTML = `
<div class="col-xl-3 col-lg-4 col-sm-6 col-6 mt-4 product ${product.prod_category} categprod${product.prod_category}" data-name="${product.prod_name}">
  <div class="card shadow custom-card" style="background-color: transparent; height: 350px;">
      <div style="width: 100%; height: 170px; position: relative;">`;

          if (product.prod_image) {
              productHTML += `
                  <a href="view_product.php?view_id=${product.prod_id}" style="margin: 0px; padding: 0px;">
                      <img src="../upload_prodImg/${product.prod_image}" style="width: 100%; height: 100%; border: none; object-fit: cover;" class="rounded-top-1 border-bottom" alt="...">
                  </a>
                  <div class="card-body">
                      <div class="cart-logo">
                          <i class="fas fa-shopping-cart" onclick="view_product(${product.prod_id})"></i>
                      </div>
                  </div>`;
          } else {
              productHTML += `
                  <a href="view_product.php?view_id=${product.prod_id}" style="margin: 0px; padding: 0px;">
                      <img src="../upload_prodImg/no_available.jpg" style="width: 100%; height: 100%; border: none; object-fit: cover;" class="rounded-top-1 border-bottom" alt="...">
                  </a>
                  <div class="card-body">
                      <div class="cart-logo" onclick="view_product(${product.prod_id})">
                          <i class="fas fa-shopping-cart"></i>
                      </div>
                  </div>`;
          }

          productHTML += `
          </div>
          <div class="card-body">
              ${product.db_voucher_name !== null ? `<h6>Discount: ${product.db_voucher_name}</h6>` : ''}

              <h6 class="card-title" style="font-size: 12px;">
              ${product.prod_name}
              ${product.db_prod_kg !== null && product.db_prod_kg !== 0 ? `${product.db_prod_kg}Kg ` : ''}
              ${product.db_prod_ml !== null && product.db_prod_ml !== 0 ? `${product.db_prod_ml}Ml ` : ''}
              ${product.db_prod_g !== null && product.db_prod_g !== 0 ? `${product.db_prod_g}g ` : ''}
            </h6>
            
            

              ${product.db_voucher_name !== null ? `<h6 style="font-size: 20px; font-family: Arial; color: gray;"> <s class="text-decoration-line-through">₱${old_price.toFixed(2)}</s></h6>` : ''}
              <h6 style="font-size: 20px; font-family: Arial; color: black;"> ${new_price.toLocaleString(undefined, { style: 'currency', currency: 'PHP' })}</h6>
          </div>
      </div>
  </div>`;



    
    // Append the product HTML to the container
    productContainer.append(productHTML);
  }

  // Check if there are more products to display
  if (initialDisplayCount < products.length) {
    // Display the "Load More" button
    $('#load-morefilter').show();
  } else {
    // Hide the "Load More" button if no more products to display
    $('#load-morefilter').hide();
  }

  // Add a click event handler for the "Load More" button
  $('#load-morefilter').click(function () {
    // Display the next 8 products
    for (var i = initialDisplayCount; i < Math.min(products.length, initialDisplayCount + 8); i++) {
      var product = products[i];


      var old_price = product.prod_currprice;
          var get_discount_value = product.prod_currprice * product.db_voucher_discount;
          var new_price = old_price - get_discount_value;

          var old_price = parseFloat(old_price);

          var productHTML = `
<div class="col-xl-3 col-lg-4 col-sm-6 col-6 mt-4 product ${product.prod_category} categprod${product.prod_category}" data-name="${product.prod_name}">
  <div class="card shadow custom-card" style="background-color: transparent; height: 350px;">
      <div style="width: 100%; height: 170px; position: relative;">`;

          if (product.prod_image) {
              productHTML += `
                  <a href="view_product.php?view_id=${product.prod_id}" style="margin: 0px; padding: 0px;">
                      <img src="../upload_prodImg/${product.prod_image}" style="width: 100%; height: 100%; border: none; object-fit: cover;" class="rounded-top-1 border-bottom" alt="...">
                  </a>
                  <div class="card-body">
                      <div class="cart-logo">
                          <i class="fas fa-shopping-cart" onclick="view_product(${product.prod_id})"></i>
                      </div>
                  </div>`;
          } else {
              productHTML += `
                  <a href="view_product.php?view_id=${product.prod_id}" style="margin: 0px; padding: 0px;">
                      <img src="../upload_prodImg/no_available.jpg" style="width: 100%; height: 100%; border: none; object-fit: cover;" class="rounded-top-1 border-bottom" alt="...">
                  </a>
                  <div class="card-body">
                      <div class="cart-logo" onclick="view_product(${product.prod_id})">
                          <i class="fas fa-shopping-cart"></i>
                      </div>
                  </div>`;
          }

          productHTML += `
          </div>
          <div class="card-body">
             ${product.db_voucher_name !== null ? `<h6>Discount: ${product.db_voucher_name}</h6>` : ''}

             <h6 class="card-title" style="font-size: 12px;">
             ${product.prod_name}
             ${product.db_prod_kg !== null && product.db_prod_kg !== 0 ? `${product.db_prod_kg}Kg ` : ''}
             ${product.db_prod_ml !== null && product.db_prod_ml !== 0 ? `${product.db_prod_ml}Ml ` : ''}
             ${product.db_prod_g !== null && product.db_prod_g !== 0 ? `${product.db_prod_g}g ` : ''}
           </h6>
           

              ${product.db_voucher_name !== null ? `<h6 style="font-size: 20px; font-family: Arial; color: gray;"> <s class="text-decoration-line-through">₱${old_price.toFixed(2)}</s></h6>` : ''}
              <h6 style="font-size: 20px; font-family: Arial; color: black;"> ${new_price.toLocaleString(undefined, { style: 'currency', currency: 'PHP' })}</h6>
          </div>
      </div>
  </div>`;

      // Append the product HTML to the container
      productContainer.append(productHTML);
    }

    // Update the initialDisplayCount
    initialDisplayCount += 8;

    // Check if there are more products to display
    if (initialDisplayCount >= products.length) {
      // Hide the "Load More" button if no more products to display
      $('#load-morefilter').hide();
    }
  });
}















    var productContainer = $("#productContainer");
    var productLimit = 8;
    var currentProductCount = 0;
// Function to append products to the container
function appendProducts(startIndex, endIndex) {
  for (var i = startIndex; i < endIndex; i++) {
      if (i < All_product.length) {
          var product = All_product[i];

          console.log(product)
          var old_price = product.prod_currprice;
          var get_discount_value = product.prod_currprice * product.db_voucher_discount;
          var new_price = old_price - get_discount_value;

          var old_price = parseFloat(old_price);

          var productHTML = `
<div class="col-xl-3 col-lg-4 col-sm-6 col-6 mt-4 product ${product.prod_category} categprod${product.prod_category}" data-name="${product.prod_name}">
  <div class="card shadow custom-card" style="background-color: transparent; height: 350px;">
      <div style="width: 100%; height: 170px; position: relative;">`;

          if (product.prod_image) {
              productHTML += `
                  <a href="view_product.php?view_id=${product.prod_id}" style="margin: 0px; padding: 0px;">
                      <img src="../upload_prodImg/${product.prod_image}" style="width: 100%; height: 100%; border: none; object-fit: cover;" class="rounded-top-1 border-bottom" alt="...">
                  </a>
                  <div class="card-body">
                      <div class="cart-logo">
                          <i class="fas fa-shopping-cart" onclick="view_product(${product.prod_id})"></i>
                      </div>
                  </div>`;
          } else {
              productHTML += `
                  <a href="view_product.php?view_id=${product.prod_id}" style="margin: 0px; padding: 0px;">
                      <img src="../upload_prodImg/no_available.jpg" style="width: 100%; height: 100%; border: none; object-fit: cover;" class="rounded-top-1 border-bottom" alt="...">
                  </a>
                  <div class="card-body">
                      <div class="cart-logo" onclick="view_product(${product.prod_id})">
                          <i class="fas fa-shopping-cart"></i>
                      </div>
                  </div>`;
          }

          productHTML += `
          </div>
          <div class="card-body">
              ${product.db_voucher_name !== null ? `<h6>Discount: ${product.db_voucher_name}</h6>` : ''}

              <h6 class="card-title" style="font-size: 12px;">
              ${product.prod_name}
              ${product.db_prod_kg !== null && product.db_prod_kg !== 0 ? `${product.db_prod_kg}Kg ` : ''}
              ${product.db_prod_ml !== null && product.db_prod_ml !== 0 ? `${product.db_prod_ml}Ml ` : ''}
              ${product.db_prod_g !== null && product.db_prod_g !== 0 ? `${product.db_prod_g}g ` : ''}
            </h6>
            
              ${product.db_voucher_name !== null ? `<h6 style="font-size: 20px; font-family: Arial; color: gray;"> <s class="text-decoration-line-through">₱${old_price.toFixed(2)}</s></h6>` : ''}
              <h6 style="font-size: 20px; font-family: Arial; color: black;"> ${new_price.toLocaleString(undefined, { style: 'currency', currency: 'PHP' })}</h6>
          </div>
      </div>
  </div>`;

          productContainer.append(productHTML);
          currentProductCount++;
      }
  }
  // Check if there are more products to load
  if (currentProductCount >= All_product.length) {
      // Hide the "Load More" button if there are no more products
      $("#load-more").hide();
  }
}


    // Initial load of products
    appendProducts(0, productLimit);

    // Handle "Load More" button click

    
    $("#load-more").click(function() {
        var nextIndex = currentProductCount;
        var endIndex = nextIndex + productLimit;
        appendProducts(nextIndex, endIndex);
    });
});