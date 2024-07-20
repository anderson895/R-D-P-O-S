
<div id="pinContainer" style="display: none;">
   <center> <h4> Pin location</h4>
    <button type="button" style="background-color:#600000; border-radius:25px;" id="locateButton"></button>
    <p hidden id="locationInfo"></p>
    </center>
    <form id="coordinatesForm">
        <p>
          
        
        </p>
        <p>
          
            <input  hidden type="text" id="latitude" name="latitude" placeholder="Enter latitude" value="<?= $users_latitude=$userdata["users_latitude"];?>">
        </p>
        <p>

            <input hidden type="text" id="longitude" name="longitude" placeholder="Enter longitude" value="<?=$users_longitud= $userdata["users_longitud"];?>">
        </p>
       
    </form>
    
    <?php 
    if(!empty($users_latitude)){
    ?>
    <iframe style="display:block;" width="100%" height="500" id="mapFrame" src="https://maps.google.com/maps?q=<?=$users_latitude?>,<?=$users_longitud?>&output=embed"></iframe>
    <?php }else{ ?>
    
        <iframe style="display:block;" width="100%" height="500" id="mapFrame" src="https://maps.google.com/maps?q=philippines=&output=embed"></iframe>
        
     <?php } ?>   
  
</div>
    

   

