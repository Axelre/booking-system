var button = document.querySelector('.button')
var name = document.querySelector('.name');
var desc = document.querySelector('.desc');
var temp = document.querySelector('.temp');

function getWeather()
{
    fetch('https://api.openweathermap.org/data/2.5/onecall?lat=59.8586&lon=17.6389&units=metric&appid=8704ed9bc9d4d04fcfe7d10ced95aead')
    .then(response => response.json())
    .then(data =>
    {
        var tempValue = data['daily'][2]['temp']['day'];
        var descValue = data['current']['weather'][0]['description'];
        var nameValue = "Uppsala";

        name = nameValue;
        desc = descValue;
        temp = tempValue;

        alert(temp);
    }
    )
}