function view_product(id) {
  
    window.location.href = "view_product.php?view_id=" + id;
  
  }

$('.togler').click(function(){
    id = $(this).attr('data-id')
    $('#id').val(id).hide()
})

//ssid
$('.toglerBuyNow').click(function(){
  ssid = $(this).attr('data-ssid')
  $('#ssid').val(ssid)

  console.log(ssid)



  myCheckbox = $(this).attr('data-id')
  $('#myCheckbox').val(myCheckbox)

  prod_name = $(this).attr('data-db_prod_name')
  $('#prod_name').val(prod_name)

  prod_currprice = $(this).attr('data-db_prod_currprice')
  $('#prod_currprice').val(prod_currprice)


  console.log(prod_name)
})

$(document).ready(function () {
  $('#saveFilters').on('click', function () {
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
});


// Function to update the product list in the UI
function updateProductList(products) {
  // Get the product container element where you want to display products
  var productContainer = $('#productContainer');

  // Clear the existing products from the container
  productContainer.empty();

  // Loop through the filtered and sorted products and create HTML elements
  for (var i = 0; i < products.length; i++) {
    var product = products[i];
    var productHTML = `
      <!-- Create the HTML for each product card based on the product data -->
      <div class="col-xl-3 col-lg-4 col-sm-6 col-6 mt-4 product ${product.prod_category} categprod${product.prod_category}" data-name="${product.prod_name}">
 
      <div class="card shadow custom-card" style="background-color: transparent;">
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
                        <h6 class="card-title" style="font-size: 12px;">${product.prod_name}</h6>
                        <h6 style="font-size: 20px; font-family: Franklin Gothic Medium; color: black;">${product.prod_currprice}</h6>
                    </div>
                </div>
      </div>
    `;



    
    // Append the product HTML to the container
    productContainer.append(productHTML);
  }

  
}






