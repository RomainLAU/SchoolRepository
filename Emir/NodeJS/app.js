const express = require('express')
const fs = require('fs')
const mysql = require('mysql2')
const { createServer } = require("http")
const { Server } = require("socket.io")
const bodyParser = require('body-parser')

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

app.get('/films', (req, res) => {

    connection.query(`SELECT * FROM films`, (err, results, fields) => {
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
        res.json({status: 200, data: "Success"})

        io.emit("film-delete", id)

    })

})

app.post('/api/films/:titre', (req, res) => {
    let titre = req.params.titre
    connection.query(`INSERT INTO films (id_genre, id_distributeur, titre, resum, date_debut_affiche, date_fin_affiche, duree_minutes, annee_production) VALUES (1, 1, ?, 'aaaaaaaaaaaaaa', '2003-07-20', '2300-08-27', 129, 2003)`, 
    [titre],
    (err, results, fields) => {
        console.log(err)
        res.json({status: 201, data: "Created with success"})

        io.emit("film-create", titre)
    })
})

httpServer.listen(port)