window.addEventListener('DOMContentLoaded', async () => {

    let bg = document.querySelector('body')
    let messages = [
        {
            id: 1,
            nickname: "romain",
            message: "yoo"
        },
        {
            id: 2,
            nickname: "tiphaine",
            message: "mangeeer"
        }
    ]

    await messages.forEach(({ id, nickname}, index) => {
        // alert(nickname)

        Swal.fire({
            title: 'WOW',
            text: 'You\'re the user ' + id + ' !!',
            icon: 'info',
            confirmButtonText: "nice !" + addEventListener('click', () => {
                bg.style.backgroundColor = "black"
            })
        })
    }).then( () => {
        bg.style.backgroundColor = "white"
    })
})