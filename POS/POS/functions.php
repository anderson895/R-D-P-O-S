<style>
/* Custom styles for the OK button */
.swal-button--confirm {
    background-color: rgb(145, 0, 0);
    color: #fff; /* Baguhin ang kulay ng text */
    border: none; /* Alisin ang border */
    border-radius: 5px; /* Baguhin ang radius ng border */
    padding: 10px 20px; /* Baguhin ang padding */
    font-size: 16px; /* Baguhin ang font size */
    text-align: center; /* Ilagay ang text sa gitna */
    width: 100%; /* Gawing 100% ang lapad */
    transition: background-color 0.3s; /* Dagdagan ng transition effect sa background color */
}

/* Hover effect */
.swal-button--confirm:hover {
    background-color: #0056b3; /* Baguhin ang kulay ng background kapag hover */
}


</style>
<?php
    include 'connection.php';


    if(isset($_POST["submit"])) {


      
        $UserEmail = $_POST["UserEmail"];
        $password = $_POST["password"];

        // Use prepared statements to prevent SQL injection
        $query = "SELECT acc_id, acc_type FROM account WHERE (acc_email = ? OR acc_username = ?) AND acc_password = ?";
        $stmt = $conn->prepare($query);

        
        $stmt->bind_param("sss", $UserEmail, $UserEmail, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows === 1) {

            
            $row = $result->fetch_assoc();
            $acc_id = $row['acc_id'];
            $acc_type = $row['acc_type'];

            if($acc_type == 'cashier'){
                // Use the correct header redirection function
                $_SESSION['acc_id'] = $acc_id;
                echo '                
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "Success!",
                        text: "Welcome Cashier",
                        icon: "success",
                        html: true
                    }).then((value) => {
                        if (value) {
                            window.location.href = "cashier/index.php";
                        } else {
                            window.location.reload();
                        }
                    });
                });
                </script>
                ';
             //   exit();
            }else if($acc_type == 'administrator'){
                // Use the correct header redirection function
                $_SESSION['acc_id'] = $acc_id;
                echo '                
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "Success!",
                        text: "Welcome Admin",
                        icon: "success",
                        html: true
                    }).then((value) => {
                        if (value) {
                            window.location.href = "../administrator/admin_view/index.php";
                        } else {
                            window.location.reload();
                        }
                    });
                });
                </script>
                ';
             //   exit();
            }
            
            else{
                echo '
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "Error!",
                        text: "This acccount not Authorized to Login ",
                        icon: "error",
                        html: true
                    }).then((value) => {
                        if (value) {
                            window.location.href = "index.php";
                        } else {
                            window.location.reload();
                        }
                    });
                });
                </script>
                ';
            }
        } else {
            $failed = true;
            
           // header("Location: index.php?failed=true");


            echo '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
              swal({
                title: "Error!",
                text: "Incorrect password!",
                icon: "error",
                content: true // Use the "content" option instead of "html"
              }).then((value) => {
                if (value) {
                  window.location.href = "index.php?failed=true";
                  // Display the print receipt code here
                } else {
                  window.location.reload();
                }
              });
            });
            </script>';
          //  exit();
        }
    }
?>
