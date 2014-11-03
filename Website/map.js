function initialize() {
	var mapCanvas = document.getElementById('map_canvas');
	var mapOptions = {
	  center: new google.maps.LatLng(47.4736, -94.9903),
	  zoom: 11,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
        google.maps.event.addDomListener(window, 'resize', function() {
        center = map.getCenter();
        google.maps.event.trigger(map,"resize");
        map.setCenter(center);
    });


	var map = new google.maps.Map(mapCanvas, mapOptions)
	setMarker(new google.maps.LatLng(47.472173, -94.881648), map, 'Goodwill');
	setMarker(new google.maps.LatLng(47.471883, -94.881031), map, 'Twice but Nice');
	setMarker(new google.maps.LatLng(47.470792, -94.882243), map, 'T k\'z closet');
	setMarker(new google.maps.LatLng(47.469740, -94.881187), map, 'My best friend\'s closet');
	setMarker(new google.maps.LatLng(47.475237, -94.880512), map, 'St. Philip\'s clothing depot');
	setMarker(new google.maps.LatLng(47.483852, -94.927327), map, 'T-N-T Secondhand');
	setMarker(new google.maps.LatLng(47.453613, -94.863358), map, 'Aunt Ellie\'s Attic');
	
	//kat's book nook llc
	//book world
	//roy's comics and games
	//bill's used furniture and appliances
}
google.maps.event.addDomListener(window, 'load', initialize);
function setMarker(latLon, map, name)
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
    
    
}

