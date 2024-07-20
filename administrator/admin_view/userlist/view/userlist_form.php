<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Employee List</h4>
        <h6>View/Search Employee</h6>
      </div>
      <div class="page-btn">
        <a href="adduser.php" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-2">Add User</a>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-top">
          <div class="search-set">
            <div class="search-input">
              <a class="btn btn-searchset">
                <img src="assets/img/icons/search-white.svg" alt="img">
              </a>
            </div>
          </div>
          <div class="wordset">
            <ul>
              <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
              </li>
              <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
              </li>
              <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table  datanew">
            <thead>
              <tr>
                <th>Profile</th>
                <th>First name </th>
                <th>Last name </th>
                <th>User name </th>
                <th>Account type</th>
                <th>email</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <input hidden type="text" id="session_id" value="<?= $db_acc_id ?>">


              <?php
              $full_name = "";
              $i = 1;
              $view_query = mysqli_query($connections, "SELECT * from account where acc_type!='administrator' AND acc_type!='customer' AND acc_display_status='0' ");
              // where account_type='0'
              while ($row = mysqli_fetch_assoc($view_query)) { //<-- ginagamit tuwing kukuha ng database
                $acc_id = $row["acc_id"];
                $acc_code = $row["acc_code"];
                $acc_fname = $row["acc_fname"];
                $acc_lname = $row["acc_lname"];
                $acc_username = $row["acc_username"];
                $acc_type = $row["acc_type"];
                $acc_status = $row["acc_status"];
                $acc_email = $row["acc_email"];
                $emp_image = $row["emp_image"];
                $email_parts = explode('@', $acc_email); // Ihiwalay ang email address sa pamamagitan ng '@'
                $username = $email_parts[0]; // Kunin ang username
                $domain = $email_parts[1]; // Kunin ang domain
                $username_length = strlen($username); // Kunin ang haba ng username
                $hidden_username = substr_replace($username, '******', 1, $username_length - 2); // Palitan ang mga random na titik sa asterisk
                $masked_email = $hidden_username . '@' . $domain; // Isama ang domain upang mabuo ang natatakpan na email

              ?>

                <tr>
                  <td class="productimgname">
                    <a href="javascript:void(0);" class="product-img">
                      <img class="avatar-img rounded-circle" src="<?php if ($emp_image) {
                                                                    echo "../../upload_img/$emp_image";
                                                                  } else {
                                                                    echo "../../upload_system/empty.png";
                                                                  } ?>" alt="product">
                    </a>
                  </td>
                  <td><?= ucfirst($acc_fname) ?></td>
                  <td><?= $acc_lname ?> </td>
                  <td><?= $acc_username ?> </td>
                  <td><?= ucfirst($acc_type) ?> </td>
                  <td><?= $masked_email ?></td>
                  <td>

                    <div class="status-toggle d-flex justify-content-between align-items-center">
                      <input type="checkbox" id="user<?= $i ?>" name="accountID" class="check" <?php if ($acc_status == 0) {
                                                                                                  echo "checked";
                                                                                                } ?> value='<?= $acc_id ?>'>
                      <label for="user<?= $i ?>" class="checktoggle" data-toggle="modal">checkbox</label>
                    </div>
                  </td>


                  <td>
                    <a class="me-3" href="edituser.php?acc_code=<?= $acc_code ?>">
                      <img src="assets/img/icons/edit.svg" alt="img">
                    </a>
                    <a class="me-3 RemoveToDisplayUser" data-acc-id="<?= $acc_id ?>">
                      <img src="assets/img/icons/delete.svg" alt="img">
                    </a>
                  </td>
                </tr>
              <?php
                $i++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script src="userlist/controller/ajaxUserlist.js"></script>