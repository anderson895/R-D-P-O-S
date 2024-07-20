document.getElementById('online').addEventListener('click', function() {
        document.getElementById('view_online').style.display = 'block';
   

        document.getElementById('return_ordertext').style.display = 'none';
    document.getElementById('postext').style.display = 'none';
    document.getElementById('return_postext').style.display = 'none';
    document.getElementById('onlinetext').style.display = 'block';
    document.getElementById('view_transaction').style.display = 'none';
    document.getElementById('view_return_pos').style.display = 'none';
    document.getElementById('view_return_order').style.display = 'none';
    
    });

document.getElementById('pos').addEventListener('click', function() {
        document.getElementById('view_transaction').style.display = 'block';
        document.getElementById('postext').style.display = 'block';
        document.getElementById('onlinetext').style.display = 'none';

        document.getElementById('return_ordertext').style.display = 'none';
        document.getElementById('return_postext').style.display = 'none';
        document.getElementById('view_online').style.display = 'none';
        document.getElementById('view_return_pos').style.display = 'none';
        document.getElementById('view_return_order').style.display = 'none';
        
        });


document.getElementById('return_pos').addEventListener('click', function() {
        document.getElementById('view_return_pos').style.display = 'block';
        document.getElementById('postext').style.display = 'none';
        document.getElementById('onlinetext').style.display = 'none';
        document.getElementById('return_postext').style.display = 'block';


        document.getElementById('return_ordertext').style.display = 'none';

        document.getElementById('view_transaction').style.display = 'none';
        document.getElementById('view_online').style.display = 'none';
        document.getElementById('view_return_order').style.display = 'none';
    
         
});


document.getElementById('return_order').addEventListener('click', function() {

    
        document.getElementById('view_return_order').style.display = 'block';
     
        document.getElementById('postext').style.display = 'none';
        document.getElementById('onlinetext').style.display = 'none';

        document.getElementById('return_postext').style.display = 'none';
        document.getElementById('return_ordertext').style.display = 'block';
        document.getElementById('view_transaction').style.display = 'none';
        document.getElementById('view_online').style.display = 'none';
        document.getElementById('view_return_pos').style.display = 'none';
    
         
});

