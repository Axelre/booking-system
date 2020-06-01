<?php 
include 'Databaseinfo.php';
session_start();
if ( isset( $_SESSION['user_id'] ) ) 
{
	
} 
else 
{
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAKTERASSEN</title>
    <link rel="stylesheet" type="text/css" href="mainpagestyle.css">
    <link href="calendar.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="MainPage.js"></script>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
   <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous">
    </script>
 
</head>
<body>
    <div id="container">
        <div class="header">
            <h1>TAKTERASSEN</h1>
        </div>
        <div class="topnav">
            <a class="home" href="#home">Home</a>
            <a href="bulletinboard.php">Bulletin board</a>
            <a href="Logout.php">Log Out</a>
          </div>
          <div class="row">

            
              <div class="col-lg-6">

              <div><div class='box green'></div> <p>= Tillgänglig</p></div>
              
              <br>
              <div><div class='box red'></div> <p>= Bokad av någon annan</p></div>
              <br>
              <div><div class='box purple'></div><p>= Bokad av mig</p></div>
              
                  <?php


include 'Calendar.php';
include 'Booking.php';
include 'BookableCell.php';
 
 
$booking = new Booking(

);
 
$bookableCell = new BookableCell($booking);
 
$calendar = new Calendar();
 
$calendar->attachObserver('showCell', $bookableCell);
 
$bookableCell->routeActions();
 
echo $calendar->show();
?>

</div>


            
 </div>
             
</div>
<div id="mapid"></div>
  <SCRIPT>  
   const mymap = L.map('mapid').setView([59.85819839999999, 17.646541800000022],12);
   const attribution =  '&copy; <a href = "https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
   const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
   const tiles = L.tileLayer(tileUrl, {attribution});
   tiles.addTo(mymap);
   var green = L.icon({
    iconUrl: 'marker-icon-2x-green.png',
    iconSize: [24, 40],
    iconAnchor: [15, 40],
});
   var marker = L.marker([59.853920, 17.616150], {icon: green}).addTo(mymap);
   navigator.geolocation.getCurrentPosition(function(location) {
  const latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
  L.marker(latlng).addTo(mymap);


});

  </SCRIPT>

<div class="displayweather">
  <h2>Väder:</h2>
    <button class="wbutton1" onclick="var values = getWeather(0)">Vädret idag</button>
    <button class="wbutton2" onclick="var values = getWeather(1)">Vädret imorgon</button>
</br>
<button class="wbutton2" onclick="var values = getWeather(2)">Vädret om
  <select id="weatherday">        
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
  </select> dagar </button>
</br>
        <img id="icon"></br>
        <p id="temp"></p></br>
        <p id="mintemp"></p></br>
        <p id="maxtemp"></p></br>
        <p id="humidity"></p></br>
        <p id="desc"></p></br>
    </div>
<script>

function getWeather(day)
{
  fetch('https://api.openweathermap.org/data/2.5/onecall?lat=59.8586&lon=17.6389&units=metric&lang=se&appid=8704ed9bc9d4d04fcfe7d10ced95aead')
  .then(response => response.json())
  .then(data =>
  {
    if (day == 0 || day == 1)
    {
      var tempValue = data['daily'][day]['temp']['day'];
      var descValue = data['daily'][day]['weather'][0]['description'];
      var mintempValue = data['daily'][day]['temp']['min'];
      var maxtempValue = data['daily'][day]['temp']['max'];
      var humidityValue = data['daily'][day]['humidity'];
      var iconValue = "http://openweathermap.org/img/wn/" + data['daily'][day]['weather'][0]['icon'] +".png";
    }
    else
    {
      day = document.getElementById("weatherday").value;
      var tempValue = data['daily'][day]['temp']['day'];
      var mintempValue = data['daily'][day]['temp']['min'];
      var maxtempValue = data['daily'][day]['temp']['max'];
      var descValue = data['daily'][day]['weather'][0]['description'];
      var humidityValue = data['daily'][day]['humidity'];
      var iconValue = "http://openweathermap.org/img/wn/" + data['daily'][day]['weather'][0]['icon'] +".png";
    }

    document.getElementById("temp").innerHTML = "Temperatur: " + Math.round(tempValue) + " C";
    document.getElementById("mintemp").innerHTML = "Minsta temperatur: " + Math.round(mintempValue) + " C";
    document.getElementById("maxtemp").innerHTML = "Högsta temperatur: " + Math.round(maxtempValue) + " C";
    document.getElementById("humidity").innerHTML = "Fuktighet: " + humidityValue + " %";
    document.getElementById("desc").innerHTML = "Väderbeskrivning: " +  capitalizeFLetter(descValue);
    $('#icon').attr('src', iconValue);
  }
    )
}

function capitalizeFLetter(string) 
  { 
    var rstring = string[0].toUpperCase() +  
    string.slice(1); 
    return rstring; 
  } 
</script>
          
</body>
</html>