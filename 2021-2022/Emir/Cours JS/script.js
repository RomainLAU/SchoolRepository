let body = document.querySelector("body")

let images = [
    "https://i-df.unimedias.fr/2019/07/08/barbecue-regles_de_securite.jpg?auto=format%2Ccompress&crop=faces&cs=tinysrgb&fit=crop&h=675&w=1200",
    "https://www.senya.fr/wp-content/uploads/2021/02/SYCK-G045_Barbecue_2_en_1-Barbecue-Party-02-center.jpg",
    "https://img.20mn.fr/_DU58ljKTTC0igGNFEsc4g/768x492_faut-toujours-renseigner-avant-lancer-barbecue.jpg",
    "http://www.prevention-incendie-foret.com/wp-content/uploads/thumbnail-barbecue.jpg"
]
let index = 0

body.style.height = "400px"
body.style.width = "400px"

setInterval(function () {

    let image = images[index]

    if (image) {
        body.style.backgroundImage = "url('" + image + "')"

        index++;
    } else {
        index = 0
        body.style.backgroundImage = images[0]

    }

}, 2000 )