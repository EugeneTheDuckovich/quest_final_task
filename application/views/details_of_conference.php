<html>
 <head>
  <title>details of conference</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
  crossorigin="anonymous">
    <script type="text/javascript" defer>      
          // Calculate maximum latitude value on mercator projection
          var maxLat = Math.atan(Math.sinh(Math.PI)) * 180 / Math.PI;

          function initializeMap() {
                var center = new google.maps.LatLng(0, 0);

                var mapOptions = {
                    zoom: 4,
                    center: center,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
            
              
                // Get lat and lng values from input fields
                var lat = document.getElementById('lat').innerText;
                var lng = document.getElementById('lng').innerText;
                              // Validate user input as numbers
                lat = (!isNumber(lat) ? 0 : lat);
                lng = (!isNumber(lng) ? 0 : lng);
                              // Validate user input as valid lat/lng values
                lat = latRange(lat);
                lng = lngRange(lng);
                              // Create LatLng object
                var mapCenter = new google.maps.LatLng(lng,lat);
                var marker = new google.maps.Marker({
                    position: mapCenter,
                    title: 'Marker title',
                    map: map
                });
                              // Center map
                map.setCenter(mapCenter);
          }

          function isNumber(n) {
              return !isNaN(parseFloat(n)) && isFinite(n);
          }

          function latRange(n) {
              return Math.min(Math.max(parseFloat(n), -maxLat), maxLat);
          }

          function lngRange(n) {
              return Math.min(Math.max(parseFloat(n), -180), 180);
          } 
    </script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBo5MDKaN-aF8_XHf8IzgVqDT1emRmvQ2Q&callback=initializeMap&v=weekly"
      defer
    ></script>
 </head>
 <body>    
    
    <div class="col-md-8 mx-auto">
        <p>Title: <?php echo $data['title'] ?></p>
        <p>Date: <?php echo date('Y-m-d',strtotime($data['date'])); ?> </p>
        <p>Address latitude: <label id="lat"><?php echo $data['ST_X(address)']; ?></label></p>
        <p>Address longtitude: <label id="lng"><?php echo $data['ST_Y(address)']; ?></label> </p>
        <div id="map-canvas" style="width:300px;height:300px;"></div>
        <p>Country: <?php echo $data['country'] ?></p>

        <form method='get' action='/conference/delete'>
              <input type='hidden' id='id' name='id' value=<?php echo $data['id'] ?>/>
              <input type='submit' value='Delete' />
            </form>
        
        <form action="/conference/list">
            <input type="submit" value="go back" />
        </form>
    </div>
 </body>
</html>