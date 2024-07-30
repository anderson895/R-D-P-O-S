<div class="border color_red shadow p-3" style="background-color: white; border-radius: 20px;">
    <h5 class="mb-2 fw-bolder mt-3">Today Sales</h5>    
    <div class="row g-3">
        <div class="col-12 col-md-6">
            <div id="btnOnline" class="accent-e border p-3" style="cursor: pointer">
                <h1 id="todayOnlineSales" class="fw-bold" style="font-size: 3rem">100.00</h1>
                <p>Online</p>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div id="btnWalkin" class="accent-f border p-3" style="cursor: pointer">
                <h1 id="todayPosSales" class="fw-bold" style="font-size: 3rem">100.00</h1>
                <p>Walk-in</p>
            </div>
        </div>
    </div>

    <div>
        <div class="d-flex flex-row pt-3 justify-content-between">
            <h6 class="fw-bold">Sales Forecast</h6>
            <div>
                <button class="btn btn-sm">Line</button>
                <button class="btn btn-sm">Bar</button>
                <button class="btn btn-sm">Area</button>
            </div>
        </div>
        <div id="onlineStats"></div>
        <div id="walkinStats" class="d-none"></div>
    </div>

</div>