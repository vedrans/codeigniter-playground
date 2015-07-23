<!--
<div id="panel" style="margin-left: -260px">
    <input id="searchTextField" type="text" size="50">
    <input type="radio" name="type" id="changetype-all" checked="checked">
    <label for="changetype-all">All</label>
    <input type="radio" name="type" id="changetype-establishment">
    <label for="changetype-establishment">Establishments</label>
    <input type="radio" name="type" id="changetype-geocode">
    <label for="changetype-geocode">Geocodes</lable>
</div>
-->

<?php if($this->session->userdata('logged_in')) : ?>
<?php $user = $this->session->userdata('logged_in'); ?>
	<div id="floatbar" class="row-fluid navbar-inverse">
		<div id="fbleft" class="span6">
			<select id="categorymenu" style="width: 98%; margin-top: 8px; height: 50px; font-size: 150%;">
			  <option value="no">Choose category</option>
			  <option value="department_store">Department Store</option>
     		  <option value="florist">Florist</option>
			  <option value="grocery_or_supermarket">Grocery Or Supermarket</option>
			  <option value="parking">Parking</option>
			  <optoin value="post_office">Post Office</optoin>
			</select>
		</div>
		<div id="fbright" class="span6">
			<span class="form-search" style="font-size:150%;">
			  <input id="searchTextField" type="text" class="input-medium" style="width: 77%; margin-top: 8px; height: 41px; font-size: 150%;">
			  <button id="searchbtn" type="button" class="btn" style="margin-top: 8px; height: 50px; font-size: 150%; line-height: 59px;"><i class="icon-search"></i></button>
			</span>
		</div>
	</div>
	<div id="resultbox" class="hide">
		<h1>Welcome to Vedran's test CodeIgniter app!</h1>
	
		<div id="body">
		
			<p>
				<strong>Your informations:</strong><br />
				Your name : <?php echo $user['name'] ?> <br />
				<?php 
					print_r($user);
				?>
				
			</p>
			
		</div>
	
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div>

<?php else : ?>

	<div id="resultbox">
	<h1>You need to login first!</h1>
	
		<div id="body">
			<p>In order to use this service you need to login first.</p>
	
			<p>Click on <strong>Sign Up</strong> or <strong>Login</strong> link above. Both do same thing.</p>
			
			<p>Since this is only for testing purpose, this application is not connected to database, so there is 
				no real register option. That is why both options (Sign Up and Login) do the same thing: 
				they both request your information from your facebook profile and after that they set session
				variable which tells system that you are "loged in".
			</p>
			
			<p>
				However, this is not safe behaviour for real life applications.
			</p>
		</div>
	
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div>

<?php endif; ?>


<div id="map-canvas"></div>
<script src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<script src="/assets/js/jquery.min.js"></script>
 
<script>
        var mapOptions = {
	        center: new google.maps.LatLng(51.5072, 0.1275),
	        zoom: 9,
	        mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
	    var map = new google.maps.Map(document.getElementById('map-canvas'),
	    mapOptions);
	
	    var input = /** @type {HTMLInputElement} */
	    (document.getElementById('searchTextField'));
	    var autocomplete = new google.maps.places.Autocomplete(input);
	
	    autocomplete.bindTo('bounds', map);
	
	    var infowindow = new google.maps.InfoWindow();
	    var marker = new google.maps.Marker({
	        map: map
	    });
	
		$('#searchbtn').click(function(){
			var category = $('#categorymenu').val();
			var lvar = $('#searchTextField').val();
			
			if(category == 'no'){
				alert('First you need to select category!');
			}else if(lvar == ''){
				alert('You need to type location!');	
			}else{
				alert('Category: '+category+' and location: '+lvar);
				
				infowindow.close();
			    marker.setVisible(false);
			    input.className = '';
			    var place = autocomplete.getPlace();
			    if (!place.geometry) {
			      // Inform the user that the place was not found and return.
			      input.className = 'notfound';
			      return;
			    }
			
			    // If the place has a geometry, then present it on a map.
			    if (place.geometry.viewport) {
			      map.fitBounds(place.geometry.viewport);
			    } else {
			      map.setCenter(place.geometry.location);
			      map.setZoom(17);  // Why 17? Because it looks good.
			    }
			    
			    var request = {
				    location: place.geometry.location,
				    radius: '500',
				    types: [category]
				};
				
				service = new google.maps.places.PlacesService(map);
				service.nearbySearch(request, callback);
					
			}
		});
		
		function callback(results, status) {
		  if (status == google.maps.places.PlacesServiceStatus.OK) {
		    for (var i = 0; i < results.length; i++) {
		      var place = results[i];
		      createMarker(results[i]);
		    }
		  }
		}
		
		function createMarker(place) {
		  var placeLoc = place.geometry.location;
		  var marker = new google.maps.Marker({
		    map: map,
		    position: place.geometry.location
		  });
		
		  google.maps.event.addListener(marker, 'click', function() {
		    infowindow.setContent(place.name);
		    infowindow.open(map, this);
		  });
		}
		
</script>

