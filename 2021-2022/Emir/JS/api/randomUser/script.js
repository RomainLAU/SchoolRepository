

window.addEventListener('DOMContentLoaded', function() {

    thumbnail = document.querySelector('#thumbnail')
    infos = document.querySelector('#infos')
    findNewUser = document.querySelector('#newUser')

    infos.style.fontSize = "24px"

    function fetchNewUser() {
        fetch("https://randomuser.me/api/").then(function(response) {
            response.json().then(function(json) {

                let lastname = json['results'][0]['name']['last']
                let firstname = json['results'][0]['name']['first']
                let dateOfBirth = json['results'][0]['dob']['date']
                let gender = json['results'][0]['gender']
                let picture = json['results'][0]['picture']['large']

                thumbnail.style.backgroundImage = "url('" + picture + "')"
                infos.innerText = "Nom : " + lastname + " \nPrénom : " + firstname + " \nDate de naissance : " + dateOfBirth + " \nGenre : " + gender
                
                
            })
        })
    }

    fetchNewUser();

    findNewUser.addEventListener('click', function() {
        
        fetchNewUser();
    })
})