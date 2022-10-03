<?php

namespace Mvc\Controller;

use Config\Controller;
use Mvc\Model\TaskModel;
use Twig\Environment;

class TaskController extends Controller
{
    private TaskModel $taskModel;

    public function __construct() {
        parent::__construct();
        $this->taskModel = new TaskModel();
    }

    public function createTask() {

        $json = file_get_contents('php://input');
        $userData = json_decode($json, true);

        $this->taskModel->createTask($userData['title']);

        echo json_encode([
            'status' => 201,
            'data' => $userData,
        ]);
    }

    public function getTasks() {

        $userData = $this->taskModel->findAllTasks();

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: http://localhost');

        echo json_encode([
            'status' => '200',
            'data' => $userData,
        ]);
    }

    public function getTaskById(int $id) {

        $userData = $this->taskModel->findOneTaskById($id);

        header('Content-Type: application/json');
        echo json_encode([
            'status' => '200',
            'data' => $userData,
        ]);
    }

    public function updateTaskById(int $id) {

        $json = file_get_contents('php://input');
        $userData = json_decode($json, true);

        $this->taskModel->updateTask($id, $userData['title'], $userData['status']);

        echo json_encode([
            'status' => 200,
            'data' => $userData,
        ]);
    }

    public function deleteTask(int $id) {

        $userData = $this->taskModel->deleteOneTaskById($id);

        header('Content-Type: application/json');
        echo json_encode([
            'status' => '200',
            'data' => $userData,
        ]);
    }
}