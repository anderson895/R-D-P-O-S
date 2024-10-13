$(document).ready(function() {
    $(".viewFeedBack").on("click", function() {
        var unit_description = $(this).data("r_feedback"); // Corrected to 'completeaddress'
        Swal.fire({
            title: 'Customers Feedback',
            text: unit_description
           
        });
    });
});



$(document).ready(function(){
    // Click event
    $('.toglerDeleteComRev').click(function(){
        var id = $(this).attr('data-id');

        console.log(id);

        // Display a confirmation dialog
       
        $('#btnConfirmDelete').click(function(){
            $.ajax({
                url: "managefeedback/controller/post.php",
                type: "POST",
                data: {
                    id: id,
                    SubmitType: 'deleteReviews'
                },
                success: function(data) {
                    console.log(data); // Log the data to console for demonstration

                    if(data=="success"){
                        location.reload()
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error("Error occurred:", error);
                }
            });
        });
        
    });
});



$(document).ready(function() {
    $('#myTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "order": [[5, 'desc']],
        "language": {
            "emptyTable": "No Rate Found."
        }
    });
});