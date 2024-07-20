$(document).ready(function () {

    const buttons = $('.input-group button');
    buttons.on('click', handleQuantityChange);

    $('#select_discount').on('change', calculateTotal);

    function handleQuantityChange(event) {
        const button = $(event.target);
        const input = button.parent().find('input');
        const cartItemId = button.parent().data('cart-id');
        const price = parseFloat(button.parent().data('price'));
        const stockLimit = parseInt(input.data('stocklimit'));
        const posCartProdId = button.parent().data('pos-cart-prod-id'); // Make sure this attribute is set
        let value = parseInt(input.val());

        if (button.text() === '+') {
            if (value < stockLimit) {
                value++;
            }
        } else if (button.text() === '-') {
            value = Math.max(1, value - 1);
        }

        input.val(value);

        const subtotal = price * value;

        updateCartItemQuantity(cartItemId, posCartProdId, value, subtotal, stockLimit);
    }

    function updateCartItemQuantity(cartItemId, posCartProdId, quantity, subtotal, stockLimit) {
       // console.log(stockLimit);

        const updateCartQuantityUrl = '../functions/update_quantity.php';

        if (quantity <= stockLimit) {
            const data = {
                cartItemId: cartItemId,
                posCartProdId: posCartProdId,
                quantity: quantity,
                subtotal: subtotal
            };

            console.log(quantity)

            /*$.ajax({
                type: 'POST',
                url: updateCartQuantityUrl,
                data: data,
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.error('There was a problem with the fetch operation:', error);
                }
            });
            */

        } else {
            console.log('Quantity exceeds stock limit');
            // You can add additional logic or user feedback here if needed
        }
    }

    function calculateTotal() {
        const discountValue = parseFloat($('#select_discount').val());
        const subtotal = parseFloat($('.subtotal').text());

        // Calculate total based on the selected discount
        const total = subtotal - (subtotal * (discountValue / 100));

        // Update the total display
        $('.total').text(total.toFixed(2));
    }
});
