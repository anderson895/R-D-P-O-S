$(document).ready(function () {
  function updateStockTable() {
    var invoice_no = $("#invoice_no").val();
    var filter = $("#expirationFilter").val(); // Get selected filter value

    $.ajax({
        type: "POST",
        url: "stock_in/controller/get_stock_data.php",
        data: { invoice_no: invoice_no },
        dataType: "json",
        success: function (data) {

            console.log(data);
            $("#stockTableBody").empty();

            // Get today's date
            var today = new Date();

            $.each(data, function (index, row) {
                var expirationDate = new Date(row.s_expiration);
                var diffTime = expirationDate - today; // Difference in milliseconds
                var diffDays = diffTime / (1000 * 3600 * 24); // Convert ms to days

                // Apply expiration status color and border
                var expirationStatus = '';
                if (diffDays < 0) {
                    expirationStatus = 'expired';
                } else if (diffDays <= 180) { // Items expiring within 6 months (180 days)
                    expirationStatus = 'soon_to_expire';
                } else {
                    expirationStatus = 'normal';
                }

                // Filter based on the selected filter value
                if (filter === 'all' || filter === expirationStatus) {
                    var html = "<tr>";
                    html += '<td><input type="checkbox" id="EachCheckbox"></td>';
                    html += "<td>" + row.prod_name + "</td>";
                    html += "<td>" + row.s_stock_in_qty + "</td>";
                    html += "<td>" + row.s_amount + "</td>";
                    html += "<td>" + row.unit_type + "</td>";
                    html += "<td>" + row.prod_currprice + "</td>";
                    html += "<td>" + row.s_supplierPrice + "</td>";
                    html += "<td>" + ((row.prod_currprice - row.s_supplierPrice).toFixed(2)) + "</td>";

                    // Set expiration date cell
                    var expirationCell = row.s_expiration !== "0000-00-00" ? row.s_expiration : "No expiration";
                    html += "<td class='expiration-date'>" + expirationCell + "</td>";
                    html += "<td>" + row.s_stockin_date + "</td>";

                    html += '<td class="text-end">';
                    html +=
                        '<button class="btn btn-sm border editTogler" data-bs-toggle="modal" data-bs-target="#edit" ' +
                        'data-db_prod_name="' + row.prod_name + '" ' +
                        'data-db_s_expiration="' + row.s_expiration + '" ' +
                        'data-db_s_supplierPrice="' + row.s_supplierPrice + '" ' +
                        'data-db_s_amount="' + row.s_amount + '" ' +
                        'data-db_prod_kg="' + row.prod_kg + '" ' +
                        'data-db_prod_ml="' + row.prod_ml + '" ' +
                        'data-db_prod_g="' + row.prod_g + '" ' +
                        'data-db_prod_image="' + row.prod_image + '" ' +
                        'data-db_prod_currprice="' + row.prod_currprice + '" ' +
                        'data-db_prod_expirationStatus="' + row.prod_expirationStatus + '" ' +
                        'data-db_prod_code="' + row.prod_code + '" ' +
                        'data-db_s_id="' + row.s_id + '" ' +
                        ">Edit</button>";
                    html +=
                        '<button class="btn btn-sm border btnRemove" data-db_s_id="' + row.s_id + '">Remove</button>';
                    html += "</td></tr>";

                    // Append row to the table
                    var $row = $(html);

                    // Apply dynamic text color and border to the expiration date cell based on status
                    if (expirationStatus === 'expired') {
                        $row.find('.expiration-date').css({
                            'color': 'red',
                            'border': '1px solid red'
                        });
                    } else if (expirationStatus === 'soon_to_expire') {
                        $row.find('.expiration-date').css({
                            'color': 'orange',
                            'border': '1px solid orange'
                        });
                    } else {
                        $row.find('.expiration-date').css({
                            'color': 'green',
                            'border': '1px solid green'
                        });
                    }

                    $("#stockTableBody").append($row);
                }
            });
        },
    });
}


// Call the update function initially and set an interval to update periodically
updateStockTable();
var updateInterval = setInterval(updateStockTable, 2000);

// Add event listener to the filter dropdown to trigger the update when filter changes
$("#expirationFilter").change(function () {
    updateStockTable();
});





  // Event listener for the "Select All" checkbox
  $("#AllCheckbox").change(function () {
    var isChecked = $(this).prop("checked");
    $("#stockTableBody").find("input:checkbox").prop("checked", isChecked);

    // Stop the interval when "Select All" is checked
    if (isChecked) {
      clearInterval(updateInterval);
    }
  });

  // Event listener for individual checkboxes
  $("#stockTableBody").on("change", "input:checkbox", function () {
    // Check if all individual checkboxes are checked
    var allChecked =
      $("#stockTableBody").find("input:checkbox:not(#AllCheckbox)").length ===
      $("#stockTableBody").find("input:checkbox:checked:not(#AllCheckbox)")
        .length;

    // Update the "Select All" checkbox accordingly
    $("#AllCheckbox").prop("checked", allChecked);

    // Stop the interval when any individual checkbox is unchecked
    if (!allChecked) {
      clearInterval(updateInterval);
    }
  });

 

  $(document).on("click", ".editTogler", function () {
    var db_prod_name = $(this).attr("data-db_prod_name");

    var db_prod_code = $(this).attr("data-db_prod_code");
    var db_s_expiration = $(this).attr("data-db_s_expiration");

    var db_s_amount = $(this).attr("data-db_s_amount");

    var db_prod_kg = $(this).attr("data-db_prod_kg");
    var db_prod_ml = $(this).attr("data-db_prod_ml");
    var db_prod_g = $(this).attr("data-db_prod_g");

    var db_prod_currprice = $(this).attr("data-db_prod_currprice");
    var db_prod_expirationStatus = $(this).attr(
      "data-db_prod_expirationStatus"
    );
    var db_prod_image = $(this).attr("data-db_prod_image");

    var db_prod_id = $(this).attr("data-db_prod_id");

    var db_s_id = $(this).attr("data-db_s_id");

    var db_s_supplierPrice = $(this).attr("data-db_s_supplierPrice");

    $("#prod_expirationStatus").val(db_prod_expirationStatus);

    $("#updateqtyInput").val(db_s_amount);
    $("#updatesupplierPriceInput").val(db_s_supplierPrice);

    $("#db_s_id").val(db_s_id);

    $("#searchProductCode").val(db_prod_code);

    $("#searchProductCode").val(db_prod_code);
    $("#updatesearchProductCode").val(db_prod_code);
    $("#updateprod_expirationStatus").val(db_prod_expirationStatus);

    if (db_prod_expirationStatus == "N/A") {
      $("#updateexpiDateDiv").hide();
    } else {
      $("#updateexpiDateDiv").show();
      $("#updateexpiDate").val(db_s_expiration);
    }

    $("#updateproductname").html(
      "Product Name: " +
        (db_prod_name ? db_prod_name + "<br>" : "") +
        ("Current price:" +
          (db_prod_currprice
            ? "₱" + Number(db_prod_currprice).toFixed(2) + "<br>"
            : ""))
    );

    $("#UpdateunitLabel").show();

    $("#UpdateunitLabel").html(
      (db_prod_kg != 0 ? db_prod_kg + " Kg<br>" : "") +
        (db_prod_ml != 0 ? db_prod_ml + " Ml<br>" : "") +
        (db_prod_g != 0 ? db_prod_g + " g<br>" : "")
    );

    if (db_prod_image) {
      var imagePath = "../../upload_prodImg/" + db_prod_image;

      $("#updateproductImage").attr("src", imagePath);
      $("#updateproductImage").show();
    } else {
      $("#updateproductImage").hide();
    }
  });
});
