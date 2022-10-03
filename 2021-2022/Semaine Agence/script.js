let firstRound = document.querySelector('.first-round')
let secondRound = document.querySelector('.second-round')
let thirdRound = document.querySelector('.third-round')
let fourthRound = document.querySelector('.fourth-round')

let carrousselBackground = document.querySelector('#carroussel')

let backgroundImages = ['assets/img/FX-Mirror-01.png', 'assets/img/background-2.png', 'assets/img/background-3.jpg']

let rounds = [firstRound, secondRound, thirdRound]

let index = 1

setInterval(function () {

    if (index === 2) {

        carrousselBackground.style.backgroundPosition = "0px 0px"

    } else {

        carrousselBackground.style.backgroundPosition = "0px -200px"

    }

    let image = backgroundImages[index]

    let round = rounds[index]
    
    let previousRound = rounds[index-1]

    if (image) {

        if (!previousRound) {

            thirdRound.style.backgroundColor = "rgba(0, 0, 0, 0)"

        } else {

            carrousselBackground.style.backgroundImage = "url('" + image + "')"

            round.style.backgroundColor = "#ED1B2D"
    
            previousRound.style.backgroundColor = "rgba(0, 0, 0, 0)"

        }

        index++

    } else {

        index = 0

        carrousselBackground.style.backgroundImage = "url('" + backgroundImages[0] + "')"

        firstRound.style.backgroundColor = "#ED1B2D"
        thirdRound.style.backgroundColor = "rgba(0, 0, 0, 0)"
    }

}, 3000 )