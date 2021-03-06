<?php 
include '../Databaseinfo.php';
session_start();
if ( isset( $_SESSION['user_id'] ) ) 
{
	
} 
else 
{
    header("Location: login.php");
}
//Kontrollerar att användaren är inloggad, annars slängs man till loginsidan
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAKTERRASSEN</title>
    <link rel="stylesheet" type="text/css" href="../CSS/mainpagestyle.css">
    <link href="../CSS/calendar.css" type="text/css" rel="stylesheet"/>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
   <!--script för att kunna använda oss av vår kartapi senare-->
   <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous">
    </script>
 <!--Jquery script för att kunna använda oss av vår väderapi senare-->
</head>
<body>
    <div id="container">
        <div class="header">
            <h1>TAKTERRASSEN</h1>
        </div>
        <div class="topnav">
            <a class="home" href="#home">Home</a>
            <a href="bulletinboard.php">Anslagstavlan</a>
            <a href="../Logout.php">Log Out</a>
          </div>
          <div class="row">

            
              <div class="col-lg-6">

              <div><div class='box green'></div> <p>= Tillgänglig</p></div>
              
              <br>
              <div><div class='box red'></div> <p>= Bokad av någon annan</p></div>
              <br>
              <div><div class='box purple'></div><p>= Bokad av mig</p></div>
              
              

              
                  <?php


include '../Calendar.php';
include '../Booking.php';
include '../BookableCell.php';
 
 
$booking = new Booking(

);
 
$bookableCell = new BookableCell($booking);
 
$calendar = new Calendar();
 
$calendar->attachObserver('showCell', $bookableCell);
 
$bookableCell->routeActions();
 
echo $calendar->show();
?>

</div>
<h4> Blå pil = Din position</h4>
              <h4> 
              Grön pil = Takterrassens position
              </h4>


            
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
  <h2 id="wTitle">Väder:</h2>
    <button class="wbutton" onclick="var values = getWeather(0)">Vädret idag</button>
    <button class="wbutton" onclick="var values = getWeather(1)">Vädret imorgon</button>
</br>
<button class="wbutton" onclick="var values = getWeather(2)">Vädret om
  <select id="weatherday">        
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
  </select> dagar </button>
</br><!--Knappar och värden som kallar på vårt script för att hämta information om vädret för en specifik dag-->
        <img id="icon"></br>
        <p id="temp"></p></br>
        <p id="mintemp"></p></br>
        <p id="maxtemp"></p></br>
        <p id="humidity"></p></br>
        <p id="desc"></p></br>
    </div><!--paragrafer och ikoner som kommer att fyllas med information vi hämtar via vår väderapi-->

<script>

function getWeather(day)
{
  fetch('https://api.openweathermap.org/data/2.5/onecall?lat=59.853920&lon=17.616150&units=metric&lang=se&appid=8704ed9bc9d4d04fcfe7d10ced95aead')
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
//Hämtar data via vår väderapi och tilldelar data till våra paragrafer beroende på vilken input vi fått från användaren. 
//Vi avrundar även grader och lägger till lite mer informationstext till användaren

function capitalizeFLetter(string) 
  { 
    var rstring = string[0].toUpperCase() +  
    string.slice(1); 
    return rstring; 
  } //Funktion för att få en tor bokstav i början av vår inhämtade väderbeskrivning
</script>
          
</body>
</html>