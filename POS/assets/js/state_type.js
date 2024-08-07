document.getElementById('select_report').addEventListener('change', function() {
    var value = this.value;
    document.getElementById('proceed_excel').style.display = 'none';
    document.getElementById('proceed_pdf').style.display = 'none';
    document.getElementById('proceed_analytics').style.display = 'none';
    
    if (value === 'excel') {
        document.getElementById('proceed_excel').style.display = 'inline-block';
    } else if (value === 'pdf') {
        document.getElementById('proceed_pdf').style.display = 'inline-block';
    } else if (value === 'analytics') {
        document.getElementById('proceed_analytics').style.display = 'inline-block';
    }
});