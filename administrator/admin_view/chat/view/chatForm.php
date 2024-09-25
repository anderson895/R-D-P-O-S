<?php 
$session_id = $_SESSION["acc_id"];
$account_id = $_GET["account_id"];
?>

<div class="page-wrapper">
    <div class="content" id="chatMessages">
        <div class="col-lg-12">
            <div class="row chat-window">
                <div class="col-lg-5 col-xl-4 chat-cont-left">
                    <div class="card mb-sm-3 mb-md-0 contacts_card flex-fill">
                        <div class="card-header chat-search">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="search_btn"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" id="searchData" placeholder="Search" class="form-control search-chat rounded-pill">
                            </div>
                        </div>

                        <div class="card-body contacts_body chat-users-list chat-scroll">
                            <!-- User List Example -->
                            <a href="javascript:void(0);" class="media d-flex chat-user" data-username="User1">
                                <div class="media-img-wrap flex-shrink-0">
                                    <div class="avatar avatar-away">
                                        <img src="assets/img/customer/customer1.jpg" alt="User Image" class="avatar-img rounded-circle">
                                    </div>
                                </div>
                                <div class="media-body flex-grow-1">
                                    <div>
                                        <div class="user-name">User1</div>
                                        <div class="user-last-chat">Last message from User1</div>
                                    </div>
                                    <div>
                                        <div class="last-chat-time">8:30 AM</div>
                                        <div class="badge badge-success badge-pill">New</div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript:void(0);" class="media d-flex chat-user" data-username="User2">
                                <div class="media-img-wrap flex-shrink-0">
                                    <div class="avatar avatar-away">
                                        <img src="assets/img/customer/customer2.jpg" alt="User Image" class="avatar-img rounded-circle">
                                    </div>
                                </div>
                                <div class="media-body flex-grow-1">
                                    <div>
                                        <div class="user-name">User2</div>
                                        <div class="user-last-chat">Last message from User2</div>
                                    </div>
                                    <div>
                                        <div class="last-chat-time">8:35 AM</div>
                                    </div>
                                </div>
                            </a>
                            <!-- Add more users as needed -->
                        </div>
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <div style="display:none;" class="col-lg-7 col-xl-8 chat-cont-right" id="viewChat">
                    <input hidden type="text" value="<?= $account_id; ?>" id="account_id">
                    <input hidden type="text" value="<?= $session_id; ?>" id="session_id">
                    <div class="card mb-0" id="chatbox">
                        <div class="card-header msg_head">
                            <div class="d-flex bd-highlight">
                                <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <div class="img_cont">
                                    <img id="reciever_image" class="rounded-circle user_img" src="../../upload_system/empty.png" alt="">
                                </div>
                                <div class="user_info">
                                    <span><strong id="receiver_name"><?=$fullname?></strong></span>
                                    <p class="mb-0">Messages</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body msg_card_body chat-scroll">
                            <ul class="list-unstyled" id="messageList">
                                <!-- Chat messages -->
                            </ul>
                        </div>

                        <?php include "chat/view/chatFooter.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#searchData').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('.chat-user').filter(function() {

            console.log('test');
            $(this).toggle($(this).data('username').toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>
