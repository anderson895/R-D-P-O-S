<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Customers Feedback</h4>
            </div>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped" id="myTable">
                    <thead class="table-header">
                        <tr>
                            <th>No.</th>
                            <th>Rated By</th>
                            <th>Product</th>
                            <th class="text-center">Rating</th>
                            <th>FeedBack</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <?php
                        $count = 1;
                        $getRates = $db->getRates();
                        while ($rate = $getRates->fetch_assoc()) {
                            $getUser = $db->getUsertUsingId($rate['r_user_id']);
                            $rater = 'Anonymous';
                            if ($getUser->num_rows > 0) {
                                $user = $getUser->fetch_assoc();
                                $rater_username = $user['acc_username'];
                                $rater_id = $user['acc_id'];
                            }
                            $dateAdded = new DateTime($rate['r_date_added']);
                            $smesId = $rate['r_prod_id'];
                            $getSmes = $db->checkSmesId($smesId);
                            $rateName = '';

                            if ($getSmes->num_rows > 0) {
                                $smes = $getSmes->fetch_assoc();
                                $rateName = $smes['prod_name'];
                                $prod_code = $smes['prod_code'];
                            }

                            $r_feedback = $rate['r_feedback'];
                        ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td><a href="profile_customer.php?target_id=<?=$rater_id?>"><?= $rater_username ?></a></td>
                            <td><a href="product-details.php?target_id=<?=$prod_code?>"><?= $rateName ?></a></td>
                            <td>
                                <input class="rateValue" hidden type="text" value="<?= $rate['r_rate'] ?>">
                                <div class="d-flex justify-content-center" style="width:100%;">
                                    <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['r_rate']>0){ echo 'active';} ?>" data-id="1"><i class="bi <?php if($rate['r_rate']>0){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                                    <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['r_rate']>=2){ echo 'active';} ?>" data-id="2"><i class="bi <?php if($rate['r_rate']>=2){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                                    <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['r_rate']>=3){ echo 'active';} ?>" data-id="3"><i class="bi <?php if($rate['r_rate']>=3){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                                    <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['r_rate']>=4){ echo 'active';} ?>" data-id="4"><i class="bi <?php if($rate['r_rate']>=4){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                                    <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['r_rate']>=5){ echo 'active';} ?>" data-id="5"><i class="bi <?php if($rate['r_rate']>=5){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                                </div>
                            </td>
                            <td>
                                <a class='viewFeedBack' data-r_feedback='<?= $r_feedback ?>'><?= strlen($r_feedback) > 100 ? substr($r_feedback, 0, 100) . '...' : $r_feedback; ?></a>
                            </td>
                            <td><?= $dateAdded->format('F j, Y g:i A') ?></td>
                            <td>
                                <button type="button" 
                                class="btn btn-danger toglerDeleteComRev" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalDelete"
                                data-id=<?= $rate['r_rate_id'] ?>
                                ><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <?php
                            $count++;
                        }
                        echo ($getRates->num_rows <= 0) ? '<tr><td colspan="6" class="text-center">No Rate Found.</td></tr>' : '';
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this review?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnConfirmDelete" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
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

        // Click event for delete button
        $('.toglerDeleteComRev').click(function() {
            var id = $(this).attr('data-id');
            console.log(id); // Log the ID to the console for debugging

            // Set up the click event for the confirmation button
            $('#btnConfirmDelete').off('click').on('click', function() {
                $.ajax({
                    url: "managefeedback/controller/post.php",
                    type: "POST",
                    data: {
                        id: id,
                        SubmitType: 'deleteReviews'
                    },
                    success: function(data) {
                        console.log(data); // Log the response data to console for demonstration

                        if (data == "success") {
                            location.reload(); // Reload the page on success
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
</script>