window.addEventListener("DOMContentLoaded", function () {

    let messages = document.querySelector('#messages')

    let disconnectButton = document.querySelector('#disconnect')
    let messageInput = document.querySelector('#message')
    let sendButton = document.querySelector('#send')
    let blacklistButton = document.querySelector('#blacklist')

    let ignoredUsers = document.querySelector('#ignoredUsers')

    let identificationForm = document.querySelector('#identificationForm')

    let sendingInputs = document.querySelector('#sendingInputs')

    sendingInputs.style.display = "none"

    if (!localStorage.getItem("blacklist")) {

        ignoreUser("nobody")
    }

    function ignoreUser(user) {

        if (localStorage.getItem("blacklist")) {

            localStorage.setItem("blacklist", localStorage.getItem("blacklist") + ', ' + user)
                
        } else {

            localStorage.setItem("blacklist", user)
        }

        clearMessages()
        showAllMessages(localStorage.getItem("token"))
    }

    function isSetToken() {

        showAllMessages(localStorage.getItem("token"))

        if (localStorage.getItem("token")) {
    
            setInterval( function () {
                showNewMessages(localStorage.getItem("token"))
            }, 5000)
    
        } else {
            showIdentifyPage()
        }
    }

    isSetToken()

    disconnectButton.addEventListener("click", function() {

        localStorage.clear("token")
        clearMessages()
        showIdentifyPage()
        localStorage.setItem('lastMessageID', 0)
        isSetToken()
    })

    function clearMessages() {

        while(messages.firstChild){

            messages.removeChild(messages.firstChild)

        }

        sendingInputs.style.display = "none"
    }

    function createMessage(name, message, sendTime, id) {

        let nameRegex = /^((\*)|([a-zA-Z0-9]+)\.(.+)*\*?)$/

        let goodName = name.match(nameRegex)

        let goodLookingName = ''

        if (goodName) {
            goodLookingName = goodName[3] + ' ' + goodName[4]
        }


        let messageLi = document.createElement('li')
        messageLi.setAttribute("class", "message")
        messageLi.setAttribute("id", "message" + id)
        messages.appendChild(messageLi)

        let nicknameDiv = document.createElement('div')
        nicknameDiv.setAttribute("id", "senderName")
        nicknameDiv.textContent = goodLookingName

        let messageDiv = document.createElement('div')
        messageDiv.setAttribute("id", "messageContent")
        messageDiv.textContent = message

        let sendTimeDiv = document.createElement('div')
        sendTimeDiv.setAttribute("id", "sendTime")

        if (name == localStorage.getItem('user')) {

            let deleteButton = document.createElement('button')
            deleteButton.setAttribute("class", "delete")
            deleteButton.setAttribute("onclick", 'deleteMessage(' + id + ')')
            deleteButton.onclick = function() {
                deleteMessage(id)
            }

            deleteButton.textContent = 'Delete'

            let updateButton = document.createElement('button')
            updateButton.setAttribute("class", "update")
            updateButton.setAttribute("onclick", 'getContentOfMessage(' + id + ')')
            updateButton.onclick = function() {
                getContentOfMessage(id)
            }

            updateButton.textContent = "Update"

            messageLi.appendChild(deleteButton)
            messageLi.appendChild(updateButton)
        }

        if (name !== localStorage.getItem('user')) {

            let ignoreButton = document.createElement('button')
            ignoreButton.setAttribute("class", "ignore")
            ignoreButton.setAttribute("onclick", 'ignoreUser(' + name + ')')
            ignoreButton.onclick = function() {
                ignoreUser(name)
            }

            ignoreButton.textContent = "Ignore"

            messageLi.appendChild(ignoreButton)
        }

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
            identificationForm.removeChild(identificationForm.firstChild)
        }

        while(messages.firstChild){
            messages.removeChild(messages.firstChild)
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
        submitButton.setAttribute('value', 'Connect')
        submitButton.setAttribute('id', 'submitForm')
        identificationForm.appendChild(submitButton)


        submitButton.addEventListener('click', function () {
            getToken(emailInput.value, passwordInput.value)
        })

        passwordInput.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {

                getToken(emailInput.value, passwordInput.value)
            }
        })
    }

    function getToken(emailSent, passwordSent) {
        
        fetch("https://api.edu.etherial.dev/apijsv2/auth", {
            method: 'POST',
            body: JSON.stringify({
                email: emailSent,
                password: passwordSent
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

            let newToken = data['data']['token']

            localStorage.setItem("token", newToken)

            getUsername()

            showAllMessages(localStorage.getItem("token"))

        }).catch(function (error) {
            console.warn('Something went wrong.', error)
        })
    }

    function showAllMessages(token) {

        if (token) {

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
                
                while (identificationForm.firstChild) {

                    identificationForm.removeChild(identificationForm.firstChild)
                    
                }

                if (localStorage.getItem("blacklist")) {
                    let localBlacklist = localStorage.getItem("blacklist").split(',')
                }
        
                data['data'].slice(0).reverse().map(function(value, index) {

                    if (localBlacklist.includes(value['nickname']) === false) {

                        localStorage.setItem('lastMessageID', value['id'])

                        createMessage(value['nickname'], value['message'], value['createdAt'], value['id'])

                        window.scrollTo(0,document.body.scrollHeight)
                    }
        
                })
            }).catch(function (error) {
                console.warn('Something went wrong.', error)
            })
        }
    }

    function showNewMessages(token) {

        if (token) {

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
                
                while (identificationForm.firstChild) {

                    identificationForm.removeChild(identificationForm.firstChild)
                    
                }

                localBlacklist = localStorage.getItem("blacklist").split(',')
        
                data['data'].slice(0).reverse().map(function (value, index) {

                    if (localBlacklist.includes(value['nickname']) === false) {

                        if (localStorage.getItem('lastMessageID') && value['id'] > localStorage.getItem('lastMessageID')) {

                            localStorage.setItem('lastMessageID', value['id'])
    
                            createMessage(value['nickname'], value['message'], value['createdAt'], value['id'])
    
                            window.scrollTo(0,document.body.scrollHeight)
    
                        }
                    }
                })
            }).catch(function (error) {
                console.warn('Something went wrong.', error)
            })
        }
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
                localStorage.setItem("lastMessage", data['data']['id'])

            }).catch(function (error) {
                console.warn('Something went wrong.', error)
            })
        }
        
        messageInput.value = ''
        
        showNewMessages(localStorage.getItem("token"))
        showNewMessages(localStorage.getItem("token"))
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

            let currentUser = data['data']['nickname']

            localStorage.setItem("user", currentUser)

        }).catch(function (error) {
            console.warn('Something went wrong.', error)
        })
    }

    function deleteMessage(thisMessage) {

        fetch("https://api.edu.etherial.dev/apijsv2/messages/" + thisMessage, {
            method: 'DELETE',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem("token"),
                'Content-type': 'application/json; charset=UTF-8'
            }
        }).then(function (response) {
            if (response.of) {
                return response.json()
            }
            return Promise.reject(response)
        }).then(function (data) {

            console.log(data)

        }).catch(function (error) {
            console.warn('Something went wrong.', error)
        })

        let messageToDelete = document.querySelector('#message' + thisMessage)
        messages.removeChild(messageToDelete)
    }

    function getContentOfMessage(thisMessage) {
        let currentMessage = document.querySelector('#message' + thisMessage)

        let contentOfCurrentMessage = currentMessage.childNodes[3]

        let textOfCurrentMessage = currentMessage.childNodes[3].textContent

        contentOfCurrentMessage.remove()

        let inputEditMessage = document.createElement('input')
        inputEditMessage.setAttribute("type", "text")
        inputEditMessage.setAttribute("id", "editInput")
        inputEditMessage.setAttribute("value", textOfCurrentMessage)

        console.log(textOfCurrentMessage)

        currentMessage.appendChild(inputEditMessage)

        inputEditMessage.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                let newMessage = inputEditMessage.value

                console.log(newMessage)

                event.preventDefault()
                updateMessage(newMessage, thisMessage)

                currentMessage.removeChild(inputEditMessage)

                let messageDiv = document.createElement('div')
                messageDiv.setAttribute("id", "messageContent")
                messageDiv.textContent = newMessage

                currentMessage.appendChild(messageDiv)
            }
        })
    }

    function updateMessage(newMessage, thisMessage) {

        fetch("https://api.edu.etherial.dev/apijsv2/messages/" + thisMessage, {
            method: 'PUT',
            body: JSON.stringify({
                message: newMessage
            }),
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem("token"),
                'Content-type': 'application/json; charset=UTF-8'
            }
        }).then(function (response) {
            if (response.of) {
                return response.json()
            }
            return Promise.reject(response)
        }).then(function (data) {

            console.log(data)

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

    function showBlacklist() {

        ignoredUsers.style.display = "block"

        console.log(localStorage.getItem("blacklist"))

        if (localStorage.getItem("blacklist") !== "" || localStorage.getItem("blacklist") !== '{}' || localStorage.getItem("blacklist") !== {} || localStorage.getItem("blacklist").length !== 0) {

            localBlacklist = localStorage.getItem("blacklist").split(',')

            localBlacklist.map(function(ignoredUser, index) {

                let user = document.createElement('li')
                user.textContent = ignoredUser

                ignoredUsers.appendChild(user)
            })
        }
    }

    function clearBlacklist() {

        ignoredUsers.style.display = "none"

        while(ignoredUsers.firstChild){

            ignoredUsers.removeChild(ignoredUsers.firstChild)

        }
    }

    let blacklistShowed = false

    if (blacklistShowed === false) {
        ignoredUsers.style.display = "none"
    }

    blacklistButton.addEventListener("click", function() {

        if (blacklistShowed === false) {

            clearMessages()
            sendingInputs.style.display = "flex"
            showBlacklist()
            blacklistShowed = true

            blacklistButton.setAttribute("value", "Hide Blacklist")

        } else {

            clearBlacklist()

            showAllMessages(localStorage.getItem("token"))

            blacklistShowed = false

            blacklistButton.setAttribute("value", "Show Blacklist")
        }
    })
})