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
   <style>

#mapid { height: 300px; 
width: 300px;
position: absolute;
  left: 2;
  top: 14%;
    }
}

   </style>
 
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
            <a href="Mybookings.php">My bookings</a>
          </div>
          <div class="row">

            
              <div class="col-lg-6">
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
   const mymap = L.map('mapid').setView([59.85819839999999, 17.646541800000022], 12);
   const attribution =  '&copy; <a href = "https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
   const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
   const tiles = L.tileLayer(tileUrl, {attribution});
   tiles.addTo(mymap);
   L.marker([59.853920, 17.616150]).addTo(mymap);
   navigator.geolocation.getCurrentPosition(function(location) {
  const latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
  L.marker(latlng).addTo(mymap);


});

  </SCRIPT>


          
</body>
</html>