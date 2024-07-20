<style>
 .li-static-home-image {
    background-image: url(../upload_system/<?php echo $db_system_banner; ?>);
    background-size: cover;
    height: 400px;
    background-repeat: no-repeat;
}
</style>




<div id="VoucherBannerSection" class="li-static-home">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Begin Li's Static Home Image Area -->
                            <div class="li-static-home-image"></div>
                            <!-- Li's Static Home Image Area End Here -->
                            <!-- Begin Li's Static Home Content Area -->
                            <?php 
                                date_default_timezone_set('Asia/Manila');
                                $currentDateTime = date('Y-m-d H:i:s');
                            $view_query = mysqli_query($connections, "SELECT * FROM voucher WHERE voucher_expiration >= '$currentDateTime' AND voucher_maximumLimit >= 1 ");

                            while ($row = mysqli_fetch_assoc($view_query)) {
                                $voucher_id = $row["voucher_id"];
                                $db_voucher_name = $row["voucher_name"];
                                $db_voucher_discount = $row["voucher_discount"];
                                $db_voucher_discount_percent = $db_voucher_discount / 100;
                        
                                $db_voucher_created = $row["voucher_created"];
                                $db_voucher_expiration = $row["voucher_expiration"];
                                $db_voucher_maximumLimit = $row["voucher_maximumLimit"];
                                $db_voucher_status = $row["voucher_status"];
                        
                                
                                
                                if($db_voucher_name){
                            ?>
                            <!-- <div class="li-static-home-content">
                                <p>We Offer <span><?= $db_voucher_name; ?></span> </p>
                             
                                <p class="schedule">
                                    Until
                                    <span> <?=  substr($db_voucher_expiration, 0, 10); ?></span><br>
                                    limited for <span> <?=  $db_voucher_maximumLimit; ?></span>
                                    Person
                                </p>
                                <div class="default-btn">
                                    <a href="#topProductArea" class="links text-decoration-none">Shopping Now</a>
                                </div>
                            </div> -->
                            <?php 
                                }
                            }
                            ?>
                            <!-- Li's Static Home Content Area End Here -->
                        </div>
                    </div>
                </div>
            </div>