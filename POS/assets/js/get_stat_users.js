$(document).ready(function() {
    function easeOutQuad(t) {
        return t * (2 - t);
    }

    function animateNumber(element, from, to, duration) {
        let start = from;
        let end = to;
        let startTime = performance.now();

        function update(time) {
            let elapsed = time - startTime;
            let progress = Math.min(elapsed / duration, 1);
            let easedProgress = easeOutQuad(progress);
            let current = start + (end - start) * easedProgress;

            if (progress < 1) {
                $(element).text(Math.floor(current));
                requestAnimationFrame(update);
            } else {
                $(element).text(end);
            }
        }

        requestAnimationFrame(update);
    }

    function showRandomNumbers() {
        // Generate random numbers for initial display
        let randomCustomer = Math.floor(Math.random() * 1000);
        let randomCashier = Math.floor(Math.random() * 1000);
        let randomDeliveryStaff = Math.floor(Math.random() * 1000);
        let randomSupplier = Math.floor(Math.random() * 1000);

        // Display random numbers initially
        $('#customer').text(randomCustomer);
        $('#cashier').text(randomCashier);
        $('#rider').text(randomDeliveryStaff);
        $('#supplier').text(randomSupplier);

        return { randomCustomer, randomCashier, randomDeliveryStaff, randomSupplier };
    }

    function fetchAndAnimateNumbers() {
        let { randomCustomer, randomCashier, randomDeliveryStaff, randomSupplier } = showRandomNumbers();

        setTimeout(function() {
            // Fetch real values via AJAX after 1 second
            $.ajax({
                url: '../../POS/functions/get_stat_users.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    animateNumber('#customer', randomCustomer, response.customer, 2000);
                    animateNumber('#cashier', randomCashier, response.cashier, 2000);
                    animateNumber('#rider', randomDeliveryStaff, response.deliveryStaff, 2000);
                    animateNumber('#supplier', randomSupplier, response.supplier, 2000);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }, 1000); // Delay the AJAX request by 1 second
    }

    // Fetch and animate numbers initially
    fetchAndAnimateNumbers();
});
