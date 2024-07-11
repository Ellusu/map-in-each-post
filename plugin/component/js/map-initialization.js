document.addEventListener('DOMContentLoaded', function() {
    if (typeof mapInEachPost === 'undefined') {
        console.error('mapInEachPost is not defined');
        return;
    }

    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 50,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Points &copy; 2012 LINZ'
    });

    var latlng = L.latLng(mapInEachPost.lat, mapInEachPost.lon);
    var map = L.map('map', {center: latlng, zoom: mapInEachPost.zoom, layers: [tiles]});
    var markers = L.markerClusterGroup();

    if (Array.isArray(mapInEachPost.locations)) {
        mapInEachPost.locations.forEach(function(location) {
            var title = '<strong>' + location.title + '</strong><p>' + location.desc + '</p><p><a href="' + location.link + '" target="_blank">View</a></p>';
            var marker = L.marker(new L.LatLng(location.lat, location.lon), { title: title });
            marker.bindPopup(title);
            markers.addLayer(marker);
        });
    } else {
        console.error('mapInEachPost.locations is not an array');
    }

    map.addLayer(markers);
});
