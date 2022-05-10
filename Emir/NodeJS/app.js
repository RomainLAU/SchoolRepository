const express = require('express')
const app = express()
const mysql = require('mysql2')

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'tiger',
  database: 'cinema'
})

app.set('view engine', 'ejs')

app.get('/', (req, res) => {
  res.send('Hello World')
})

app.get('/movies', (req, res) => {
  connection.query(
    'SELECT * FROM `films`',
    (err, results) => {
      if (err) {
        console.log(err)
      }
      res.render('index', {
        movies: results
      })
    }
  )
})

app.get('/movies/:id', (req, res) => {
  connection.query(
    'SELECT * FROM `films` WHERE `id_film` = ?',
    [req.params.id],
    (err, results) => {
      if (err) {
        console.log(err)
      }
      console.log(results)
      res.render('index', {
        movie: results
      })
    }
  )
})

app.delete('/api/movies/:id', (req, res) => {
  connection.query(
    'DELETE FROM `films` WHERE `id_film` = ?',
    [req.params.id],
    (err, results) => {
      res.json({status: 200, data: "Success"})
    }
  )
})

// let visits = 0

// app.get('/hello', (req, res) => {
//   res.render('index', {
//       sentence: "Bonjour moi-même",
//       date: Date(),
//       visits: visits++
//   })
// })



app.listen(3000, () => {
  console.log(`Example app listening on port 3000`)
})