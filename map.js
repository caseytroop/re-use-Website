function initialize() {
	var mapCanvas = document.getElementById('map_canvas');
	var mapOptions = {
	  center: new google.maps.LatLng(47.4736, -94.9903),
	  zoom: 11,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(mapCanvas, mapOptions);
	markers = [];
	setMarker(new google.maps.LatLng(47.472173, -94.881648), 'Goodwill');
	setMarker(new google.maps.LatLng(47.471883, -94.881031), 'Twice but Nice');
	setMarker(new google.maps.LatLng(47.470792, -94.882243), 'T k\'z closet');
	setMarker(new google.maps.LatLng(47.469740, -94.881187), 'My best friend\'s closet');
	setMarker(new google.maps.LatLng(47.475237, -94.880512), 'St. Philip\'s clothing depot');
	setMarker(new google.maps.LatLng(47.483852, -94.927327), 'T-N-T Secondhand');
	setMarker(new google.maps.LatLng(47.453613, -94.863358), 'Aunt Ellie\'s Attic');
	
	//kat's book nook llc
	//book world
	//roy's comics and games
	//bill's used furniture and appliances
}
google.maps.event.addDomListener(window, 'load', initialize);
function setMarker(latLon, name)
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
	    contact = document.createElement('p');
	    address = "2432 Adams Ave" + "<br>";
	    tele = "(218) 444-1234" + "<br>";
	    email = "<a href='" + "something@domain.com" + "'>" + "something@domain.com" + "</a>";
	    contact.innerHTML = address + tele + email;
	    website = document.createElement('p');
	    website.innerHTML = "<a href='" + "http://goodwill.org" + "'>" + "goodwill.org" + "</a>";
	    someDiv.appendChild(contact);
	    someDiv.appendChild(website);
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
	setMarker(new google.maps.LatLng(47.472173, -94.881648), 'Goodwill');
	//THIS IS A TEST
	//connect to database and get all stores with item
	//<?php
	//	$sql = "SELECT name FROM stores WHERE goods=" . item
	//	$result = $db->query($sql);
	//	$row=$result->fetch();
	//?>
	//name = <?php $row?>;
	//setMarker(name);
}


