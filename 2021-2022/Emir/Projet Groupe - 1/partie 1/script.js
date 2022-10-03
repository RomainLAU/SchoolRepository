let pwd = document.querySelector("#pwd")

let ensemble = document.querySelector("#ensemble")

pwd.addEventListener("input", function() {
    console.log(pwd.value)

    if (pwd.value == 'mdp145')
    {
        alert('Bienvenue')

        ensemble.style.marginTop = "-1100px"
    }
})

/*
pwd.addEventListener('click', function()
{
    let pwd = document.querySelector("#pwd").value

    if (pwd == 'glp248s4')
    {
        window.alert('Bienvenue')
    }
})

*/
