<?php

namespace Mvc\Controller;

use Config\Controller;
use Mvc\Model\User;
use Twig\Environment;

class UserController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        parent::__construct();
    }

    public function listUser()
    {
        $users = $this->userModel->findAll();

        echo $this->twig->render('user/users.html.twig', [
            'users' => $users
        ]);
    }
}