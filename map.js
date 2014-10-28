function initialize() {
	var mapCanvas = document.getElementById('map_canvas');
	var mapOptions = {
	  center: new google.maps.LatLng(47.4736, -94.9903),
	  zoom: 11,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(mapCanvas, mapOptions);
	markers = [];
	allMarkers = createAllMarkers();
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
	//connect to database and get all stores with item
	//<?php
	//	$sql = "SELECT name FROM stores WHERE goods=" . item
	//	$result = $db->query($sql);
	//	$row=$result->fetch();
	//?>
	//name = <?php $row?>;
	//setMarker(name);
}

function createAllMarkers()
{
	var allStores = [];
	var goodwill = [];
	goodwill.push("Goodwill");
	goodwill.push("47.472173 -94.881648");
	goodwill.push("Address");
	goodwill.push("Phone");
	goodwill.push("Email");
	goodwill.push("goodwill.png");
	allStores.push(goodwill);
	var tkz = [];
	tkz.push("Tk'z Closet");
	tkz.push("47.470792 -94.882243");
	tkz.push("Address");
	tkz.push("Phone");
	tkz.push("Email");
	tkz.push("tkz.png");
	allStores.push(tkz);
	var twice = [];
	twice.push("Twice but Nice");
	twice.push("47.471883 -94.881031");
	twice.push("Address");
	twice.push("Phone");
	twice.push("Email");
	twice.push("twice.png");
	allStores.push(twice);
	var mbfc = [];
	mbfc.push("My Best Friend's Closet");
	mbfc.push("47.469740 -94.881187");
	mbfc.push("Address");
	mbfc.push("Phone");
	mbfc.push("Email");
	mbfc.push("mbfc.png");
	allStores.push(mbfc);
	var phils = [];
	phils.push("St. Philip's Clothing Depot");
	phils.push("47.475237 -94.880512");
	phils.push("Address");
	phils.push("Phone");
	phils.push("Email");
	phils.push("phils.png");
	allStores.push(phils);
	var tnt = [];
	tnt.push("T-N-T Secondhand");
	tnt.push("47.483852 -94.927327");
	tnt.push("Address");
	tnt.push("Phone");
	tnt.push("Email");
	tnt.push("tnt.png");
	allStores.push(tnt);
	var aunt = [];
	aunt.push("Aunt Ellie's");
	aunt.push("47.453613 -94.863358");
	aunt.push("Address");
	aunt.push("Phone");
	aunt.push("Email");
	aunt.push("aunt.png");
	allStores.push(aunt);
}


