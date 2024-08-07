$(document).ready(function() {
  $('#select_type').change(function() {
      var selectedType = $(this).val();
      $('#daily_reports, #monthly_reports, #yearly_reports').hide();
      if (selectedType === 'daily') {
          $('#daily_reports').show();
      } else if (selectedType === 'monthly') {
          $('#monthly_reports').show();
      } else if (selectedType === 'yearly') {
          $('#yearly_reports').show();
      }
  });

  $('#startDate, #endDate').on('change', function() {
      const startDate = new Date($('#startDate').val());
      const endDate = new Date($('#endDate').val());

      // Validate end date
      if (endDate < startDate && $('#endDate').val() !== "") {
          alert('End date cannot be earlier than start date.');
          $('#endDate').val(''); // Clear the end date
      }

      // Set min date for endDate based on startDate
      if ($('#startDate').val() !== "") {
          $('#endDate').attr('min', $('#startDate').val());
      }
  });

  $('#proceed_excel').on('click', function() {
      const reportType = $('#select_type').val();

      if (reportType == "daily") {
          const startDate = $('#startDate').val();
          const endDate = $('#endDate').val();

          // Ensure both dates are set
          if (!startDate || !endDate) {
              alert('Please select both start date and end date.');
              return;
          }

          // Create a form dynamically
          const form = $('<form>', {
              method: 'POST',
              action: '../../POS/functions/export_daily_online_excell.php',
              target: '_blank' // Open the file in a new tab
          });

          // Append hidden inputs for the form data
          $('<input>', {
              type: 'hidden',
              name: 'startDate',
              value: startDate
          }).appendTo(form);

          $('<input>', {
              type: 'hidden',
              name: 'endDate',
              value: endDate
          }).appendTo(form);

          // Append form to the body and submit it
          form.appendTo('body').submit().remove();
      } else if (reportType === "monthly") {
        const startMonth = $('#startMonthYear').val();
        const endMonth = $('#endMonthYear').val();
    
        // Ensure both dates are set
        if (!startMonth || !endMonth) {
            alert('Please select both start date and end date.');
            return;
        }
    
        // Create a form dynamically
        const form = $('<form>', {
            method: 'POST',
            action: '../../POS/functions/export_monthly_online_excell.php',
            target: '_blank' // Open the file in a new tab
        });
    
        // Append hidden inputs for the form data
        $('<input>', {
            type: 'hidden',
            name: 'startMonth',
            value: startMonth
        }).appendTo(form);
    
        $('<input>', {
            type: 'hidden',
            name: 'endMonth',
            value: endMonth
        }).appendTo(form);
    
        // Append form to the body and submit it
        form.appendTo('body').submit().remove();
    }else if (reportType == "yearly") {
        const startYear = $('#startYear').val();
        const endYear = $('#endYear').val();
    
        // Ensure both years are set
        if (!startYear || !endYear) {
            alert('Please select both start year and end year.');
            return;
        }
    
        // Create a form dynamically
        const form = $('<form>', {
            method: 'POST',
            action: '../../POS/functions/export_yearly_online_excell.php', // Updated to reflect the yearly report
            target: '_blank' // Open the file in a new tab
        });
    
        // Append hidden inputs for the form data
        $('<input>', {
            type: 'hidden',
            name: 'startYear',
            value: startYear
        }).appendTo(form);
    
        $('<input>', {
            type: 'hidden',
            name: 'endYear',
            value: endYear
        }).appendTo(form);
    
        // Append form to the body and submit it
        form.appendTo('body').submit().remove();
    }else {
          console.log("Error");
      }
  });
});
