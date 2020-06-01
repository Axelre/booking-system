

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
   <style>

#mapid { height: 300px; 
width: 500px;
}

   </style>
</head>
<body>
  <div id="mapid"></div>
  <SCRIPT>  
   const mymap = L.map('mapid').setView([59.85819839999999, 17.646541800000022], 12);
   const attribution =  '&copy; <a href = "https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
   const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
   const tiles = L.tileLayer(tileUrl, {attribution});
   tiles.addTo(mymap);
   var green = L.icon({
    iconUrl: 'marker-icon-2x-green.png',
    iconSize: [24, 40],
    iconAnchor: [22, 94],
    popupAnchor: [-3, -76],
    shadowSize: [68, 95],
    shadowAnchor: [22, 94]
});
   var marker = L.marker([59.853920, 17.616150], {icon: green}).addTo(mymap);
   

   navigator.geolocation.getCurrentPosition(function(location) {
  const latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
  L.marker(latlng).addTo(mymap);
});


  </SCRIPT>

</body>
</html>