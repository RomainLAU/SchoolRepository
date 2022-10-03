document.addEventListener('DOMContentLoaded', () => {

    function getAllMessages() {
        fetch('http://instawish.localhost/tasks', {
            method: 'GET',
        }).then((response) => {
            response.json().then((json) => {
                console.log(json.data)
                return json.data
            })
        })
    }

    function displayAllMessages() {
        console.log(getAllMessages())
    }

    getAllMessages()
}) 
