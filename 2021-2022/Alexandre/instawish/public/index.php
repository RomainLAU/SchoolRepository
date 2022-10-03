<?php
require_once __DIR__ . '/../vendor/autoload.php';

session_start();

date_default_timezone_set('Europe/Paris');

$router = new \Bramus\Router\Router();

$router->get('/', 'Mvc\Controller\AccueilController@displayAccueil');

$router->post('/task/create', 'Mvc\Controller\TaskController@createTask');
$router->get('/tasks', 'Mvc\Controller\TaskController@getTasks');
$router->get('/task/(\d+)', 'Mvc\Controller\TaskController@getTaskById');
$router->post('/task/(\d+)/update', 'Mvc\Controller\TaskController@updateTaskById');
$router->get('/task/(\d+)/delete', 'Mvc\Controller\TaskController@deleteTask');

$router->run();

?>