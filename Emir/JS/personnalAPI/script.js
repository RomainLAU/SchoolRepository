window.addEventListener("DOMContentLoaded", function () {

    let messages = document.querySelector('#messages')

    let messageInput = document.querySelector('#message')
    let sendButton = document.querySelector('#send')

    let lastMessageID = 0

    function createMessage(name, message, sendTime) {

        let messageLi = document.createElement('li')
        messageLi.setAttribute("class", "message")
        messageLi.setAttribute("id", name)
        messages.appendChild(messageLi)

        let nicknameDiv = document.createElement('div')
        nicknameDiv.setAttribute("id", "senderName")
        nicknameDiv.textContent = name

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
    }

    function showMessages() {
        fetch("https://api.edu.etherial.dev/apijsv1/messages").then(function(response) {
            response.json().then(function(json) {
                json['data'].slice(0).reverse().map(function (value, index) {
                    if (value['id'] > lastMessageID) {
                        lastMessageID = value['id']
                        createMessage(value['nickname'], value['message'], value['createdAt'])
                    }
                })
            })
        })
    }

    sendButton.addEventListener("click", function() {
        if (messageInput.value.length !== 0) {
            fetch("https://api.edu.etherial.dev/apijsv1/messages", {
                method: 'POST',
                body: JSON.stringify({
                    nickname: 'Romain',
                    message: messageInput.value
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then(function (response) {
                if (response.ok) {
                    return response.json();
                }
                return Promise.reject(response);
            }).then(function (data) {
                console.log(data);
            }).catch(function (error) {
                console.warn('Something went wrong.', error);
            });
        }
        
        messageInput.value = ''

        
        showMessages()
        showMessages()
    })

    showMessages()
})