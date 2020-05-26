function setup()
{
    loadJSON("https://api.openweathermap.org/data/2.5/onecall?lat=59.8586&lon=17.6389&units=metric&appid=8704ed9bc9d4d04fcfe7d10ced95aead");

    function gotData(data)
    {
        weather = data;
    }

    weather.current.temp
}