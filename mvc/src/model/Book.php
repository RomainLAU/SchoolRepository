<?php

class Book
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=database:3306;dbname=bookstore', "root", "tiger");
    }

    public function findAll()
    {
        $statement = $this->pdo->prepare('SELECT * FROM book WHERE 1');
        $statement->execute();

        $books = $statement->fetchAll();

        return $books;
    }
}