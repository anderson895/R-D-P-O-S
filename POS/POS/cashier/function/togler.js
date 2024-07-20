
	$('.togler').click(function(){
		id = $(this).attr('data-id')
		$('#id').val(id).hide()

		unit_name = $(this).attr('data-unit_name')
		$('#unit_name').val(unit_name)
-
		$('#unit_nameDisplay').text(unit_name)
	})

	$('.remove').click(function(){
		id_remove = $(this).attr('data-id_remove')
		$('#id_remove').val(id_remove)

		unit_name_rem = $(this).attr('data-unit_name_rem')
		$('#unit_name_rem').val(unit_name_rem)
		$('#unit_name_remDisplay').text(unit_name_rem)

		db_prod_name = $(this).attr('data-db_prod_name')
		$('#db_prod_name').text(db_prod_name)
	})

	$('.total').each(function(){
		var total =parseFloat($(this).text()).toFixed(2)
		// console.log(total)
	})


$('.toglerCancel').click(function(){
    //data-pos_cart_user_id///data-prod_id
    pos_cart_id = $(this).attr('data-pos_cart_id')
    $('#pos_cart_id').val(pos_cart_id)

    })


$('.toglerCheckout').click(function(){
    //data-pos_cart_user_id///data-prod_id
    pos_cart_user_id = $(this).attr('data-pos_cart_user_id')
    $('#pos_cart_user_id').val(pos_cart_user_id)

    prod_id = $(this).attr('data-prod_id')
    $('#prod_id').val(prod_id)

    id = $(this).attr('data-id')
    $('#id').val(id).hide()
    $('#finalTotalDisplay').text($('#tot').text())

    var finalTotalDisplayValue = $('#finalTotalDisplay').text();
    $('#finalTotalInput').val(finalTotalDisplayValue);

    
})

$('.hatdog').click(function(){
    $('.category').hide()
    var categ = $(this).attr('data-id')
    $('.'+categ).show()
})
$('.show').click(function(){
    $('.category').show()
})


