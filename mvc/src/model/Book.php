<?php

namespace Mvc\Model;

use PDO;

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

    public function create(string $title, string $description, string $author)
    {
        $statement = $this->pdo->prepare("INSERT INTO 'book' ('title', 'author', 'description') VALUES (:title, :author, :description)");
        $statement->execute([
            'title' => $title,
            'author' => $author,
            'description' => $description,
        ]);
    }
}