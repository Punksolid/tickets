<html>
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>

</head>
<body>
<div id="map" style="width: 100%; height: 500px;"></div>
{{--{!! $markers !!}}--}}
</body>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
<script>
    var map = L.map('map').setView([24.8611545,-107.3906211], 13);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicHVua3NvbGlkIiwiYSI6ImNsMXpycmFhbTA0em8zaWpyNHNvNzZ0bHoifQ.w_es0DEYkfIvycN6gTQELQ', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoicHVua3NvbGlkIiwiYSI6ImNsMXpycmFhbTA0em8zaWpyNHNvNzZ0bHoifQ.w_es0DEYkfIvycN6gTQELQ'
    }).addTo(map);
    var locations = {!! $markers !!}
    for (var i = 0; i < locations.length; i++) {
        marker = new L.marker([locations[i][0], locations[i][1]])
            .addTo(map);
    }
</script>
</html>
