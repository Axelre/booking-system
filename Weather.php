<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API</title>
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="apiscript.js"></script>
    <link rel="stylesheet" href="apistyle.css">

</head>
    <body>
    
    <div class="display">
    <button class="wbutton1" onclick="var values = getWeather(0)">Todays weather</button>
    <button class="wbutton2" onclick="var values = getWeather(1)">Tomorrows weather</button>
</br>
        <img id="icon">
        <p id="temp"></p>
        <p id="desc"></p>
    </div>

    </body>
</html>