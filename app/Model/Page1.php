
<?php 
	$con = mysql_connect("localhost","username","password");
    if(!$con){
      die("can not connect:" . mysql_error()); 
    }
    mysql_select_db("databasename",$con);
	$illnessquery = mysql_query("SELECT illness FROM decision",$con);
	$marketquery = mysql_query("SELECT market FROM decision",$con);
	$autoxquery = mysql_query("SELECT autox FROM decision",$con);
	$illness; $market;  $autox;
	while ($row = mysql_fetch_array($illnessquery, MYSQL_ASSOC)) {
	    $illness =  $row['illness'];  
	}
	while ($row = mysql_fetch_array($marketquery, MYSQL_ASSOC)) {
	    $market =  $row['market'];  
	}
	while ($row = mysql_fetch_array($autoxquery, MYSQL_ASSOC)) {
	    $autox =  $row['autox'];  
	}					
   	$recommendedquery = mysql_query("SELECT $illness FROM recommended",$con);
	$recommendedfoods = Array();
	while ($row = mysql_fetch_array($recommendedquery, MYSQL_ASSOC)) {
	    $recommendedfoods[] =  $row[$illness];  
	}
	$price = array();
	for($x = 0 ; $x<count($recommendedfoods);$x++){
 		$pricequery = mysql_query("SELECT DISTINCT price FROM the_market WHERE comodity LIKE '%{$recommendedfoods[$x]}%'",$con);
		while ($row = mysql_fetch_array($pricequery, MYSQL_ASSOC)) {
			$price[] =  $row['price']; 
		}
	}
	$notrecommendedquery = mysql_query("SELECT $illness FROM not_recommended",$con);
	$notrecommendedfoods = array();
	while ($row = mysql_fetch_array($notrecommendedquery, MYSQL_ASSOC)) {
		$notrecommendedfoods[] =  $row[$illness];  
	}
	mysql_close($con);
	set_error_handler('exceptions_error_handler');
	function exceptions_error_handler($severity, $message, $filename, $lineno) {
		if (error_reporting() == 0) {
			return;
		}
		if (error_reporting() & $severity) {
			throw new ErrorException($message, 0, $severity, $filename, $lineno);
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Healthspenditure</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bootstrap/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="style.css">
  <script src="jquery-2.1.4.js"></script>
  <script src="/bootstrap/bootstrap/js/bootstrap.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXPd7SzVguXAy0-RXNhQUwV2sU4jtXk1I&signed_in=true&libraries=places&callback=initMap" async defer></script>
  <script>
   	var map;
   	var infoWindow;
   	var you;
	var isAuto;
	var marketName;
	
	function initMap() {
		var customMapType = new google.maps.StyledMapType([
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#444444"
            }
        ]
    },
    {
        "featureType": "administrative.country",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.country",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.country",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.country",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.locality",
        "elementType": "labels",
        "stylers": [
            {
                "hue": "#ffe500"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "color": "#f2f2f2"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural.landcover",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.attraction",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.business",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.place_of_worship",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.school",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 45
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit.station",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#9bdffb"
            },
            {
                "visibility": "on"
            }
        ]
    }], {name: 'nc 10'});
			 map = new google.maps.Map(document.getElementById('map'), {
			 	mapTypeControl: false,
   			 	center: {lat: 121, lng: 14},
			    zoom: 6,
			    disableDefaultUI: true,
    			mapTypeControlOptions: {
      				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'nc10']
    			}
			  });
			map.mapTypes.set('nc10', customMapType);
 			map.setMapTypeId('nc10');
			 you = new google.maps.InfoWindow();
				isAuto = document.getElementById("secretAuto").value;
				marketName = document.getElementById("secretMarket").value;
			  // Try HTML5 geolocation.
			 if (navigator.geolocation) {
			    navigator.geolocation.getCurrentPosition(function(position) {
			    var pos = {
			        lat: position.coords.latitude,
			        lng: position.coords.longitude
			      };
			     currentPositionMarker(pos);
			 	infowindow = new google.maps.InfoWindow();
			      map.setCenter(pos);
			      map.setZoom(16);
			    
			     	
			     		if(isAuto=="true"){
			     			 var circle = new google.maps.Circle({
           					 center: pos,
           					 map: map,
           					 radius: 1000,          // IN METERS.
           					 fillColor: '#FF6600',
           					 fillOpacity: 0.3,
            				 strokeColor: "#FFF",
            				 strokeWeight: 0         // DON'T SHOW CIRCLE BORDER.
       						 });


			     			var service = new google.maps.places.PlacesService(map);
							service.nearbySearch({
				  			location: pos,
			      			radius: 1000,
			      			types: ['grocery_or_supermarket']
				  			}, callback);
			     		}
			     		else{
			     			var service = new google.maps.places.PlacesService(map);
							service.textSearch({
				  			location: pos,
				  			radius: 50000,
			      			query: marketName
				  			}, callback);

			     		}
			     	
			     
			    }, function() {
			      handleLocationError(true, you, map.getCenter());
			    });
			  } else {
			    // Browser doesn't support Geolocation
			    handleLocationError(false, you, map.getCenter());
			  }
			 
			}

			function callback(results, status) {
			  if (status === google.maps.places.PlacesServiceStatus.OK) {
			  if(isAuto=="true"){
			    for (var i = 0; i < results.length; i++) {
			      createMarker(results[i]);
			    }
			}
			else{
				createMarker(results[0]);
				 map.setCenter(results[0].geometry.location);
			}

			  }
			}

		
			function currentPositionMarker(pos){
			  
			  	var pinIcon = new google.maps.MarkerImage(
    			'images/personicon.png',
    			null, /* size is determined at runtime */
    			null, /* origin is 0,0 */
    			null, /* anchor is bottom center of the scaled image */
    			new google.maps.Size(42, 42)
				);  
			 	var marker = new google.maps.Marker({
			    map: map,
			    title:"You are currently here",
			    position: pos,
			    icon: pinIcon
			  });
			
			  google.maps.event.addListener(marker, 'click', function() {
			    you.setContent("You are currently here ");
			    you.open(map, this);
			  });
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
		
			function handleLocationError(browserHasGeolocation, infoWindow, pos) {
			 you.setPosition(pos);
			 you.setContent(browserHasGeolocation ?
			                        'Error: The Geolocation service failed.' :
			                        'Error: Your browser doesn\'t support geolocation.');
			}
			function LoadMenu(){
				window.location.href="index.php";
			}
    </script>
    <style>
    	h3{
		  font-family: FreesiaUPC;
		  color: white;
		  display: inline-block;
		  font-size: 35px;
		  margin-top: 5px;
		}
		h2{
		  margin-top: 70px;
		  margin-left: 15px;
		  font-size: 20px;
		}
    </style>
</head>
<body>

	<input type ="text" class="hidden" id="secretAuto" value="<?php echo $autox; ?>">
	<input type ="text" class="hidden" id="secretMarket" value="<?php echo $market; ?>">
	
<div id="backmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Are you sure?</h4>
			</div>
			<div class="modal-body">
        		<p>Back to menu?</p>
   			</div>
   			<div class="modal-footer">
        		<button  class="btn btn-danger modalbutton" data-dismiss="modal" onclick="LoadMenu()">Yes</button>
        		<button  class="btn btn-default modalbutton" data-dismiss="modal">Cancel</button>
   			</div>
   		</div>
   	</div>
</div>


		<div class="div50 pull-left">
	<div id="explainmodal" class="modal fade" role="dialog">

			<div class="modal-dialog">
				<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> <p id="secretFood"></p></h4>
			</div>
			<div class="modal-body">
        		<p id="explanation"></p>
                <span id="link" class="pull-right"></span>
                <div class="clearfix">
                </div>
   			</div>
   			<div class="modal-footer">     
        		<button  class="btn btn-default modalbutton" data-dismiss="modal">Close</button>
   			</div>
   				</div>
   			</div>
		</div>
			<div class="navbar transparent navbar-inverse navbar-fixed-top">
				<button type="button" class="wd btn-lg">
  					<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
				</button>
		  			<h3>healthspenditure</h3>
		  		<!-- add on glyphicon
		  		<button type="button" class="btn btn-default btn-lg">
  					<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
				</button>
				-->
		  	</div>
            <div class="thelagayan">
			<div class="lagayan center-block container-fluid">
				
				<center><h3 class="text-success">Recommended Foods</h3></center>	
			
				<table class="table table-striped">
   				 <thead>
   				   <tr>
   				     <th>Food</th>
   				     <th>Price</th>
   				   </tr>
   				 </thead>
   				 <tbody id="troww" data-toggle="modal" data-target="#explainmodal" onclick="c()">

   				 <?php for ($x=0;$x<count($recommendedfoods);$x++){
   				 		?> <tr >
   				    		 <td><?php echo $recommendedfoods[$x]; ?></td>
   				    		 <td><?php try{echo $price[$x];}catch(Exception $e){ echo "Price not updated"; }?></td>
   				  		   </tr>
   				  		 <?php 
   				  		}
   				 	 ?>
   				 	 <script>

 					$(function(){
                       
 						$("#troww tr td:first-child").click(function(){
   							$("#secretFood").text($(this).text());
                            $.post('explain.php', {
                                foodname: $(this).text(),
                                callTo: "rcmd"
                            }, function(data){
                                if(data == "None" || data==""){
                                    $("#explanation").text("No Explanation");
                                    $("#link").html("");
                                }
                                else{
                                    $("#explanation").text(data);   
                                    $("#link").html("Source: visit <a href='http://www.livestrong.com' target='blank' class='text-info'>Livestrong.com</a> for more information");
                                }
                                
                            });
 						 });
  					});

 						 	

					</script>
   				 </tbody>
 				 </table>
			</div>
			
			<div class="lagayan_sapa center-block">

				<center><h3 class="text-danger">Avoid these Foods</h3></center>	
				
				<table class="table table-striped text-center">
   				 <tbody id="troww2" data-toggle="modal" data-target="#explainmodal" onclick="c()">
   				  <?php for ($x=0;$x<count($notrecommendedfoods);$x++){ ?> 
   				   <tr>
   				     <td><?php echo $notrecommendedfoods[$x]; ?></td>
   				   </tr>
   				   <?php } ?>
   				   <script>
 					$(function(){

 						$("#troww2 tr td").click(function(){

   							$("#secretFood").text($(this).text());
  							 $.post('explain.php', {
                                foodname: $(this).text(),
                                callTo: "nrcmd"
                            }, function(data){
                                if(data == "None" || data==""){
                                    $("#explanation").text("No Explanation");
                                    $("#link").html("");  
                                }
                                else{
                                    $("#explanation").text(data); 
                                    $("#link").html("Source: visit <a href='http://www.livestrong.com' target='blank' class='text-info'>Livestrong.com</a> for more information");  
                                }
                                
                            });
 						});
  					});
					</script>
   				 </tbody>
 				 </table>
			</div>
	       
			<br>
		<center>
			<span href="Page2.php" class="I_design" onclick="LoadRecipes()">View Available Recipes</span>
			<span class="I_design_2"  data-toggle="modal" data-target="#backmodal">Back</span>
		</center>
		</div>
		</div>
			<div id="map" class="pull-right"></div>
	<script>
		function LoadRecipes(){
			//window.location.href="Page2.php";
            alert("We are currently constructing this part of the website and this will be available soon.. Thank you!");
		}
	</script>
</body>
</html>