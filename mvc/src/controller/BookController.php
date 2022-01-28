<?php

require_once __DIR__ . '/../model/Book.php';

class BookController{

    public function listBook()
    {
        $bookController = new Book();
        $listBooks = $bookController->findAll();

        require_once __DIR__ . '/../view/book/books.php';
    }

    public function book()
    {
        require_once __DIR__ . '/../view/book/book.php';
    }

    public function createBook()
    {
        require_once __DIR__ . '/../view/book/createBook.php';
    }
}