$('.toglerView').click(function () {
    var get_prod_image = $(this).attr('data-get_prod_image');
    console.log(get_prod_image);
  
    var ret_date = $(this).attr('data-ret_date');
    var ret_transaction_code = $(this).attr('data-ret_transaction_code');
    var ret_product_code = $(this).attr('data-ret_product_code');
    var get_prod_name = $(this).attr('data-get_prod_name');
    var ret_request = $(this).attr('data-ret_request');
    var ret_qty = $(this).attr('data-ret_qty');
    var ret_reason = $(this).attr('data-ret_reason');
    var ret_customer_name = $(this).attr('data-ret_customer_name');
    var ret_contact_number = $(this).attr('data-ret_contact_number');
    var ret_address = $(this).attr('data-ret_address');
  
    var tr = $("<tr>");
    tr.append($("<td>").text(ret_date));
    tr.append($("<td>").text(ret_transaction_code));
    tr.append($("<td>").text(ret_product_code));
    tr.append($("<td>").text(get_prod_name));
    tr.append($("<td>").text(ret_request));
    tr.append($("<td>").text(ret_qty));
    tr.append($("<td>").text(ret_reason));
    tr.append($("<td>").text(ret_customer_name));
    tr.append($("<td>").text(ret_contact_number));
    tr.append($("<td>").text(ret_address));
  
    // Assuming you have an 'imagePath' variable that contains the path to the image.
    // Replace 'imagePath' with your actual variable containing the image path.
    var imageSrc = '../../upload_prodImg/' + get_prod_image;
    var img = $("<img>").attr('src', imageSrc);
    img.css({
        'width': '100px', // Set the desired width here (e.g., 100px)
        'height': '100px', // Set the desired height here (e.g., 100px)
        'border-radius': '15px' // Set the desired height here (e.g., 100px)
        
    });
  
    // Append the image to the table cell
    tr.append($("<td>").append(img));
  
    // Assuming you want to append the new row to an existing tbody
    var tbody = $('#tbody');
    tbody.empty(); // Ito ang karagdagang bahagi para burahin ang mga dati at i-reset ang tbody.
    tbody.append(tr);

    
});
