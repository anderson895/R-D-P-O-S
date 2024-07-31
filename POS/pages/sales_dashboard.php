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
    <div id="salesOnline">
        <div class="d-flex color_red align-items-center flex-row pt-3 justify-content-between">
            <h6 class="fw-bold">Daily Sales Forecast - Walkin</h6>
            <div>
                <button class="stat-btn" id="showLine"><i class="bi color_red fs-5 me-2 bi-activity"></i></button>
                <button class="reset-btn" id="showBar"><i class="bi color_red fs-5 me-2 bi-bar-chart-steps"></i></button>
            </div>
        </div>
        <div id="statA">
            <div id="onlineLine"></div>
        </div>
        <div id="statB" style="display: none;">
            <div id="onlineBar"></div>
        </div>
    </div>
    <div id="salesWalkin" style="display: none;">
        <div class="d-flex color_red align-items-center flex-row pt-3 justify-content-between">
            <h6 class="fw-bold">Daily Sales Forecast - Walkin</h6>
            <div>
                <button class="stat-btn" id="showLinepos"><i class="bi color_red fs-5 me-2 bi-activity"></i></button>
                <button class="reset-btn" id="showBarpos"><i class="bi color_red fs-5 me-2 bi-bar-chart-steps"></i></button>
            </div>
        </div>
        <div id="statApos">
            <div id="posLine"></div>
        </div>
        <div id="statBpos" style="display: none;">
            <div id="posBar"></div>
        </div>
    </div>
</div>

</div>