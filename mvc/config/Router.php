<?php

require_once __DIR__ . '/../src/controller/BookController.php';
require_once __DIR__ . '/../src/controller/UserController.php';

class Router {

    public function run(string $routeName) {

        $bookController = new BookController();
        $userController = new UserController();

        if ($routeName === '/books') {

            $bookController->listBook();

        } else if ($routeName === '/book') {

            $bookController->book();

        } else if ($routeName === '/book/create') {

            $bookController->createBook();

        } else if ($routeName === '/users') {
            

            $userController->listUser();

        } else {

            echo "Mais que faites vous là ?";

        }
    }
}