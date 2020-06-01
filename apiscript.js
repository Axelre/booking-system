
function getWeather(day)
{
    fetch('https://api.openweathermap.org/data/2.5/onecall?lat=59.8586&lon=17.6389&units=metric&appid=8704ed9bc9d4d04fcfe7d10ced95aead')
.then(response => response.json())
    .then(data =>
    {
        var tempValue = data['daily'][day]['temp']['day'];
        var descValue = data['daily'][day]['weather'][0]['description'];
        var iconValue = "http://openweathermap.org/img/wn/" + data['daily'][day]['weather'][0]['icon'] +".png";

        document.getElementById("temp").innerHTML = Math.round(tempValue) + " C";
        document.getElementById("desc").innerHTML = descValue.toUpperCase();
        $('#icon').attr('src', iconValue);
    }
    )
}