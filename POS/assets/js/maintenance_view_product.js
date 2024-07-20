document.getElementById('btn_stocks').addEventListener('click', function() {
    document.getElementById('view_stocks').style.display = 'flex';
    document.getElementById('view_products').style.display = 'none';
    document.getElementById('btn_stocks').style.display = 'none';
    document.getElementById('btn_products').style.display = 'flex';
    document.getElementById('btn_add').style.display = 'flex';
    });
    document.getElementById('btn_products').addEventListener('click', function() {
    document.getElementById('view_products').style.display = 'flex';
    document.getElementById('view_stocks').style.display = 'none';
    document.getElementById('btn_products').style.display = 'none'; 
    document.getElementById('btn_stocks').style.display = 'flex';
    document.getElementById('btn_add').style.display = 'none';
    
    });