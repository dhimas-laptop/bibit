	var map = L.map('map').setView([0.903451, -255.509514], 9);
    var lokasi;
    
    map.on('click', function(e) {
        
        if(lokasi) {
           lokasi = lokasi.setLatLng(e.latlng);
        } else {
           lokasi = new L.marker(e.latlng).addTo(map);
        }

        var coord = lokasi.getLatLng().toString().split(',');
        var lat = coord[0].split('(');
        var lng = coord[1].split(')'); 
        
        document.getElementById("lat").value = lat[1];
        document.getElementById("lng").value = lng[0];

    } );
    
	var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);