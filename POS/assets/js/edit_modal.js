$(document).ready(function () {
    $(document).on('click', '.delete', function () {
        var pcode = $(this).data('pcode'); // Get product code from data attribute
        $('#pcode').val(pcode); // Set the value of the element with id "pcode"
        $('#deleteModal').modal('show'); // Show the modal
    });

    $(document).on('click', '.add-product', function () {
        var add = $(this).data('add'); // Get product code from data attribute
        $('#add').val(add); // Set the value of the element with id "add"
        $('#add_Modal').modal('show'); // Show the modal
    });

    $(document).on('click', '.edit-product', function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var orgprice = $(this).data('orgprice');
        var currprice = $(this).data('currprice');
        var clevel = $(this).data('clevel');
        var description = $(this).data('description');
        var imageUrl = $(this).data('imageurl'); // Assuming you have an 'imageurl' data attribute for the image

        // Set the values in the modal fields
        $('#id').val(id);
        $('#name').val(name);
        $('#orgprice').val(orgprice);
        $('#currprice').val(currprice);
        $('#clevel').val(clevel);
        $('#description').val(description);

        // Select the corresponding radio button based on data
        var categoryValue = $(this).data('cat_id'); // Replace with the appropriate category value
        var unitValue = $(this).data('unit_id'); // Replace with the appropriate unit value

        // Use the values to select the radio buttons
        $("input[name='category'][value='" + categoryValue + "']").prop('checked', true);
        $("input[name='unit'][value='" + unitValue + "']").prop('checked', true);

        $('#edit_Modal').modal('show'); // Show the modal
    });
});