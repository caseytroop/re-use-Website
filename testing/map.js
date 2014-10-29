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
	//setMarker(new google.maps.LatLng(47.472173, -94.881648), 'Goodwill');
	//connect to database and get all stores with item
	for (var i = 0; i < allMarkers.length; i++)
	{
		if (allMarkers[i][7] == item)
		{
			setMarker(new google.maps.LatLng(allMarkers[i][1], allMarkers[i][2]), allMarkers[i][0]);
		}
	}
}

function createAllMarkers()
{
	var allStores = [];
	var goodwill = [];
	goodwill.push("Goodwill");
	goodwill.push("47.472173");
	goodwill.push("-94.881648");
	goodwill.push("Address");
	goodwill.push("Phone");
	goodwill.push("Email");
	goodwill.push("goodwill.png");
	goodwill.push("clothing");
	allStores.push(goodwill);
	var tkz = [];
	tkz.push("Tk'z Closet");
	tkz.push("47.470792");
	tkz.push("-94.882243");
	tkz.push("Address");
	tkz.push("Phone");
	tkz.push("Email");
	tkz.push("tkz.png");
	tkz.push("clothing");
	allStores.push(tkz);
	var twice = [];
	twice.push("Twice but Nice");
	twice.push("47.471883");
	twice.push("-94.881031");
	twice.push("Address");
	twice.push("Phone");
	twice.push("Email");
	twice.push("twice.png");
	twice.push("clothing");
	allStores.push(twice);
	var mbfc = [];
	mbfc.push("My Best Friend's Closet");
	mbfc.push("47.469740");
	mbfc.push("-94.881187");
	mbfc.push("Address");
	mbfc.push("Phone");
	mbfc.push("Email");
	mbfc.push("mbfc.png");
	mbfc.push("clothing");
	allStores.push(mbfc);
	var phils = [];
	phils.push("St. Philip's Clothing Depot");
	phils.push("47.475237");
	phils.push("-94.880512");
	phils.push("Address");
	phils.push("Phone");
	phils.push("Email");
	phils.push("phils.png");
	phils.push("clothing");
	allStores.push(phils);
	var tnt = [];
	tnt.push("T-N-T Secondhand");
	tnt.push("47.483852");
	tnt.push("-94.927327");
	tnt.push("Address");
	tnt.push("Phone");
	tnt.push("Email");
	tnt.push("tnt.png");
	tnt.push("clothing");
	allStores.push(tnt);
	var aunt = [];
	aunt.push("Aunt Ellie's");
	aunt.push("47.453613");
	aunt.push("-94.863358");
	aunt.push("Address");
	aunt.push("Phone");
	aunt.push("Email");
	aunt.push("aunt.png");
	aunt.push("clothing");
	allStores.push(aunt);
	var bensons = [];
	bensons.push("Benson's Auto");
	bensons.push("47.453113");
	bensons.push("-94.863958");
	bensons.push("Address");
	bensons.push("Phone");
	bensons.push("Email");
	bensons.push("bensons.png");
	bensons.push("cars");
	allStores.push(bensons);
	return allStores;
}


