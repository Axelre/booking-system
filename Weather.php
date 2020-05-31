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

    <script>

        function GetUnixDate($Year, $Month, $Day)
        {
            var datum = new Date(Date.UTC($Year, $Month, $Day,'10','00','00'));
            return datum.getTime()/1000;
        }

        $(document).ready(function()
        {
            $(".wbutton1").hover(function()
            {
                $(getWeather((this).value));
            });

            $(".wbutton2").hover(function()
            {
                $(getWeather((this).value));
            });
        })
        
    </script>

</head>
    <body>

    <div class="input">
    <button class="wbutton1" onclick="getWeather()" value="GetUnixDate($2020, $05, $29)">Todays weather</button>
    <button class="wbutton2" onclick="getWeather()" value="GetUnixDate($2020, $05, $30)">Tomorrows weather</button>
    
    </body>
</html>