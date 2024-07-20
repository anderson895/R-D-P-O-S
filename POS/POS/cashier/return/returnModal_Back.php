
    <?php
    include "connection.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve combined form data
        $combinedData = isset($_POST['combinedData']) ? json_decode($_POST['combinedData'], true) : [];

        $date_of_purchase= $combinedData['date_of_purchase'];
        $transaction_code= $combinedData['transaction_code'];
        $product_code= $combinedData['product_code'];
        $product_name= $combinedData['product_name'];
        $return_resolution= $combinedData['return_resolution'];
        $return_reason= $combinedData['return_reason'];

        $customer_name= $combinedData['customer_name'];
        $contact_number= $combinedData['contact_number'];
        $Address= $combinedData['Address'];

     
        mysqli_query($connections,"INSERT INTO `returns_pos` (`ret_id`, `ret_date`, `ret_datepurchase`, `ret_transaction_code`, `ret_product_code`, `ret_product_name`, `ret_resolution`, `ret_reason`, `ret_customer_name`, `ret_contact_number`, `ret_address`)
         VALUES (NULL, current_timestamp(), '$date_of_purchase', '$transaction_code', '$product_code', '$product_name', '$return_resolution', '$return_reason', '$customer_name', '$contact_number', '$Address');");

                echo '
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                <script>
                    swal({
                        title: "Success!",
                        text: "Save Return Information Successful",
                        icon: "success",
                        html: true
                    }).then((value) => {
                        if (value) {
                            window.location.href = "returnModal.php";
                            // Display the print receipt code here
                        
                        } else {
                            window.location.reload();
                        }
                    });
                </script>
                ';
    }
    ?>

