window.addEventListener("DOMContentLoaded", function () {

    let messages = document.querySelector('#messages')

    let disconnectButton = document.querySelector('#disconnect')
    let messageInput = document.querySelector('#message')
    let sendButton = document.querySelector('#send')

    let identificationForm = document.querySelector('#identificationForm')

    let sendingInputs = document.querySelector('#sendingInputs')

    let lastMessageID = 0

    sendingInputs.style.display = "none"

    if (localStorage.getItem("token")) {
        showMessages(localStorage.getItem("token"))

        setInterval( function () {
            showMessages(localStorage.getItem("token"))
        }, 5000)

    } else {
        showIdentifyPage()
    }

    disconnectButton.addEventListener("click", function() {
        localStorage.clear()
        clearMessages()
        showIdentifyPage()
    })

    function clearMessages() {

        while(messages.firstChild){

            messages.removeChild(messages.firstChild)

        }

        sendingInputs.style.display = "none"
    }

    function createMessage(name, message, sendTime) {

        let nameRegex = /^((\*)|([a-zA-Z0-9]+)\.(.+)*\*?)$/

        let goodName = name.match(nameRegex)

        let goodLookingName = ''

        if (goodName) {
            goodLookingName = goodName[3] + ' ' + goodName[4]
        }

        let messageLi = document.createElement('li')
        messageLi.setAttribute("class", "message")
        messageLi.setAttribute("id", goodLookingName)
        messages.appendChild(messageLi)

        let nicknameDiv = document.createElement('div')
        nicknameDiv.setAttribute("id", "senderName")
        nicknameDiv.textContent = goodLookingName

        let messageDiv = document.createElement('div')
        messageDiv.setAttribute("id", "messageContent")
        messageDiv.textContent = message

        let sendTimeDiv = document.createElement('div')
        sendTimeDiv.setAttribute("id", "sendTime")

        sendTime = sendTime.slice(11, 16)

        sendTimeDiv.textContent = sendTime

        messageLi.appendChild(nicknameDiv)
        messageLi.appendChild(messageDiv)
        messageLi.appendChild(sendTimeDiv)

        if (name === localStorage.getItem('user')) {
            messageLi.style.alignSelf = "flex-end"
            messageLi.style.direction = "ltr"
            messageLi.style.backgroundColor = "rgb(195, 255, 177)"
    
            messageDiv.style.direction = "ltr"

            nicknameDiv.style.display = "none"
        }
    }



    function showIdentifyPage() {

        while(identificationForm.firstChild){
            identificationForm.removeChild(identificationForm.firstChild);
        }
        
        let emailInput = document.createElement('input')

        emailInput.setAttribute('type', 'text')
        emailInput.setAttribute('id', 'emailEmail')
        emailInput.setAttribute('placeholder', 'email')
        emailInput.setAttribute('autocomplete', 'username')
        identificationForm.appendChild(emailInput)


        let passwordInput = document.createElement('input')

        passwordInput.setAttribute('type', 'password')
        passwordInput.setAttribute('id', 'passwordAccount')
        passwordInput.setAttribute('placeholder', 'password')
        passwordInput.setAttribute('autocomplete', 'current-password')
        identificationForm.appendChild(passwordInput)


        let submitButton = document.createElement('input')

        submitButton.setAttribute('type', 'button')
        submitButton.setAttribute('value', 'connect')
        submitButton.setAttribute('id', 'submitForm')
        identificationForm.appendChild(submitButton)


        submitButton.addEventListener('click', function () {
            getToken(emailInput.value, passwordInput.value)
        })
    }

    function getToken(email, password) {
        
        fetch("https://api.edu.etherial.dev/apijsv2/auth", {
            method: 'POST',
            body: JSON.stringify({
                email: email,
                password: password
            }),
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        }).then(function (response) {
            if (response.ok) {
                return response.json()
            }
            return Promise.reject(response)
        }).then(function (data) {

            const newToken = data['data']['token']

            localStorage.setItem("token", newToken)

            getUsername()

            showMessages(localStorage.getItem("token"))

        }).catch(function (error) {
            console.warn('Something went wrong.', error)
        })
    }

    function showMessages(token) {
        
        fetch("https://api.edu.etherial.dev/apijsv2/messages", {
            method: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
                'Authorization': 'Bearer ' + token
            }
        }).then(function (response) {
            if (response.ok) {
                return response.json()
            }
            return Promise.reject(response)
        }).then(function (data) {

            sendingInputs.style.display = "flex"
            
            while(identificationForm.firstChild){

                identificationForm.removeChild(identificationForm.firstChild)
                
            }
    
            data['data'].slice(0).reverse().map(function (value, index) {
    
                if (value['id'] > lastMessageID) {

                    lastMessageID = value['id']
                    createMessage(value['nickname'], value['message'], value['createdAt'])
                    window.scrollTo(0,document.body.scrollHeight)

                }
            })
        }).catch(function (error) {
            console.warn('Something went wrong.', error)
        })

    }

    function sendMessage() {
        if (messageInput.value.length !== 0 && messageInput.value !== null && messageInput.value !== ' ' && messageInput.value !== '\n') {
            fetch("https://api.edu.etherial.dev/apijsv2/messages", {
                method: 'POST',
                body: JSON.stringify({
                    message: messageInput.value
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8',
                    'authorization': 'Bearer ' + localStorage.getItem("token")
                }
            }).then(function (response) {
                if (response.ok) {
                    return response.json()
                }
                return Promise.reject(response)
            }).then(function (data) {
                console.log(data)
            }).catch(function (error) {
                console.warn('Something went wrong.', error)
            })
        }
        
        messageInput.value = ''

        
        showMessages(localStorage.getItem("token"))
        showMessages(localStorage.getItem("token"))
    }

    function getUsername() {

        fetch("https://api.edu.etherial.dev/apijsv2/users/me", {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem("token"),
                'Content-type': 'application/json; charset=UTF-8'
            }
        }).then(function (response) {
            if (response.ok) {
                return response.json()
            }
            return Promise.reject(response)
        }).then(function (data) {

            currentUser = data['data']['nickname']

            localStorage.setItem("user", currentUser)

        }).catch(function (error) {
            console.warn('Something went wrong.', error)
        })
    }

    sendButton.addEventListener("click", function() {
        sendMessage()
    })

    messageInput.addEventListener('keydown', function(event) {
        if (event.keyCode === 13 || event.key === 'Enter') {
            event.preventDefault()
            sendMessage()
        }
    })

    messageInput.addEventListener('keyup', function(event) {
        if (event.keyCode === 13 || event.key === 'Enter') {
            event.preventDefault()
            sendMessage()
        }
    })
})