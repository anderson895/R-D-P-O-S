$(document).ready(function() {
    $.ajax({
        url: '../../POS/functions/get_online_sales_insights.php', // Update with the path to your PHP file
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Store the response in a variable
            var sales = response.sales;
            var dates = response.dates;
            
            var options = {
                chart: {
                    type: 'area',
                    height: 330
                },
                series: [{
                    name: 'Daily sales',
                    data: sales
                }],
                xaxis: {
                    categories: dates
                },
                colors: ['#39bf39'],  // Color for the line
                fill: {
                    colors: ['#dff6da'],  // Color for the fill area
                    type: 'solid'
                },
                stroke: {
                    show: true,
                    colors: ['#39bf39'],  // Line color
                    curve: 'smooth',
                    width: 2
                }
              }
              
              var chart = new ApexCharts(document.querySelector("#onlineLine"), options);
              
              chart.render();
              

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching data: ' + textStatus, errorThrown);
        }
    });
});