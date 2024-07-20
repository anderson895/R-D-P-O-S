// Assuming you're using jQuery
$(document).ready(function () {
  $(".add-to-cart-button").click(function () {
    var prodId = $(this).data("prod-id");
    var stocks = $(this).data("stocks");
    var name = $(this).data("name");
    var unitType = $(this).data("unit_type");

    $("#prod_id_input").val(prodId);
    $("#stocks_inputs").val(stocks);
    $("#add #stocks_inputs").val(stocks);
    $("#add #add_name").val(name);
    $("#posATCUnitType").text(unitType);
  });
});
