const express = require('express');
const fs = require('fs');
const mysql = require('mysql2');
const { createServer } = require("http");
const { Server } = require("socket.io");

const app = express()
const port = 3000

const httpServer = createServer(app);
const io = new Server(httpServer, { });

io.on("connection", (socket) => {
    // console.log("Connection")
});

app.set('view engine', 'ejs')

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'tiger',
    database: 'cinema'
});

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
        console.log(results)
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
 
httpServer.listen(port)