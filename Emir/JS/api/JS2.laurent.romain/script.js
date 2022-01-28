window.addEventListener('DOMContentLoaded', function () 
{

    let localisationDOM = document.querySelector('#localisation')
    let availableVelibsBarDOM = document.querySelector('#available-velibs-bar')
    let availableVelibsDOM = document.querySelector('#available-velibs')
    let velibsStationDOM = document.querySelector('#available-velibs-station')
    let eVelibsDOM = document.querySelector('#e-velibs')
    let mechaVelibsDOM = document.querySelector('#mecha-velibs')

    fetch('https://opendata.paris.fr/api/records/1.0/search/?dataset=velib-disponibilite-en-temps-reel&q=stationcode=11105&facet=station_state&facet=kioskstate&facet=creditcard&facet=overflowactivation').then(function (response) 
    {
        response.json().then(function (json) 
        {
            console.log(json)

            let localisation = json['records'][0]['fields']['name']
            let availableVelibs = json['records'][0]['fields']['numbikesavailable']
            let velibsStation = json['records'][0]['fields']['capacity']
            let eVelibs = json['records'][0]['fields']['ebike']
            let mechaVelibs = json['records'][0]['fields']['mechanical']
            let availableVelibsBar = (availableVelibs/velibsStation)*100 + "%"
            let mapCoordinates = json['records'][0]['geometry']['coordinates']

            localisationDOM.innerHTML = localisation
            availableVelibsDOM.innerHTML = "Il y a actuellement : " + availableVelibs + " velib(s) disponibles <br><br>"
            velibsStationDOM.innerHTML = "Il y a " + velibsStation + " stations au total <br><br>"

            if (availableVelibs === 0) {
                eVelibsDOM.innerHTML = "Il n'y a pas de eVelib <br><br>"
                mechaVelibsDOM.innerHTML = "Il n'y a pas de Velib mécanique <br><br>"
            } else {
                eVelibsDOM.innerHTML = "Il y a " + eVelibs + " (" + ((eVelibs/availableVelibs)*100).toFixed(1) + "%) eVelibs disponibles <br><br>"
                mechaVelibsDOM.innerHTML = "Il y a " + mechaVelibs + " (" + ((mechaVelibs/availableVelibs)*100).toFixed(1) + "%) Velibs mécaniques disponibles <br><br>"
            }
            availableVelibsBarDOM.style.width = availableVelibsBar

            if (velibsStation*0.3 > availableVelibs) {
                availableVelibsDOM.style.color = "red"
            } else {
                availableVelibsDOM.style.color = "green"
            }

            let map = L.map('map').setView([mapCoordinates[1], mapCoordinates[0]], 12)

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map)

            var Icon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
              });
              
              L.marker([mapCoordinates[1], mapCoordinates[0]], {icon: Icon}).addTo(map);
        })
    })
})