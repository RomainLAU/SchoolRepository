import { getToken, getUsername, getAllMessages, postMessage, deleteMessageFromAPI, updateMessage } from "./api.js"

window.addEventListener("DOMContentLoaded", function () {

    let messages = document.querySelector('#messages')

    let disconnectButton = document.querySelector('#disconnect')
    let messageInput = document.querySelector('#message')
    let sendButton = document.querySelector('#send')
    let blacklistButton = document.querySelector('#blacklist')

    let ignoredUsers = document.querySelector('#ignoredUsers')

    let identificationForm = document.querySelector('#identificationForm')
    let loginError = document.querySelector('#loginError')

    let sendingInputs = document.querySelector('#sendingInputs')

    sendingInputs.style.display = "none"

    if (typeof localStorage.getItem("token") !== 'undefined' && !localStorage.getItem("blacklist")) {

        ignoreUser("initialize")
    }

    function ignoreUser(user) {

        if (localStorage.getItem("blacklist")) {

            if (localStorage.getItem("blacklist").length == 1) {

                localStorage.setItem("blacklist", user)

            } else if (!localStorage.getItem("blacklist").includes(user) && localStorage.getItem("blacklist").length > 0) {

                localStorage.setItem("blacklist", localStorage.getItem("blacklist") + ', ' + user)
            }
                
        } else {

            localStorage.setItem("blacklist", " ")
        }

        clearMessages()
        showMessages()
    }

    function removeIgnoredUser(user) {

        if (localStorage.getItem('blacklist') && localStorage.getItem('blacklist').length > 1) {

            let blacklist = (localStorage.getItem('blacklist')).split(',')

            blacklist.splice(blacklist.indexOf(user), 1)

            localStorage.setItem('blacklist', blacklist)



        }
    }

    function isSetToken() {

        if (typeof localStorage.getItem("token") !== undefined && localStorage.getItem("token") !== null) {

            return true
    
        }
    }

    let timerNewMessages

    if (isSetToken()) {

        showMessages()

        timerNewMessages = setInterval(() => showNewMessages(), 5000)

    } else {

        showIdentificationPage()
    }
    
    disconnectButton.addEventListener("click", () => {

        localStorage.removeItem("token")
        localStorage.removeItem("user")
        clearMessages()
        localStorage.setItem('lastMessageID', 0)
        showIdentificationPage()
        clearInterval(timerNewMessages)
    })

    function clearMessages() {

        while(messages.firstChild) {

            messages.removeChild(messages.firstChild)

        }

        sendingInputs.style.display = "none"
    }

    function createMessage(name, message, sendTime, id) {

        let nameRegex = /^((\*)|([a-zA-Z0-9]+)\.(.+)*\*?)$/

        let goodName = name.match(nameRegex)

        name = name.replace(/\./g, '\.')

        let goodLookingName = ''

        if (goodName) {
            goodLookingName = goodName[3] + ' ' + goodName[4]
        }


        let messageLi = document.createElement('li')
        messageLi.setAttribute("class", "message " + name)
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
            updateButton.onclick = () => {
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
            ignoreButton.onclick = () => {
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

    function showIdentificationPage() {

        while(messages.firstChild) {
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
            login(emailInput.value, passwordInput.value)
        })

        passwordInput.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {

                login(emailInput.value, passwordInput.value)
            }
        })
    }

    function login(emailSent, passwordSent) {

        getToken(emailSent, passwordSent).then((data) => {

            localStorage.setItem("token", data.data.token)

            removeIdentificationScreen()

            getUsername()

            showMessages()

            loginError.style.display = "none"

        }).catch(() => {
            displayLoginError()
        })

    }

    function displayLoginError() {

        loginError.style.display = "block"
    }

    function removeIdentificationScreen() {

        while (identificationForm.firstChild) {

            identificationForm.removeChild(identificationForm.firstChild)
            
        }
    }

    function getBlacklistContent() {

        if (typeof localStorage.getItem("blacklist") !== 'undefined') {
            return localStorage.getItem("blacklist").split(',')
        }
    }

    function sortMessagesByBlacklist(data) {

        return data.slice(0).reverse().filter(message => getBlacklistContent().includes(message.nickname) === false)
    }

    function showFilteredMessages(data) {

        sortMessagesByBlacklist(data).map((value, index) => {

            localStorage.setItem('lastMessageID', value.id)

            createMessage(value.nickname, value.message, value.createdAt, value.id)

            window.scrollTo(0,document.body.scrollHeight)

        })
    }

    function showAllMessages(data) {

        data.slice(0).reverse().map((value, index) => {

            localStorage.setItem('lastMessageID', value.id)

            createMessage(value.nickname, value.message, value.createdAt, value.id)

            window.scrollTo(0,document.body.scrollHeight)

        })
    }

    function showChatInputs() {

        sendingInputs.style.display = "flex"
    }

    function showMessages() {

        showChatInputs()

        if (typeof localStorage.getItem("blacklist") !== 'undefined') {

            getAllMessages(localStorage.getItem("token")).then((data) => {
                showFilteredMessages(data)
            })

        } else {

            getAllMessages(localStorage.getItem("token")).then((data) => {
                showAllMessages(data)
            })
        }
    }

    function showNewMessages() {

        if (typeof localStorage.getItem("blacklist") !== undefined) {

            getAllMessages(localStorage.getItem("token")).then((data) => {
                sortMessagesByBlacklist(data).forEach(value => {

                    if (localStorage.getItem('lastMessageID') && value.id > localStorage.getItem('lastMessageID')) {

                        localStorage.setItem('lastMessageID', value.id)

                        createMessage(value.nickname, value.message, value.createdAt, value.id)

                        window.scrollTo(0,document.body.scrollHeight)

                    }
                })
            })

        } else {

            getAllMessages(localStorage.getItem("token")).then((data) => {

                data.forEach(value => {

                    if (localStorage.getItem('lastMessageID') && value.id > localStorage.getItem('lastMessageID')) {

                        localStorage.setItem('lastMessageID', value.id)

                        createMessage(value.nickname, value.message, value.createdAt, value.id)

                        window.scrollTo(0,document.body.scrollHeight)

                    }
                })
            })
        }
    }

    function sendMessage() {
        if (messageInput.value.length !== 0) {
            postMessage(messageInput.value).then(() => {
                showNewMessages(localStorage.getItem("token"))
            })
        }
        
        messageInput.value = ''
    }



    function deleteMessage(message) {

        deleteMessageFromAPI(message)

        const messageToDelete = document.querySelector('#message' + message)
        messages.removeChild(messageToDelete)
    }

    function getContentOfMessage(message) {
        let currentMessage = document.querySelector('#message' + message)

        let contentOfCurrentMessage = currentMessage.childNodes[3]

        let textOfCurrentMessage = currentMessage.childNodes[3].textContent

        contentOfCurrentMessage.remove()

        let inputEditMessage = document.createElement('input')
        inputEditMessage.setAttribute("type", "text")
        inputEditMessage.setAttribute("id", "editInput")
        inputEditMessage.setAttribute("value", textOfCurrentMessage)

        currentMessage.appendChild(inputEditMessage)

        inputEditMessage.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                let newMessage = inputEditMessage.value

                event.preventDefault()
                updateMessage(newMessage, message)

                currentMessage.removeChild(inputEditMessage)

                let messageDiv = document.createElement('div')
                messageDiv.setAttribute("id", "messageContent")
                messageDiv.textContent = newMessage

                currentMessage.appendChild(messageDiv)
            }
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
        sendButton.style.display = "none"
        messageInput.style.display = "none"
        blacklistShowed = true

        clearInterval(timerNewMessages)

        if (localStorage.getItem("blacklist") !== "" && localStorage.getItem("blacklist") !== {} && localStorage.getItem("blacklist").length !== 0) {

            let localBlacklist = localStorage.getItem("blacklist").split(',')

            localBlacklist.map((ignoredUser, index) => {

                if (ignoredUser.length > 0) {

                    let user = document.createElement('li')
                    user.textContent = ignoredUser
    
                    let removeUserButton = document.createElement('button')
                    removeUserButton.textContent = "Remove " + ignoredUser
                    removeUserButton.setAttribute("onclick", 'removeIgnoredUser(' + ignoredUser + ')')
                    removeUserButton.onclick = function() {
                        removeIgnoredUser(ignoredUser)
                    }
    
                    ignoredUsers.appendChild(user)
                    user.appendChild(removeUserButton)
                }
            })
        }
    }

    function clearBlacklist() {

        isSetToken()
        blacklistShowed = false

        ignoredUsers.style.display = "none"
        sendButton.style.display = "block"
        messageInput.style.display = "block"

        while (ignoredUsers.firstChild) {

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

            showMessages()

            blacklistShowed = false

            blacklistButton.setAttribute("value", "Show Blacklist")
        }
    })
})