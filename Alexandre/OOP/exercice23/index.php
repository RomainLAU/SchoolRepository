<?php

$dsn = 'mysql:host=database:3306;dbname=oop_exercise';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $books = $PDO->query("SELECT * FROM book", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

class Book {

    public int $id;
    public string $name;
    public string $releaseDate;
    public string $author;

    public function __construct(int $id, string $name, string $releaseDate, string $author)
    {
        $this->id = $id;
        $this->name = $name;
        $this->releaseDate = $releaseDate;
        $this->author = $author;
    }
}

function createBook(Book $book, $PDO)
    {
        $statement = $PDO->prepare("INSERT INTO book (name, releaseDate, author) VALUES (:name, :releaseDate, :author)");

        $statement->execute([
            'name' => $book->name,
            'releaseDate' => $book->releaseDate,
            'author' => $book->author,
        ]);
    }

function readBook(int $id, $PDO) {
    $bookOfId = $PDO->query("SELECT * FROM book WHERE id = $id", PDO::FETCH_ASSOC)->fetch();

    var_dump($bookOfId);

    echo "<br>";
    
    foreach($bookOfId as $values) {
        echo $values . " ";
    }
}

function getAllBooks(array $books) {
    echo "<table border=1>";
    foreach($books as $book) {
        echo "<tr>";
        foreach($book as $key => $value) {
            if ($key !== 'id') {
                echo "<td> $value </td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}

function deleteBook(int $id, $PDO) {

    $statement = $PDO->prepare("DELETE book FROM book WHERE id = :id");

    $statement->execute([
        'id' => $id,
    ]);

}

function updateBook(Book $book, $PDO) {

    try {
        $statement = $PDO->prepare("UPDATE book SET name = :name, releaseDate = :releaseDate, author = :author WHERE id = :id");

        $statement->execute([
            'id' => $book->id,
            'name' => $book->name,
            'releaseDate' => $book->releaseDate,
            'author' => $book->author,
        ]);
    } catch (PDOException $exception) {
        throw $exception;
        die;
    }
}

$book4 = new Book(10, 'harry potter 4', '2016-06-20', 'VOUS');

// createBook($book4, $PDO);

getAllBooks($books);

// readBook(9, $PDO);

// deleteBook(1, $PDO);

updateBook($book4, $PDO);

?>