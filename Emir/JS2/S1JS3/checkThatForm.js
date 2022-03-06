window.addEventListener('DOMContentLoaded', function() {
    let uncompleteForm = document.querySelector('#uncomplete-form')

    let firstForm = document.querySelector('#firstForm')
    let firstname = firstForm['firstname']
    let firstnameError = document.querySelector('#firstname-error')
    let lastname = firstForm['lastname']
    let lastnameError = document.querySelector('#lastname-error')
    let email = firstForm['email']
    let emailError = document.querySelector('#email-error')
    let age = firstForm['age']
    let ageError = document.querySelector('#age-error')
    let bachelor = firstForm['bachelor']
    let bachelorError = document.querySelector('#bachelor-error')
    let password = firstForm['password']
    let checkedPassword = firstForm['checked-password']
    let checkedPasswordError = document.querySelector('#checked-password-error')
    let sexeHomme = document.querySelector('#sexeHomme')
    let sexeFemme = document.querySelector('#sexeFemme')
    let sexeError = document.querySelector('#sexe-error')
    let tome = document.getElementsByName('Tome[]')
    let tomeError = document.querySelector('#tome-error')

    let passwordsMatch = true

    let onlyLetterRegex = /\d/

    let emailRegex = /[^\s@]+@[^\s@]+\.[^\s@]{2,}/

    checkedPassword.addEventListener('input', function() {
        if (checkedPassword.value !== password.value || checkedPassword.value.length === 0) {
            checkedPasswordError.style.display = "block"
            checkedPasswordError.innerHTML = "La vérification du mot de passe n'est pas valide."
            passwordsMatch = false
        } else {
            checkedPasswordError.style.display = "none"
            passwordsMatch = true     
        }
    })

    password.addEventListener('input', function() {
        if (checkedPassword.value !== password.value || password.value.length === 0) {
            passwordsMatch = false
        } else {
            checkedPasswordError.style.display = "none"
            passwordsMatch = true     
        }
    })

    submit.addEventListener('click', function(event) {

        if (passwordsMatch === false) {
            checkedPasswordError.style.display = "block"
            checkedPasswordError.innerHTML = "La vérification du mot de passe n'est pas valide."
            event.preventDefault()
        }

        if (firstname.value.length === 0 || lastname.value.length === 0 || email.value.length === 0  || age.value.length === 0 || bachelor.value.length === 0 || password.value.length === 0 || checkedPassword.value.length === 0 || (!(sexeHomme.checked) && !(sexeFemme.checked))) {
            uncompleteForm.style.display = "block"
            event.preventDefault()
            uncompleteForm.innerHTML = "Le formulaire n'est pas complet"
        } else {
            uncompleteForm.style.display = "none"
        }
        
        if (bachelor.value !== "dev" && bachelor.value !== "business" && bachelor.value !== "design") {
            bachelorError.style.display = "block"
            bachelorError.innerHTML = "Veuillez utiliser le mot 'dev', 'business' ou 'design'"
            event.preventDefault()
        } else {
            bachelorError.style.display = "none"
        }

        if (isNaN(age.value) || age.value.length === 0) {
            ageError.style.display = "block"
            ageError.innerHTML = "Veuillez utiliser des chiffres"
            event.preventDefault()
        } else {
            ageError.style.display = "none"         
        }

        if (firstname.value.match(onlyLetterRegex) || firstname.value.length === 0) {
            firstnameError.style.display = "block"
            firstnameError.innerHTML = "Seules les lettres sont autorisées ici."
            event.preventDefault()
        } else {
            firstnameError.style.display = "none"     
        }

        if (lastname.value.match(onlyLetterRegex) || lastname.value.length === 0) {
            lastnameError.style.display = "block"
            lastnameError.innerHTML = "Seules les lettres sont autorisées ici."
            event.preventDefault()
        } else {
            lastnameError.style.display = "none"          
        }

        if (email.value) {
            if (!(email.value.match(emailRegex))) {
                emailError.style.display = "block"
                emailError.innerHTML = "Veuillez rentrer une adresse mail correcte."
                event.preventDefault()
            } else {
                emailError.style.display = "none"               
            }
        } else if (email.value.length === 0){
            emailError.style.display = "block"
            emailError.innerHTML = "Veuillez rentrer une adresse mail correcte."
            event.preventDefault()
        }

        if (!(sexeHomme.checked) && !(sexeFemme.checked)) {
            sexeError.style.display = "block"
            sexeError.innerHTML = "Veuillez séléctionner un sexe."
            event.preventDefault()
        } else {
            sexeError.style.display = "none"
        }

        let tomeChecked = 0

        for (let index = 0; index < tome.length; index++) {

            if (tome[index].checked) {
                tomeChecked ++
            }

            if (tomeChecked > 0 && tomeChecked <= 2)  {
                tomeError.style.display = "none"
            } else {
                tomeError.style.display = "block"
                tomeError.innerHTML = "Veuillez séléctionner entre 1 et 2 tomes au maximum."
                event.preventDefault()
            }
        }
    })
})