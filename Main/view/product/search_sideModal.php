<!-- Sort Modal -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header" style="background-color: rgb(128, 0, 0); color: White;">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filters</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" style="color: white;"></button>
  </div>
  <div class="offcanvas-body">
    <div class="row">
      <div class="col-12"><b>Sorting</b></div>
    </div>
    <div class="row">
      <div class="col-10">Sort by Date:</div>
      <div class="col-2">
        <input class="form-check-input" type="checkbox" name="sort" onclick="uncheckOtherSort(this)" id="sortByDate">
      </div>
    </div>
    <div class="row">
      <div class="col-10">Sort by Name:</div>
      <div class="col-2">
        <input class="form-check-input" type="checkbox" name="sort" onclick="uncheckOtherSort(this)" id="sortByName">
      </div>
    </div>
    <div class="row">
      <div class="col-10">Sort by Price:</div>
      <div class="col-2">
        <input class="form-check-input" type="checkbox" name="sort" onclick="uncheckOtherSort(this)" id="sortByPrice">
      </div>
    </div>
    
    <div class="row mt-2">
      <div class="col-12"><b>Arrange by Order</b></div>
    </div>
    <div class="row">
      <div class="col-10">Ascending Order</div>
      <div class="col-2">
        <input class="form-check-input" type="checkbox" name="order" onclick="uncheckOtherOrder(this)" id="ascendingOrder">
      </div>
    </div>
    <div class="row">
      <div class="col-10">Descending Order</div>
      <div class="col-2">
        <input class="form-check-input" type="checkbox" name="order" onclick="uncheckOtherOrder(this)" id="descendingOrder">
      </div>
    </div>
    
    <div id="categoriesSection" class="row mt-2">
      <div class="col-12"><b>Categories</b></div>
      
      <?php
      $sql = "SELECT * FROM `category` where category_status='1'";
      $result = $connections->query($sql);
      while ($row = $result->fetch_assoc()) {
        echo '<div class="row">
                <div class="col-10">'.$row['category_name'].'</div>
                <div class="col-2"><input class="form-check-input category-checkbox" value="'.$row['category_id'].'" type="checkbox"></div>
              </div>';
      }
      ?>
    </div>
    
    <div class="row mt-3">
      <div class="col-12">
        <button id="saveFilters" class="btn w-100" style="background-color: rgb(128, 0, 0); color: white;">Save</button>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12">
        <button id="saveDefault" class="btn w-100" style="background-color: rgb(128, 0, 0); color: white;">Default</button>
      </div>
    </div>
  </div>
</div>
