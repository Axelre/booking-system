var button = document.querySelector('.button')
var name = document.querySelector('.name');
var desc = document.querySelector('.desc');
var temp = document.querySelector('.temp');

button.addEventListener('click', function()
{
    fetch('https://api.openweathermap.org/data/2.5/onecall?lat=59.8586&lon=17.6389&units=metric&appid=8704ed9bc9d4d04fcfe7d10ced95aead')
    .then(response => response.json())
    .then(data => console.log(data))

    .catch(err => alert("Wrong"))
})

function test()
{
    alert("test");
}