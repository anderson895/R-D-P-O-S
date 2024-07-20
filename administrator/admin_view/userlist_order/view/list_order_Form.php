<style>
    .tabs {
    display: flex;
    background-color: #f1f1f1;
    border: 1px solid #ddd;

    overflow-x: auto; /* Enable horizontal scrolling */
    white-space: nowrap; /* Prevent wrapping */
    -webkit-overflow-scrolling: touch; /* Enable smooth scrolling on iOS devices */

}
.tab {
    flex: 1;
    text-align: center;


    display: inline-block;
    padding: 10px 15px;
    cursor: pointer;
}
.tab:hover {
    color: maroon;
}
.tab.active {
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom: none;
    color: maroon;
}
.tab-content {
    display: none;
    padding: 20px;
}
.tab-content.active {
    display: block;
}

</style>
<br><br><br>
            <div class="container">
                
                
<div class="tabs">
    <div class="tab" onclick="showTab('all')">All</div>

    <?php 
    if($acc_type=="administrator"){
        echo '<div class="tab" onclick="showTab(\'topay\')">Pending</div>';
    }
    ?>
 
    <div class="tab" onclick="showTab('toship')">To Ship</div>
    <div class="tab" onclick="showTab('toreceived')">To Receive</div>
    <div class="tab" onclick="showTab('completed')">Completed</div>
    <div class="tab" onclick="showTab('canceled')">Canceled</div>
</div>


<div class="container-fluid mt-3">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search"><br>
</div>
    
<div id="all-content" class="tab-content active">
<h1 class='text-center' style='color:gray;'>Empty.</h1>
</div>

<!----tab---->
<!-- Other tab contents go here -->
<div id="topay-content" class="tab-content">
<h1 class='text-center' style='color:gray;'>Empty.</h1>
</div>


<div id="toship-content" class="tab-content">
<h1 class='text-center' style='color:gray;'>Empty.</h1>
</div>


<div id="toreceived-content" class="tab-content">
<h1 class='text-center' style='color:gray;'>Empty.</h1>
</div>


<div id="completed-content" class="tab-content">
<h1 class='text-center' style='color:gray;'>Empty.</h1>
</div>


<div id="canceled-content" class="tab-content">
<h1 class='text-center' style='color:gray;'>Empty.</h1>
</div>



<!-- Other tab contents go here -->
</div>