


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
                            <th>Rate Type</th>
                            <th class="text-center">Rating</th>
                            <th>FeedBack</th>
                            <th>Action</th>
                        </tr>
                    </thead>
<?php
            $count = 1;
            $getRates = $db->getRates();
            while ($rate = $getRates->fetch_assoc()) {
                $getUser = $db->getUsertUsingId($rate['r_user_id']);
                $rater = 'Anonymous';
                if ($getUser->num_rows > 0) {
                    $user = $getUser->fetch_assoc();
                    $rater = $user['acc_username'];
                }

                $smesId = $rate['r_prod_id'];
               
                $getSmes = $db->checkSmesId($smesId);
                

                $rateName = '';

                if ($getSmes->num_rows > 0) {
                    $smes = $getSmes->fetch_assoc();
                  
                        $rateName = $smes['prod_name'];
                    
                }
            ?>



                    <tbody class="table-body">
                        <tr>
                            <td><?= $count ?></td>
                            <td><?= $rater ?></td>
                            <td><?= $rateName ?></td>
                            <td>
                                <input class="rateValue" hidden type="text" value="<?= $rate['r_rate'] ?>" >
                                <div class="d-flex justify-content-center" style="width:100%;">
                                    <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['r_rate']>0){ echo 'active';} ?>" data-id="1"><i class="bi <?php if($rate['r_rate']>0){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                                    <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['r_rate']>=2){ echo 'active';} ?>" data-id="2"><i class="bi <?php if($rate['r_rate']>=2){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                                    <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['r_rate']>=3){ echo 'active';} ?>" data-id="3"><i class="bi <?php if($rate['r_rate']>=3){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                                    <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['r_rate']>=4){ echo 'active';} ?>" data-id="4"><i class="bi <?php if($rate['r_rate']>=4){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                                    <button type="button" style="border:0;" class="btn text-warning btnTsFrmStar <?php if($rate['r_rate']>=5){ echo 'active';} ?>" data-id="5"><i class="bi <?php if($rate['r_rate']>=5){ echo 'bi-star-fill';} else { echo 'bi-star'; } ?>"></i></button>
                                </div>
                            </td>
                            <td><?= $rate['r_feedback'] ?></td>
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
