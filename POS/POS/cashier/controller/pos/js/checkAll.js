// Event handler for "Check All" checkbox
$(document).on('click', '#checkAll', function() {
  var isChecked = $(this).prop('checked');
  
  // Filter out products with product_qty equal to 0 or null
  var $productCheckboxes = $('input[name="product[]"]').filter(function() {
    var productQty = parseFloat($(this).closest('tr').find('input[name="product_qty[]"]').val());
    return productQty > 0; // Return true if productQty is greater than 0
  });

  // Check/Uncheck the filtered checkboxes
  $productCheckboxes.prop('checked', isChecked);

  checkSelectedCheckboxes();
});
