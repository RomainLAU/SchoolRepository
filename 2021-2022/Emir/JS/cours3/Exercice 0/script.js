// On récupère les boutons

let hideDesc = document.querySelector('#hideDesc')

let showWomen = document.querySelector('#showWomen')

let showMen = document.querySelector('#showMen')

let showAll = document.querySelector('#showAll')

// On récuprère les images

let image1 = document.querySelector('#img1')

let image2 = document.querySelector('#img2')

let image3 = document.querySelector('#img3')

let image4 = document.querySelector('#img4')

// On récupère la div de l'épée et on stock l'url de toutes les images

let epee = document.querySelector('#epee')

let epees = [
    "url('https://pngimage.net/wp-content/uploads/2018/05/%C3%A9p%C3%A9e-diamant-minecraft-png-4.png')",
    "url('https://mlyazqwnm7ri.i.optimole.com/g70rCmE.u6Mz~2151a/w:auto/h:auto/q:90/id:6769a00e81e4bae92a8aabbc7d222f01/https://espadasymas.com/uc3336_united_cutlery_messer_m48_talon_dagger5qXW3GomxyHho_600x600.jpg')",
    "url('https://media.ldlc.com/r1600/mkp/55e9bc8324b84dafbaaf3034677989c4.jpeg')",
    "url('https://www.sword-wholesale.com/v/vspfiles/photos/FP-4850-3.jpg?v-cache=1493127717')"
]

// On récupère la div de description

let desc = document.querySelector('#description')

// On récupère les classes de genre des images

let men = document.querySelectorAll('.men')

let women = document.querySelectorAll('.women')

// On fusionne les 2 classes dans une commune pour appliquer des changements à ces dernières

let bothGenders = []

bothGenders.push.apply(bothGenders, men)
bothGenders.push.apply(bothGenders, women)

// On change la description lorsqu'on clique sur une image

image1.addEventListener("click", function () {
    desc.innerText = "Elle est trop bg"
})

image2.addEventListener("click", function () {
    desc.innerText = "Il est trop beau"
})

image3.addEventListener("click", function () {
    desc.innerText = "Il est trop bg"
})

image4.addEventListener("click", function () {
    desc.innerText = "Elle est trop belle"
})

// On cache la description quand on appuie sur ce bouton

hideDesc.addEventListener("click", function () {
    desc.innerText = " "
})

// On cache les images des hommes et on montre celle des femmes

showWomen.addEventListener("click", function () {
    men.forEach ((image, images) => {
        image.style.display = 'none';
    })
    women.forEach ((image, images) => {
        image.style.display = 'block';
    })
})

// On cache les images des femmes et on montre celle des hommes

showMen.addEventListener("click", function () {
    men.forEach ((image, images) => {
        image.style.display = 'block';
    })
    women.forEach ((image, images) => {
        image.style.display = 'none';
    })
})

// On montre toutes les images

showAll.addEventListener("click", function () {
    bothGenders.forEach ((image, images) => {
        image.style.display = 'block';
    })
})

// Animation de l'arme

function slide () {
    setTimeout(function () {
        epee.style.transform = "translateX(80vw)"
    }, 2000)
}

setInterval (function () {
    slide()
}, 4000)

epee.style.backgroundImage = epees[0]

// image1.addEventListener("hover", function () {
//     image1.style.backgroundImage = "url('https://pngimage.net/wp-content/uploads/2018/05/%C3%A9p%C3%A9e-diamant-minecraft-png-4.png')"
// })


// let myInputColor = document.querySelector('#inputColor')

// myInputColor.addEventListener('input', function() {

//     let body = document.querySelector('body')

//     body.style.backgroundColor = myInputColor.value
// })