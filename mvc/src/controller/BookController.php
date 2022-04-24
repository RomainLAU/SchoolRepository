<?php

namespace Mvc\Controller;

use Mvc\Model\Book;

class BookController extends Controller{

    private Book $bookModel;

    public function __construct()
    {
        $this->bookModel = new Book();
    }

    public function listBook()
    {
        var_dump('fkkfzfl');die;
        $bookController = new Book();
        $listBooks = $this->bookModel->findAll();

        $listBooks = [
            ['title' => 'lol',
            'description' => 'non',
            'author' => 'steuplait']
        ];

        echo $this->twig->render('book/books.html.twig', [
            'books' => $listBooks,
        ]);
    }

    public function createBook($bookParameters)
    {
        $bookModel = new Book();
        $bookModel->create($bookParameters['title'], $bookParameters['description'], $bookParameters['author']);

        header('Location: /books');
        exit();
    }
}