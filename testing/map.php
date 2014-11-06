<!DOCTYPE html>
<html>
  <head>
	  <title>  Beltrami County Re-Stores </title>
	  <link rel="stylesheet" href="style.css">
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
      #map_canvas {
        width: 500px;
        height: 400px;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
		function initialize() {
			var mapCanvas = document.getElementById('map_canvas');
			var mapOptions = {
			  center: new google.maps.LatLng(47.475237, -94.880512),
			  zoom: 11,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			map = new google.maps.Map(mapCanvas, mapOptions);
			markers = [];
			dirButton = document.getElementById('directions');
			dirButton.disabled = true;
			//useText = true;
			<?php
				define("MYSQLUSER", "ctroop");
				define("MYSQLPASS", "00356594");
				define("HOSTNAME", "localhost");
				define("MYSQLDB", "greengrp");
				// Make connection to database
				$connection = new mysqli(HOSTNAME, MYSQLUSER, MYSQLPASS, MYSQLDB);
				if ($connection->connect_error)
				{
					//console.log('Connect Error: ' . $connection->connect_error);
					$file = fopen("makeshiftDB.txt", "r");
					$text = fread($file, filesize("makeshiftDB.txt"));
					fclose($file);
					$useText = true;
				}
				else
				{
					//console.log("Successful connection");
					$useText = true;
					$file = fopen("makeshiftDB.txt", "r");
					$text = fread($file, filesize("makeshiftDB.txt"));
					fclose($file);
				}
			?>
			if (useText="<?php echo $useText; ?>")
			{
				console.log("Connection Error");
				text = <?php echo $text; ?>;
				var lines = text.split("*");
				stores = [];
				for(i=0;i<lines.length;i++)
				{
					attributes=lines[i].split(";");
					stores.push(attributes);
				}
			}
		}
		google.maps.event.addDomListener(window, 'load', initialize);
		function setMarker(latLon, name, addr, phone, eml, img)
		{
			var iconBase = 'https://maps.google.com/mapfiles/kml/paddle/';
			var marker = new google.maps.Marker({
				position: latLon,
				map: map,
				icon: iconBase + 'red-circle.png',
				title: name
			});
			google.maps.event.addListener(marker, 'click', function() {
				map.setZoom(16);
				map.setCenter(marker.getPosition());
				someDiv = document.getElementById('content');
				someDiv.innerHTML = "";
				header = document.createElement('h2');
				header.innerHTML = name;
				someDiv.appendChild(header);
				var contact = document.createElement('p');
				var address = addr + "<br>";
				var tele = phone + "<br>";
				var email = "<a href='" + eml + "'>" + eml + "</a>";
				contact.innerHTML = address + tele + email;
				var image = document.createElement('p');
				image.innerHTML = "<img src=" + img + ">"; //might need height and width and alt
				//var website = document.createElement('p');
				//website.innerHTML = "<a href='" + "http://goodwill.org" + "'>" + "goodwill.org" + "</a>";
				someDiv.appendChild(contact);
				someDiv.appendChild(image);
				dirButton.disabled = false;
				currentLatLon = latLon;
			});
			markers.push(marker);
		}
		function clearMarkers()
		{
			for (var i = 0; i < markers.length; i++)
			{
				markers[i].setMap(null);
			}
			markers.length = 0;
		}

		function getData(item)
		{
			clearMarkers();
			map.setZoom(11);
			map.setCenter(new google.maps.LatLng(47.475237, -94.880512));
			//clear directions
			//not sure if it is worth it
			//connect to database and get all stores with item
			
			for (var i = 0; i < stores.length; i++)
			{
				if (stores[i][7] == item)
				{
					setMarker(new google.maps.LatLng(stores[i][2], stores[i][3]), stores[i][1], stores[i][4], stores[i][5], stores[i][6], stores[i][7]);
					var name = stores[i][1];
					document.createElement('');
				}
			}
		}

		function getDirections()
		{
			if ("geolocation" in navigator)
			{
				clearMarkers();
				navigator.geolocation.getCurrentPosition(function(position)
				{
					var from = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
					var to = currentLatLon;
					var directionsService = new google.maps.DirectionsService();
					var directionsRequest =
					{
						origin: from,
						destination: to,
						travelMode: google.maps.TravelMode.DRIVING
					};
					directionsService.route(directionsRequest, function(response, status)
					{
						if (status == google.maps.DirectionsStatus.OK)
						{
							new google.maps.DirectionsRenderer({
								map: map,
								directions: response
							});
						}
					});
				});
			}
			else
			{
				alert("Location finder not available");
			}
		}

		function search()
		{
			clearMarkers();
			map.setZoom(11);
			map.setCenter(new google.maps.LatLng(47.475237, -94.880512));
			searchItem = document.getElementById('search').value;
			if(useText)
			{
				var resultStores = [];
				for (var i=0; i < stores.length; i++)
				{
					for (var j=0; j < stores[i].length; j++)
					{
						var strLower = stores[i][j].toLowerCase();
						if (strLower.search(searchItem.toLowerCase()) >= 0)
						{
							resultStores.push(stores[i]);
						}
					}
				}
				for (var i = 0; i < resultStores.length; i++)
				{
					setMarker(new google.maps.LatLng(resultStores[i][2], resultStores[i][3]), resultStores[i][1], resultStores[i][4], resultStores[i][5], resultStores[i][6], resultStores[i][7]);
				}
			}
			
		}

		/*function createAllMarkers()
		{
			var allStores = [];
			var goodwill = [];
			goodwill.push("Goodwill");
			goodwill.push("47.472173");
			goodwill.push("-94.881648");
			goodwill.push("407 Beltrami Ave NW, Bemidji, MN 56601");
			goodwill.push("(218) 759-2147");
			goodwill.push("Email");
			goodwill.push("goodwill.jpeg");
			goodwill.push("clothing");
			allStores.push(goodwill);
			var tkz = [];
			tkz.push("Tk'z Closet");
			tkz.push("47.470792");
			tkz.push("-94.882243");
			tkz.push("217 3rd St NW, Bemidji, MN 56601");
			tkz.push("(218) 444-8406");
			tkz.push("Email");
			tkz.push("tkz.jpeg");
			tkz.push("clothing");
			allStores.push(tkz);
			var twice = [];
			twice.push("Twice but Nice");
			twice.push("47.471883");
			twice.push("-94.881031");
			twice.push("411 Beltrami Ave NW, Bemidji, MN 56601");
			twice.push("(218) 751-4241");
			twice.push("Email");
			twice.push("twice.jpeg");
			twice.push("clothing");
			allStores.push(twice);
			var mbfc = [];
			mbfc.push("My Best Friend's Closet");
			mbfc.push("47.469740");
			mbfc.push("-94.881187");
			mbfc.push("209 Beltrami Ave NW, Bemidji, MN 56601");
			mbfc.push("(218) 308-2305");
			mbfc.push("Email");
			mbfc.push("mbfc.jpeg");
			mbfc.push("clothing");
			allStores.push(mbfc);
			var phils = [];
			phils.push("St. Philip's Clothing Depot");
			phils.push("47.475237");
			phils.push("-94.880512");
			phils.push("720 Beltrami Ave NW, Bemidji, MN 56601");
			phils.push("(218) 444-3835");
			phils.push("Email");
			phils.push("phils.jpeg");
			phils.push("clothing");
			allStores.push(phils);
			var tnt = [];
			tnt.push("T-N-T Secondhand");
			tnt.push("47.483852");
			tnt.push("-94.927327");
			tnt.push("1408 Adams Ave NW, Bemidji, MN 56601");
			tnt.push("(218) 751-2103");
			tnt.push("Email");
			tnt.push("tnt.jpeg");
			tnt.push("clothing");
			allStores.push(tnt);
			var shands = [];
			shands.push("Second Hand Splendor");
			tnt.push("47.483852");
			tnt.push("-94.92737");
			tnt.push("301 3rd St. N.W. Bemidji, MN 56601");
			tnt.push("(218) 209-3000");
			tnt.push("Email");
			tnt.push("shands.jpeg");
			tnt.push("clothing");
			var aunt = [];
			aunt.push("Aunt Ellie's Attic");
			aunt.push("47.453613");
			aunt.push("-94.863358");
			aunt.push("824 Washington Ave S, Bemidji, MN 56601");
			aunt.push("(218) 444-4334");
			aunt.push("Email");
			aunt.push("aunt.jpeg");
			aunt.push("clothing");
			allStores.push(aunt);
			var bensons = [];
			bensons.push("Benson's Auto");
			bensons.push("47.473653");
			bensons.push("-94.919421");
			bensons.push("6941 Fairgrounds Rd NW , Bemidji, MN 56601");
			bensons.push("(218) 444-4414");
			bensons.push("Email");
			bensons.push("bensons.jpeg");
			bensons.push("cars");
			allStores.push(bensons);
			return allStores;
		}*/
    </script>
  </head>
  <body>
	  
    <div id="wrapper">
	  <h1> Header 1 </h1>
	   <nav>
	    <ul>	
	     <li><a href="index.html"> Home </a></li>
	     <li><input id="search" type="text"><input type="button" onclick="search()" value="Go"></li>
	     <li><input type="button" value="Clothing" style="border:none;" onclick="getData('clothing')"></li>
	     <li><input type="button" value="Used Cars" style="border:none;" onclick="getData('cars')"></li>
	     <li><input type="button" value="Directions" style="border:none;" onclick="getDirections()" id="directions"></li>
	    </ul>
	   </nav>
	   <div id="map_canvas"></div>
	 <div id="content">
	  
	  </div>
	   <footer>
	    Any Questions Just Email:
	    <address>
	     <h6><a href="beltrami.usedgoods@gmail.com"> beltrami.usedgoods@gmail.com</a></h6>
        </address>
       </footer>
       
       
	 </div>
  </body>
</html>
