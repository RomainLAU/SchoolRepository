<?php

require_once __DIR__ . '/../config/Router.php';

$url = $_SERVER['REQUEST_URI'];

$router = new Router();

$router->run($url);