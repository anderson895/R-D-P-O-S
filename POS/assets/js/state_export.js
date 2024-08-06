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
  });