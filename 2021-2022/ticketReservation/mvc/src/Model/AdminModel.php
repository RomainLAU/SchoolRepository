<?php

namespace Mvc\Model;

use Framework\Model;

use PDO;

class AdminModel extends Model
{
    public function getEvents() 
    {
        $statement = $this->pdo->prepare('SELECT * FROM `events`');

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}