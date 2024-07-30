var options = {
  chart: {
      type: 'area',
      height: 350
  },
  series: [{
      name: 'Daily sales',
      data: [2000, 1500, 1300, 2650, 3500, 3350, 2000, 1500, 1300, 2650, 3500, 3350]
  }],
  xaxis: {
      categories: ['jul 25', 'jul 26', 'jul 27', 'jul 28', 'jul 29', 'jul 30', 'jul 25', 'jul 26', 'jul 27', 'jul 28', 'jul 29', 'jul 30']
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

var chart = new ApexCharts(document.querySelector("#onlineStats"), options);

chart.render();
