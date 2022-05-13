const express = require('express')
const fs = require('fs')
const mysql = require('mysql2')
const { createServer } = require("http")
const { Server } = require("socket.io")
const bodyParser = require('body-parser')
const Discord = require('discord.js')

const client = new Discord.Client({ intents: ["GUILDS", "GUILD_MESSAGES"] })

// OTc0NjExNzYwNjk2OTM4NDk3.GQdap2.pai_BazzVoywaFPo191dXiKD4hd4LkmT7SKQBI

const app = express()
const port = 3000

const httpServer = createServer(app)
const io = new Server(httpServer, { })

io.on("connection", (socket) => {
    console.log("New connection")
})
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended: false }))

app.set('view engine', 'ejs')

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'tiger',
    database: 'cinema'
})

client.on("message", (message) => {
    // console.log("Un nouveau message: ", message.content)
    if(!message.author.bot) {
        if(message.content.slice(0, 12) == '!film-create') {
            connection.query(`INSERT INTO films (id_genre, id_distributeur, titre, resum, date_debut_affiche, date_fin_affiche, duree_minutes, annee_production) VALUES (1, 1, ?, 'aaaaaaaaaaaaaa', '2003-07-20', '2300-08-27', 129, 2003)`,
            [message.content.slice(13)],
            (err, results, fields) => {
                message.reply('You created a film called : ' + message.content.slice(13) + ' !')
                let filmId = results.insertId 
                io.emit("film-create", {0: message.content.slice(13), 1: filmId})
            })
        } else if(message.content.slice(0, 16) == '!film-get-5-last') {
            connection.query(`SELECT * FROM films ORDER BY id_film DESC LIMIT 5`,
            (err, results, fields) => {
                results.forEach((film) => {
                    message.reply(film.titre)
                })
            })
        } else if (message.content.slice(0, 12) == '!film-delete') {
            connection.query(`DELETE FROM films WHERE id_film = ?`, [message.content.slice(13)], (err, results, fields) => {
                message.reply('The film of id ' + message.content.slice(13) + ' was correctly deleted')
                io.emit("film-delete", message.content.slice(13))
        
            })
        } else {
            message.reply('You wrote :' + message.content.slice(0, 16))
        }
    }
})

client.login("OTc0NjExNzYwNjk2OTM4NDk3.GQdap2.pai_BazzVoywaFPo191dXiKD4hd4LkmT7SKQBI")

app.get('/films', (req, res) => {

    connection.query(`SELECT * FROM films ORDER BY id_film DESC`, (err, results, fields) => {
        res.render('films', {
            films: results
        })
    })
    
})

app.get('/films/:id', (req, res) => {
    let id = req.params.id

    connection.query(`SELECT * FROM films WHERE id_film = ?`, [id], (err, results, fields) => {
        res.render('film', {
            film: results[0]
        })
    })

})

app.delete('/api/films/:id', (req, res) => {
    let id = req.params.id

    connection.query(`DELETE FROM films WHERE id_film = ?`, [id], (err, results, fields) => {
        res.json({status: 200, data: "Deleted with success"})

        io.emit("film-delete", id)

    })

})

app.post('/api/films/:titre', (req, res) => {
    let titre = req.params.titre
    connection.query(`INSERT INTO films (id_genre, id_distributeur, titre, resum, date_debut_affiche, date_fin_affiche, duree_minutes, annee_production) VALUES (1, 1, ?, 'aaaaaaaaaaaaaa', '2003-07-20', '2300-08-27', 129, 2003)`, 
    [titre],
    (err, results, fields) => {
        res.json({status: 201, data: "Created with success"})
        let filmId = results.insertId 
        io.emit("film-create", {0: titre, 1: filmId})
    })
})

app.put('/api/films', (req, res) => {
    let body = req.body
    connection.query(`UPDATE films SET titre = ? WHERE id_film = ?`,
        [body['titre'], body['id_film']],
        (err, results, fields) => {
            res.json({status: 200, data: "Edited with success"})
            // console.log(body)
            io.emit("film-edit", body)
        }
    )
})

httpServer.listen(port)