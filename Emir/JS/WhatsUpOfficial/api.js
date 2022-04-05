export function getToken(emailSent, passwordSent) {

    return new Promise((callback, reject) => {
        
        fetch("https://api.edu.etherial.dev/apijsv2/auth", {
            method: 'POST',
            body: JSON.stringify({
                email: emailSent,
                password: passwordSent
            }),
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        }).then((response) => {
            if (response.ok) {
                return response.json()
            }
            reject(response)
        }).then((data) => {

            callback(data)

        }).catch((error) => {
            reject(error)
            console.warn('Something went wrong.', error)
        })
    })
}

export function getUsername() {

    fetch("https://api.edu.etherial.dev/apijsv2/users/me", {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem("token"),
            'Content-type': 'application/json; charset=UTF-8'
        }
    }).then((response) => {
        if (response.ok) {
            return response.json()
        }
        return Promise.reject(response)
    }).then((data) => {

        localStorage.setItem("user", data.data.nickname)

    }).catch((error) => {
        console.warn('Something went wrong.', error)
    })
}

export function getAllMessages() {

    return new Promise((callback) => {

        fetch("https://api.edu.etherial.dev/apijsv2/messages", {
            method: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
                'Authorization': 'Bearer ' + localStorage.getItem("token")
            }
        }).then((response) => {
            if (response.ok) {
                return response.json()
            }
            return Promise.reject(response)
        }).then((data) => {

            callback(data.data)

        }).catch((error) => {
            console.warn('Something went wrong.', error)
        })
    })
}

export function postMessage(message) {

    return new Promise((callback) => {

        fetch("https://api.edu.etherial.dev/apijsv2/messages", {
            method: 'POST',
            body: JSON.stringify({
                message: message
            }),
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
                'authorization': 'Bearer ' + localStorage.getItem("token")
            }
        }).then((response) => {
            if (response.ok) {
                return response.json()
            }
            return Promise.reject(response)
        }).then((data) => {
    
            localStorage.setItem("lastMessage", data.data.id)
            callback(data)
    
        }).catch((error) => {
            console.warn('Something went wrong.', error)
        })
    })
}

export function deleteMessageFromAPI(message) {

    fetch("https://api.edu.etherial.dev/apijsv2/messages/" + message, {
        method: 'DELETE',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem("token"),
            'Content-type': 'application/json; charset=UTF-8'
        }
    }).then((response) => {
        if (response.of) {
            return response.json()
        }
        return Promise.reject(response)
    }).catch((error) => {
        console.warn('Something went wrong.', error)
    })

}

export function updateMessage(newMessage, message) {

    fetch("https://api.edu.etherial.dev/apijsv2/messages/" + message, {
        method: 'PUT',
        body: JSON.stringify({
            message: newMessage
        }),
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem("token"),
            'Content-type': 'application/json; charset=UTF-8'
        }
    }).then((response) => {
        if (response.of) {
            return response.json()
        }
        return Promise.reject(response)
    }).catch((error) => {
        console.warn('Something went wrong.', error)
    })
}