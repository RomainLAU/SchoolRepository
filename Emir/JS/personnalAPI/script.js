window.addEventListener("DOMContentLoaded", function () {

    let messages = document.querySelector('#messages')

    let messageInput = document.querySelector('#message')
    let sendButton = document.querySelector('#send')

    let lastMessageID = 0

    function createNickname(name) {
        let nicknameLi = document.createElement('li')
        nicknameLi.setAttribute("id", "nickname")
        nicknameLi.setAttribute("id", name)
        nicknameLi.textContent = name
        return nicknameLi
    }

    function createMessage(message, nickname) {
        let messageLi = document.createElement('li')
        messageLi.setAttribute("class", "message")
        messageLi.setAttribute("id", nickname)
        messageLi.textContent = message
        return messageLi
    }

    function showMessages() {
        fetch("https://api.edu.etherial.dev/apijsv1/messages").then(function(response) {
            response.json().then(function(json) {
                json['data'].slice(0).reverse().map(function (value, index) {
                    if (value['id'] > lastMessageID) {
                        lastMessageID = value['id']
                        messages.appendChild(createNickname(value['nickname']))
                        messages.appendChild(createMessage(value['message'], value['nickname']))
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