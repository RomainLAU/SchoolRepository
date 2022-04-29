<?php

namespace Mvc\Model;

use Config\Model;

use PDO;

class TaskModel extends Model
{
    public function createTask(string $title) 
    {
        $today = new \DateTime();

        $statement = $this->pdo->prepare('INSERT INTO `post` (`title`, `creation_date`) VALUES (:title, :creation_date)');

        $statement->execute([
            'title' => $title,
            'creation_date' => $today->format("Y-m-d H:i:s"),
        ]);
    }

    public function updateTask(int $id, string $title, string $status) 
    {
        $today = new \DateTime();

        $statement = $this->pdo->prepare('UPDATE `post` SET `title` = :title, `finish_date` = :finish_date, `status` = :status WHERE id = :id');

        $statement->execute([
            'id' => $id,
            'title' => $title,
            'finish_date' => $today->format("Y-m-d H:i:s"),
            'status' => $status
        ]);
    }

    public function findOneTaskById($id) 
    {
        $statement = $this->pdo->prepare('SELECT * FROM `post` WHERE `id` = :id');

        $statement->execute([
            'id' => $id,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function findAllTasks() 
    {
        $statement = $this->pdo->prepare('SELECT * FROM `post` WHERE 1');

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteOneTaskById(int $id) 
    {
        $statement = $this->pdo->prepare('DELETE `post` FROM `post` WHERE `id` = :id');

        $statement->execute([
            'id' => $id,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    // public function buyHost() {

    //     $statement = $this->pdo->prepare('UPDATE `user` SET `role` = :role, `token` = :token, `timeRole`= :timeRole WHERE `id` = :id');

    //     $statement->execute([
    //         'role' => 'host',
    //         'token' => intval($_SESSION['user']['token']) - 1000,
    //         'id' => $_SESSION['user']['id'],
    //         'timeRole' => date("Y-m-d", mktime(0, 0, 0, date("m") + 1, date("d"), date("Y"))),
    //     ]);

    //     $_SESSION["user"]["timeRole"] = date("Y-m-d", mktime(0, 0, 0, date("m") + 1, date("d"), date("Y"))); 
    // }

    // public function changeRole() {

    //     $statement = $this->pdo->prepare('UPDATE `user` SET `role` = :role, `timeRole`= :timeRole WHERE `id` = :id');
    //     $statement->execute([
    //         'role' => "user",
    //         'id' => $_SESSION['user']['id'], 
    //         'timeRole' => '0',
    //     ]);
    // }
}