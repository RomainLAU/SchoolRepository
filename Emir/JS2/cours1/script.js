window.addEventListener('DOMContentLoaded', function() {
    let buttonClick = document.querySelector('.buttonClick')

    buttonClick.addEventListener('click', function(event) {
        event.preventDefault()
        console.log(event)
        alert('Hello sir')
    })
})