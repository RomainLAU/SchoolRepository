const fs = require('fs')
const axios = require('axios').default

apiUrl = 'https://randomuser.me/api/'

axios.get(apiUrl, {responseType: 'json'}).then(response => {
    fs.writeFile("content.json", JSON.stringify(response.data), (err) => {
        if (err) {
            console.log(err)
        } else {
            console.log("File saved successfully")
        }
    })
})