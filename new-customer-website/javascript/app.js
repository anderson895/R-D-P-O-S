$(document).ready(function () {
  var isNavOpen = false;
  var search = "";
  var category = "All";
  var isProfileDDOpen = false;


  // cart count
  const cartCount = () => {
    $.ajax({
      type: "GET",
      url: "backend/end-points/random.php",
      data: {
        requestType: "GetCartCount",
      },
      success: function (response) {
        $("#cart-count").text(response);
      },
    });
  }

  cartCount();

  setInterval(() => {
    cartCount();
  }, 1000)


  // 

  $(document).click(function (e) {
    if (!$(e.target).closest("#btnProfileDropdown").length) {
      $('#dropDownItems').hide();
      isProfileDDOpen = false;
    }
  });

  $("#btnProfileDropdown").click(function (e) {
    if (isProfileDDOpen) {
      $('#dropDownItems').hide();
    } else {
      $('#dropDownItems').show();
    }

    isProfileDDOpen = !isProfileDDOpen;
  });

  //   Side Bar
  $("#btnToggleSideBar").click(function (e) {
    e.preventDefault();
    if (isNavOpen) {
      $(".side-nav").css("transform", "translateX(-100%)");
    } else {
      $(".side-nav").css("transform", "translateX(0)");
    }

    isNavOpen = !isNavOpen;
  });

  $(window).resize(function () {
    var windowWidth = $(window).width();
    if (windowWidth > 800) {
      isNavOpen = true;
      $(".side-nav").css("transform", "translateX(0)");
    } else {
      isNavOpen = false;
      $(".side-nav").css("transform", "translateX(-100%)");
    }
  });
  //   End of Side Bar

  //   Functions
  const showAlert = (alertType, text) => {
    $(alertType).text(text).css("opacity", "1");
    setTimeout(() => {
      $(alertType).css("opacity", "0");
    }, 1000);
  };

  const displayProduct = (search, category) => {
    $.ajax({
      type: "GET",
      url: "backend/end-points/get-all-products.php",
      data: {
        requestType: "getAllProducts",
        search: search,
        category: category,
      },
      success: function (response) {
        $("#allProductsContainer").html(response);
      },
    });
  };

  const displayCartItems = () => {
    $.ajax({
      type: "GET",
      url: "backend/end-points/get-cart-items.php",
      data: {
        requestType: "getAllCartItems",
      },
      success: function (response) {
        $("#cartItemsContainer").html(response);
      },
    });
  };

  const closeModal = () => {
    $(".modal").modal("hide");
  };

  const getPaymentTypes = (callback) => {
    var data = [];

    $.ajax({
      type: "GET",
      url: "backend/end-points/random.php",
      data: {
        requestType: "GetPaymentTypes",
      },
      success: function (response) {
        data = JSON.parse(response);
        callback(data);
      },
    });
  };

  const previewImage = (input) => {
    var reader = new FileReader();
    var preview = $("#imagePreview");

    reader.onload = function () {
      preview.attr("src", reader.result);
      preview.show();
    };

    if (input.files && input.files[0]) {
      reader.readAsDataURL(input.files[0]);
    }
  };

  //   End of functions

  //   Close Modal
  $(".btnCloseModal").click(function (e) {
    // e.preventDefault();
    closeModal();
  });

  // View Product
$(document).on("click", ".btnViewProduct", function (e) {
  e.preventDefault();

  const $this = $(this);
  const productID = $this.data("id");

  // Construct product name
  const productName = [
    $this.data("name"),
    $this.data("mg") > 0 ? `${$this.data("mg")}mg` : "",
    $this.data("g") > 0 ? `${$this.data("g")}g` : "",
    $this.data("ml") > 0 ? `${$this.data("ml")}ml` : ""
  ].filter(Boolean).join(" ");

  // Construct available stock message
  const availableStock = $this.data("stock");
  const displayStock = availableStock > 0
    ? `${availableStock}${$this.data("unittype")} available`
    : "Out of Stock";

  // Update stock class
  $("#viewProductStocks").toggleClass("text-danger", displayStock === "Out of Stock")
                          .toggleClass("text-success", displayStock !== "Out of Stock");

  // Display product data
  $("#viewProductName").text(productName);
  $("#viewProductPicture").attr("src", `../upload_prodImg/${$this.data("image")}`);
  $("#viewProductDescription").text($this.data("description"));
  $("#viewProductStocks").text(displayStock);
  $("#viewProductPrice").text(`PHP ${$this.data("price")}`);
  $("#btnViewProdAddToCart").data("prodid", productID);

  // Fetch product photos
  $.ajax({
    url: 'backend/end-points/fetchProductPhotos.php',
    type: 'POST',
    dataType: 'json',
    data: { productID: productID },
    success: function (photos) {
      // Clear the photo container
      $('#productPhotos-modal-sm-img-container').empty();

      // Add each photo to the container
      photos.forEach(photo => {
        $('#productPhotos-modal-sm-img-container').append(`
          <img src="../product_photos/${photo}" class="product-photo-sm" />
        `);
      });

      // Set the first photo as the main product image
      if (photos.length > 0) {
        $("#viewProductPicture").attr("src", `../product_photos/${photos[0]}`);
      }
    },
    error: function (xhr, status, error) {
      console.error('AJAX Error:', status, error);
    }
  });

  $("#viewProductModal").modal("show");

  // Handle the click event for the small product photos
  $(document).on("click", "#productPhotos-modal-sm-img-container .product-photo-sm", function () {
    const src = $(this).attr("src");
    $("#viewProductPicture").attr("src", src);
  });

});





  //   Add To Cart
  $("#btnViewProdAddToCart").click(function (e) {
    e.preventDefault();
    var productId = $(this).data("prodid");

    $.ajax({
      type: "POST",
      url: "backend/end-points/product.php",
      data: {
        requestType: "AddToCart",
        productId: productId,
      },
      success: function (response) {
        $("#viewProductModal").modal("hide");
        if (response == "400") {
          showAlert(".alert-danger", "Add To Cart Unsuccessful!");
        } else {
          showAlert(".alert-success", response);
        }
      },
    });
  });

  // Search Product
  $("#searchProduct").on("input", function (e) {
    e.preventDefault();
    search = $(this).val();

    $("#productCategory").val("All");
    displayProduct(search, category);
  });

  $("#productCategory").change(function (e) {
    e.preventDefault();
    $("#searchProduct").val("");
    search = "";
    category = $(this).val();
    displayProduct(search, category);
  });

  // Cart
  $(document).on("click", ".minusCartQty", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
      type: "POST",
      url: "backend/end-points/cart.php",
      data: {
        requestType: "updateCartQtyMinus",
        id: id,
      },
      success: function (response) {
        displayCartItems();
      },
    });
  });

  $(document).on("click", ".addCartQty", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
      type: "POST",
      url: "backend/end-points/cart.php",
      data: {
        requestType: "updateCartQtyAdd",
        id: id,
      },
      success: function (response) {
        displayCartItems();
      },
    });
  });

  $(document).on("blur", ".inputChangeCartItemQty", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var inputQty = $(this).val();
    var inputQty = parseInt($(this).val(), 10);
    console.log(inputQty);
    if (inputQty == 0 || isNaN(inputQty) || !Number.isInteger(inputQty) || inputQty < 1) {
      inputQty = 1;
      $(this).val(inputQty);
      console.log("Invalid Input!");
    }

    $.ajax({
      type: "POST",
      url: "backend/end-points/cart.php",
      data: {
        requestType: "updateCartQty",
        id: id,
        inputQty: inputQty,
      },
      success: function (response) {
        displayCartItems();
      },
    });
  });

  $(document).on("click", ".btnDeleteCartItem", function (e) {
    e.preventDefault();
    var id = $(this).data("id");

    $("#deleteCartItemQDisplay").text(
      "Are you sure that you want to delete this product in your cart?"
    );
    $("#btnDeleteCartItem").data("prodid", id);
    $("#deleteCartItemModal").modal("show");
  });

  $("#deleteAllItemsInCart").click(function (e) {
    e.preventDefault();
    $("#deleteCartItemQDisplay").text(
      "Are you sure that you want to delete all products in your cart?"
    );
    $("#btnDeleteCartItem").data("prodid", "All");
    $("#deleteCartItemModal").modal("show");
  });

  $("#btnDeleteCartItem").click(function (e) {
    e.preventDefault();
    var id = $(this).data("prodid");
    if (id == "All") {
      $.ajax({
        type: "POST",
        url: "backend/end-points/cart.php",
        data: {
          requestType: "deleteAllCartItem",
        },
        success: function (response) {
          closeModal();
          if (response == "200") {
            showAlert(".alert-success", "Items Deleted!");
          } else {
            showAlert(".alert-success", "Something went wrong!");
          }
          displayCartItems();
        },
      });
    } else {
      $.ajax({
        type: "POST",
        url: "backend/end-points/cart.php",
        data: {
          requestType: "deleteCartItem",
          id: id,
        },
        success: function (response) {
          closeModal();
          if (response == "200") {
            showAlert(".alert-success", "Item Deleted!");
          } else {
            showAlert(".alert-success", "Something went wrong!");
          }
          displayCartItems();
        },
      });
    }
  });

  $(document).on("change", ".cartSelect", function (e) {
    e.preventDefault();
    var totalAmount = 0;

    $(".cartSelect:checked").each(function () {
      var amount = $(this).data("amount");

      if (!isNaN(amount)) {
        totalAmount += amount;
      }
    });

    $("#totalSelectedItems").text(totalAmount);
  });

  // Check Out
  var items = [];
  $(document).on("click", "#btnCheckOut", function (e) {
    e.preventDefault();

    var sf = $(this).data("sf");
    items = [];

    var hasInvalidQty = false;
    $(".cartSelect:checked").each(function () {
      var stock = $(this).data("stock");
      var inputQty = $(this).data("inputqty");

      data = {
        productId: $(this).data("id"),
        productImage: $(this).data("image"),
        productName: $(this).data("name"),
        productPrice: $(this).data("price"),
        productUnitType: $(this).data("unittype"),
        productAmount: $(this).data("amount"),
        productVat: $(this).data("itemvat"),
        qty: inputQty,
      };

      if (inputQty > stock) {
        hasInvalidQty = true;
      } else {
        items.push(data);
      }
    });

    if (hasInvalidQty) {
      showAlert(".alert-danger", "Please check your input quantity!");
    } else {
      if (items.length > 0) {
        var subtotal = 0;
        var vat = 0;
        var total = 0;

        $("#placeOrderItemsContainer").html("");
        items.forEach((element) => {
          var tr = $("<tr>");
          $(tr).append(
            "<td class='prod-img-td'><img src='../upload_prodImg/" +
            element.productImage +
            "'></td>"
          );
          $(tr).append("<td>" + element.productName + "</td>");
          $(tr).append(
            "<td>" +
            element.qty +
            element.productUnitType +
            " x " +
            element.productPrice +
            "</td>"
          );

          $(tr).append("<td> ₱ " + element.productAmount + "</td>");

          subtotal += element.productAmount;
          vat += element.productVat;
          $("#placeOrderItemsContainer").append(tr);
        });

        // Computation
        $("#checkOutSubtotal").text(subtotal);
        $("#checkOutVat").text(vat);

        if (sf == "Invalid") {
          $("#checkOutShipping")
            .text("Address out of coverage!")
            .addClass("text-danger");
          $("#btnPlaceOrder").prop("disabled", true);
        } else {
          $("#checkOutShipping").text("₱ " + sf);
          total += sf;
        }

        total += subtotal;
        total += vat;
        $("#checkOutTotal").text(total);

        $("#PlaceOrderModal").modal("show");
      } else {
        showAlert(".alert-danger", "Please select items.");
      }
    }
  });

  // Payment Type
  $("#checkOutPaymentTypesSelect").change(function (e) {
    e.preventDefault();
    var selectedOption = $(this).find("option:selected");
    $("#paymentTypeImgInput").val(null);
    $("#imagePreview").attr("src", "#");
    $("#imagePreview").hide();

    if ($(this).val() == "cod") {
      $("#paymentNumberContainer").text("");
      $("#paymentImgContainer").attr("src", "");
      $(".upload-payment-container").css("display", "none");
    } else {
      $("#btnPlaceOrder").prop("disabled", true);
      $("#paymentNumberContainer").text(selectedOption.data("number"));
      $("#paymentImgContainer").attr(
        "src",
        "../upload_system/" + selectedOption.data("img")
      );

      $(".upload-payment-container").css("display", "flex");
    }
  });

  $("#pofTermsAgree").change(function (e) {
    if ($("#pofTermsAgree").is(':checked')) {
      $("#btnPlaceOrder").prop("disabled", false);
    } else {
      $("#btnPlaceOrder").prop("disabled", true);
    }
  });

  $("#paymentTypeImgInput").change(function () {
    previewImage(this);
  });

  // Place Order
  $("#btnPlaceOrder").click(function (e) {
    e.preventDefault();
    var paymentType = $("#checkOutPaymentTypesSelect").val();
    if (paymentType == "cod") {
      $.ajax({
        type: "POST",
        url: "backend/end-points/place-order.php",
        data: {
          requestType: "PlaceOrder",
          paymentType: paymentType,
          items: JSON.stringify(items),
        },
        success: function (response) {
          closeModal("PlaceOrderModal");
          displayCartItems();
          if (response == "200") {
            showAlert(".alert-success", "Order Placed!");
          } else {
            showAlert(".alert-danger", "Something Went Wrong!");
          }
        },
      });
    } else {
      if ($("#paymentTypeImgInput")[0].files.length === 0) {
        showAlert(".alert-danger", "Please Upload Proof of Payment!");
      } else {
        var formData = new FormData();

        var paymentTypeImgInput = $("#paymentTypeImgInput")[0].files[0];
        formData.append("requestType", "PlaceOrder");
        formData.append("paymentType", paymentType);
        formData.append("items", JSON.stringify(items));
        formData.append("proofOfPayment", paymentTypeImgInput);

        $.ajax({
          type: "POST",
          url: "backend/end-points/place-order.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            closeModal("PlaceOrderModal");
            displayCartItems();
            if (response == "200") {
              showAlert(".alert-success", "Order Placed!");
            } else {
              showAlert(".alert-danger", "Something Went Wrong!");
            }
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
          },
        });
      }
    }
  });
  // End of Place Order

  // Orders.php
  $("#orderSelectPage").change(function (e) {
    e.preventDefault();
    window.location.href = "orders.php?page=" + $(this).val();
  });
  // End of Orders.php

  // View-Order.php
  $("#btnCancelOrder").click(function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "backend/end-points/orders.php",
      data: {
        requestType: "CancelOrder",
        id: $(this).data("id"),
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          showAlert(".alert-success", "Order Cancelled!");
          window.location.reload();
        } else {
          showAlert(".alert-danger", "Something Went Wrong!");
        }
      },
    });
  });
  // End of View-Order.php

  // Profile
  $("#btnEditProfile").click(function (e) {
    e.preventDefault();

    $('#editFName').val($(this).data("fname"));
    $('#editLName').val($(this).data("lname"));
    $('#editBday').val($(this).data("bday"));
    $('#editUsername').val($(this).data("uname"));
    $('#editEmail').val($(this).data("email"));
    $('#editContact').val($(this).data("contact"));

    $("#editProfileModal").modal('show');
  })

  $("#frmEditProfile").submit(function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "backend/end-points/random.php",
      data: formData,
      success: function (response) {
        console.log(response);
        closeModal("editProfileModal");
        if (response == "200") {
          showAlert(".alert-success", "Edited!");
          setInterval(() => {
            window.location.reload();
          }, 1000)
        } else {
          showAlert(".alert-danger", "Something Went Wrong!");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  })
  // End of Profile

  // Function Call
  displayProduct(search, category);
  displayCartItems();

  // Put Payment Types in Select
  getPaymentTypes((data) => {
    data.forEach((type) => {
      $("#checkOutPaymentTypesSelect").append(
        `<option value="${type.payment_id}" data-img="${type.payment_image}" data-number="${type.payment_number}">${type.payment_name}</option>`
      );
    });
  });

  $("#btnEditAddress").click(function (e) {
    e.preventDefault();
    $("#editAddressModal").modal("show");
  });

  // Pick address

  const getAddressId = (id, addressType, callback) => {
    $.ajax({
      url: "../Main/controller/register/get_address_id.php",
      type: "GET",
      data: {
        addressType: addressType,
        id: id,
      },
      success: function (response) {
        // Call the callback function with the response
        console.log("start-" + response + "-end");
        callback(response);
      },
      error: function (xhr, status, error) {
        console.error("Error:", status, error);
        // Call the callback function with an error value (if needed)
        callback(null);
      }
    });
  }

  $.getJSON('../ph-json/region.json', function (data) {
    var regionDropdown = $('#regionDropDown');

    // regionDropdown.empty(); // Clear existing options

    // Loop through the data from JSON and add them as options to the dropdown
    regionDropdown.append('<option value="">Select Region</option>');
    $.each(data.data, function (key, value) {
      var checkResponse;
      getAddressId(value.region_code, 'reg_code', function (response) {
        checkResponse = response;
        if (checkResponse == 1) {
          regionDropdown.append('<option value="' + value.region_code + '">' + value.region_name + '</option>')
        }
      });
    });
  });

  $('#regionDropDown').on('change', function () {
    var selectedRegionCode = $(this).val();
    var provinceDropdown = $('#provinceDropDown');

    provinceDropdown.empty(); // Clear existing options

    $.getJSON('../ph-json/province.json', function (data) {
      var provincesInRegion = data.data.filter(function (province) {
        return province.region_code === selectedRegionCode;
      });

      provinceDropdown.append('<option value="">Select Province</option>');
      $.each(provincesInRegion, function (key, value) {
        var checkResponse;
        getAddressId(value.province_code, 'prov_code', function (response) {
          checkResponse = response;
          if (checkResponse == 1) {
            provinceDropdown.append('<option value="' + value.province_code + '">' + value.province_name + '</option>');
          }
        });
      });
    });
  });

  $('#provinceDropDown').on('change', function () {
    var selectedProvinceCode = $(this).val();
    var cityDropdown = $('#cityDropDown');

    cityDropdown.empty(); // Clear existing options

    $.getJSON('../ph-json/city.json', function (data) {
      var citiesInProvince = data.data.filter(function (city) {
        return city.province_code === selectedProvinceCode;
      });

      cityDropdown.append('<option value="">Select City</option>');
      $.each(citiesInProvince, function (key, value) {
        var checkResponse;
        getAddressId(value.city_code, 'muni_code', function (response) {
          checkResponse = response;
          if (checkResponse == 1) {
            cityDropdown.append('<option value="' + value.city_code + '">' + value.city_name + '</option>');
          }
        });
      });
    });
  });

  $('#cityDropDown').on('change', function () {
    var selectedCityCode = $(this).val();
    var barangayDropdown = $('#barangayDropDown');

    barangayDropdown.empty(); // Clear existing options

    $.getJSON('../ph-json/barangay.json', function (data) {
      var barangaysInCity = data.data.filter(function (barangay) {
        return barangay.city_code === selectedCityCode;
      });

      barangayDropdown.append('<option value="">Select Barangay</option>');
      $.each(barangaysInCity, function (key, value) {
        var checkResponse;
        getAddressId(value.brgy_code, 'address_code', function (response) {
          checkResponse = response;
          if (checkResponse == 1) {
            barangayDropdown.append('<option value="' + value.brgy_code + '">' + value.brgy_name + '</option>');
          }
        });
      });
    });
  });

  $("#frmEditAddress").submit(function (e) {
    e.preventDefault();
    var accCode = $("#editAddressAccCode").val();
    var userFullName = $("#userFullName").val();
    var userEmail = $("#userEmail").val();
    var userPhone = $("#userPhone").val();

    var barangayCode = $("#barangayDropDown").val();

    var regionName = $("#regionDropDown option:selected").text();
    var provinceName = $("#provinceDropDown option:selected").text();
    var cityName = $("#cityDropDown option:selected").text();
    var barangayName = $("#barangayDropDown option:selected").text();
    var streetName = $("#streetName").val();

    console.log(accCode)
    console.log(userFullName)
    console.log(userEmail)
    console.log(userPhone)
    console.log(barangayCode)
    console.log(streetName + " " + barangayName + " " + cityName + " " + provinceName + " " + regionName);

    $.ajax({
      type: "POST",
      url: "backend/end-points/address.php",
      data: {
        requestType: "EditAddress",
        accCode: accCode,
        userFullName: userFullName,
        userEmail: userEmail,
        userPhone: userPhone,
        barangayCode: barangayCode,
        completeAddress: regionName + " " + provinceName + " " + cityName + " " + barangayName + " " + streetName
      },
      success: function (response) {
        console.log("response: " + response)
        if (response == "200") {
          showAlert(".alert-success", "Success!");
          setInterval(() => {
            window.location.reload();
          }, 1000)
        } else {
          showAlert(".alert-danger", "Something Went Wrong!");
        }
      }
    });
  });











  $(".rateToggler").click(function (e) { 
    e.preventDefault();
    var prod_id=$(this).attr("data-prod_id");
    console.log(prod_id)


    $('#ts-frm-Id').val(prod_id);
    
  });



// rate and reviews
$(".btnTsFrmStar").click(function () {
  var clickedId = $(this).data("id");
  $(".btnTsFrmStar").removeClass("active"); // Remove active class from all buttons
  $(".btnTsFrmStar:lt(" + clickedId + ")").addClass("active"); // Add active class to buttons up to the clicked one
  $("#tsfrmStar").val(clickedId);
});












$("#tsFrmRate").submit(function (e) {
  e.preventDefault();
  var id = $("#ts-frm-Id").val();
  var star = $("#tsfrmStar").val();
  var review = $("#tsFrmModalReview").val();
  

  $.ajax({
    type: "POST",
    url: "backend/end-points/rate.php",
    data: {
      requestType: "Rate",
      id: id,
      star: star,
      review: review,
    },
    success: function (response) {
      closeModal();
      console.log(response);
      if (response == "200") {
        showAlert("alert-success", "Thanks for rating!");
        setTimeout(() => {
          window.location.reload();
        }, 1000);
      } else {
        showAlert("alert-danger", "Failed to rate");
      }
    },
  });
});


});
