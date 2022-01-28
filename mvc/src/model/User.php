<?php

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=database:3306;dbname=bookstore', "root", "tiger");
    }

    public function findAll()
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE 1');
        $statement->execute();

        $users = $statement->fetchAll();

        return $users;
    }
}