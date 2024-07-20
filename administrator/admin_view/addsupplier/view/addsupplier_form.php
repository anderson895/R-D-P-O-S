<style>
    .alert-danger {
        display: none;
       
    }
</style>


<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Supplier Management</h4>
<h6>Add/Update Customer</h6>
</div>
</div>

<div class="container text-center">

<div class="card">
    <div class="card-body">
        <div class="row">
            
    <input hidden type="text" name="acc_id" value="<?= $db_acc_id?>" id="acc_id">
        <div class="row justify-content-center align-items-center">
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
            <label>Supplier Name</label>
            <input type="text" class="form-control" name="supplierName" id="supplierName">
            <div style="display:none;" class="alert alert-danger" id="errorSupplierName"></div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control"  name="email" id="email">
            <div style="display:none;" class="alert alert-danger" id="errorEmail"></div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
            <label>Phone</label>
            <input type="tel" class="form-control" name="phone" id="phone">
            <div style="display:none;" class="alert alert-danger" id="errorPhone"></div>
        </div>
    </div>
    <div class="col-lg-9 col-12">
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="Address" id="address">
            <div style="display:none;" class="alert alert-danger" id="errorAddress"></div>
        </div>
    </div>
 

    <div class="col-lg-9">
        <div class="form-group">
        <button disabled type="button" id="btnAddSupplier" class="btn btn-submit me-2">Submit</button>
        <a href="supplierlist.php" class="btn btn-cancel">Cancel</a>
        </div>
    </div>

</div>

        </div>
    </div>
</div>

</div>

</div>
</div>
</div>



<script>
    $("#btnAddSupplier").on("click", function() {
    var supplierName =$("#supplierName").val()
    var email =$("#email").val()
    var phone =$("#phone").val()
    var address =$("#address").val()
    var acc_id =$("#acc_id").val()
  
    //$('#ssid').val(ssid);
    console.log(acc_id);

    Swal.fire({
        title: "Are you sure?",
        text: "Add this supplier",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, add it!",
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger ml-1",
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            // Dito mo isasagawa ang AJAX request para sa pag-update ng product
            $.ajax({
                url: 'addsupplier/controller/add_supplierProcess.php', // Palitan mo ito ng tamang URL
                type: 'POST',
                data: {
                    acc_id:acc_id,
                    supplierName:supplierName,
                    email:email,
                    phone:phone,
                    address:address,

                },
                success: function(response) {
                    // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update

                    Swal.fire({
                        type: "success",
                        title: "Successfully added!",
                        text: "supplier has been added.",
                        confirmButtonClass: "btn btn-success"
                    }).then(function() {
                        window.location.href = "supplierlist.php";

                    // console.log(response)
                   // alertify.success("Success added new supplier")
                    
                    });
                },
                error: function(xhr, status, error) {
                    // Dito mo ilalagay ang mga actions para sa error handling
                    Swal.fire({
                        type: "error",
                        title: "Error",
                        text: "An error occurred while deleting the product.",
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });
        }
    });
    
});
</script>

<script src='addsupplier/controller/add_supplier_validation.js'></script>